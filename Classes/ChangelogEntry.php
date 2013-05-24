<?php

	namespace net\pancakehttp;

	class ChangelogEntry {
		use Cache;

		public $version = null;
		public $content = "";

		private static $foreignKeys = array('version');

		const TABLE = "changes";

		private function fetchForeignKey() {
			$this->version = Version::get($this->version);
		}
	}

?>
