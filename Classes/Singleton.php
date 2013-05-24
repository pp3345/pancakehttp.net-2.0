<?php

	namespace net\pancakehttp;

	trait Singleton {
		/**
		 * @var self
		 */
		private static $instance;

		/**
		 * @return self
		 */
		public static function getInstance() {
			if(!self::$instance)
				self::$instance = new self;
			return self::$instance;
		}

		private function __construct() {}
	}

	?>
