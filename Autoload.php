<?php

	namespace net\pancakehttp;

	function autoload($className) {
		// Resolve namespace
		if($namespaceDelimiter = strrpos($className, '\\')) {
			$className = substr($className, $namespaceDelimiter + 1);
		}

		// Do not allow any path names
		if(strpos($className, '/') !== false)
			return false;

		// Make first character of class name upper case
		$className = ucfirst($className);

		// Make sure we are in the right directory
		chdir($_SERVER['DOCUMENT_ROOT']);

		// Try loading class
		if(file_exists('Classes/' . $className . '.php')) {
			require_once 'Classes/' . $className . '.php';
			return true;
		}

		return false;
	}

?>
