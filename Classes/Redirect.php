<?php

    namespace net\pancakehttp;

    class Redirect {
		use Cache;

	    public $destination = "";
	    public $userAgent = "";
	    public $ip = "";

	    const TABLE = "redirects";
    }
?>
