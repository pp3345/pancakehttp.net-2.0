<?php

    namespace net\pancakehttp;

    class PageNotFoundException extends \Exception {
		private $pageName;

	    public function __construct($pageName) {
		    header('HTTP/1.0 404 Not Found');
		    $this->pageName = $pageName;
		    $this->message = "The page you requested was not found.";
	    }
    }
?>
