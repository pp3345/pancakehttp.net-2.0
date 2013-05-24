<?php

	namespace net\pancakehttp;

	use \RuntimeException;

	trait Cache {
		private static $cache = array();
		private static $keyCache = array();
		private static $foreignKeyCache = array();
		private static $cacheIsComplete = false;
		private $indexedForeignKeys = array();
		private $foreignDependencies = array();
		public $id = 0;

		public function __construct($id = 0, \stdClass $dataset = null) {
			if($id) {
				if(!$dataset) {
					$dataset = $this->fetchFromDatabase($id);
				}

				foreach($dataset as $name => $value)
					$this->$name = $value;
			}
		}

		private function fetchFromDatabase($id) {
			$query = "SELECT * FROM " . self::TABLE . " WHERE id = :id";
			if(isset(self::$cacheIndices)) {
				foreach(self::$cacheIndices as $key) {
					$query .= " OR " . $key . " = :id";
				}
			}

			$stmt = PancakeHTTP::getInstance()->pdo->prepare($query);
			$stmt->bindParam(':id', $id);
			if(!$stmt->execute() || !$stmt->rowCount()) {
				throw new PageNotFoundException($id);
			}

			return $stmt->fetchObject();
		}

		private function addToCache() {
			self::$cache[$this->id] = $this;
			if(isset(self::$cacheIndices)) {
				foreach(self::$cacheIndices as $key) {
					self::$keyCache[$key][$this->$key] = $this;
					uasort(self::$keyCache[$key], array("self", defined("self::SORT_FUNCTION") ? self::SORT_FUNCTION : "sort"));
				}
			}

			if(isset(self::$foreignKeys)) {
				foreach(self::$foreignKeys as $foreignKey) {
					if(!is_object($this->$foreignKey))
						$this->fetchForeignKey($foreignKey);
					if(is_object($this->$foreignKey)) {
						$element = $this->$foreignKey; // Expressions like ($this->$foreignKey)->id won't work
						if(!isset(self::$foreignKeyCache[$foreignKey][$element->id][$this->id])) {
							$element->addForeignDependency($this);
							self::$foreignKeyCache[$foreignKey][$element->id][$this->id] = $this;
						}

						uasort(self::$foreignKeyCache[$foreignKey][$element->id], array("self", defined("self::SORT_FUNCTION") ? self::SORT_FUNCTION : "sort"));
						$this->indexedForeignKeys[$foreignKey] = $element->id;
					}
				}
			}

			uasort(self::$cache, array("self", defined("self::SORT_FUNCTION") ? self::SORT_FUNCTION : "sort"));
		}

		private function deleteFromCache() {
			unset(self::$cache[$this->id]);
			if(isset(self::$cacheIndices)) {
				foreach(self::$cacheIndices as $key) {
					unset(self::$keyCache[$key][$this->$key]);
				}
			}

			if(isset(self::$foreignKeys)) {
				foreach(self::$foreignKeys as $foreignKey) {
					unset(self::$foreignKeyCache[$foreignKey][$this->indexedForeignKeys[$foreignKey]][$this->id]);
				}
			}
		}

		public function save() {
			$query = "INSERT INTO " . self::TABLE . " SET ";
			foreach($this as $name => $value) {
				if($name == "indexedForeignKeys" || $name == "foreignDependencies")
					continue;

				$query .= $name . " = :" . $name . ",";
			}

			$query[strlen($query) - 1] = " ";
			$stmt = PancakeHTTP::getInstance()->pdo->prepare($query);

			foreach($this as $name => $value) {
				if($name == "indexedForeignKeys" || $name == "foreignDependencies")
					continue;
				if(is_object($value))
					$value = $value->id;
				$stmt->bindValue(":" . $name, $value);
			}

			if(!$stmt->execute())
				throw new RuntimeException("Failed to save element: " . $stmt->errorInfo()[2]);

			$this->id = PancakeHTTP::getInstance()->pdo->lastInsertID();
			$this->addToCache();
		}

		public function update() {
			if(!$this->id)
				return $this->save();

			$query = "UPDATE " . self::TABLE . " SET ";
			foreach($this as $name => $value) {
				if($name == "indexedForeignKeys" || $name == "foreignDependencies")
					continue;

				$query .= $name . " = :" . $name . ",";
			}

			$query[strlen($query) - 1] = " ";
			$query .= "WHERE id = :id";
			$stmt = PancakeHTTP::getInstance()->pdo->prepare($query);

			foreach($this as $name => $value) {
				if($name == "indexedForeignKeys" || $name == "foreignDependencies")
					continue;

				if(is_object($value))
					$value = $value->id;
				$stmt->bindValue(":" . $name, $value);
			}

			if(!$stmt->execute())
				throw new RuntimeException("Failed to save element: " . $stmt->errorInfo()[2]);

			// Reset cache
			$this->deleteFromCache();
			$this->addToCache();
		}

		public function delete() {
			$stmt = PancakeHTTP::getInstance()->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
			$stmt->bindParam(':id', $this->id);
			$stmt->execute();

			$this->deleteFromCache();

			foreach($this->foreignDependencies as $dependency) {
				$dependency->delete();
			}
		}

		public function addForeignDependency($object) {
			$this->foreignDependencies[] = $object;
		}

		private static function sort(self $a, self $b) {
			if($a->id < $b->id)
				return -1;
			return $a->id != $b->id;
		}

		private static function rsort(self $a, self $b) {
			if($a->id > $b->id)
				return -1;
			return $a->id != $b->id;
		}

		public static function get($id) {
			if(isset(self::$cache[$id])) {
				return self::$cache[$id];
			}

			if(isset(self::$cacheIndices)) {
				foreach(self::$cacheIndices as $key) {
					if(isset(self::$keyCache[$key][$id])) {
						return self::$keyCache[$key][$id];
					}
				}
			}

			$instance = new self($id);
			$instance->addToCache();

			return $instance;
		}

		public static function fillCache() {
			$stmt = PancakeHTTP::getInstance()->pdo->prepare("SELECT * FROM " . self::TABLE);
			if(!$stmt->execute()) {
				throw new RuntimeException("Failed to fetch entries from database: " . $stmt->errorInfo()[2]);
			}

			while($dataset = $stmt->fetchObject()) {
				if(!isset(self::$cache[$dataset->id])) {
					$instance = new self($dataset->id, $dataset);
					$instance->addToCache();
				}
			}

			self::$cacheIsComplete = true;
		}

		public static function getRange($amount, $offset = 0) {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			return array_slice(self::$cache, $offset, $amount, true);
		}

		public static function getAll() {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			return self::$cache;
		}

		public static function getCount() {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			return count(self::$cache);
		}

		public static function getLast() {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			return end(self::$cache);
		}

		public static function getFirst() {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			return reset(self::$cache);
		}

		public static function getElementsByForeignKey($key, $value) {
			if(!self::$cacheIsComplete) {
				self::fillCache();
			}

			if(isset(self::$foreignKeyCache[$key][$value])) {
				return self::$foreignKeyCache[$key][$value];
			}

			return array();
		}
	}

?>
