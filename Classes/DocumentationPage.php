<?php

    namespace net\pancakehttp;

    class DocumentationPage {
		use Singleton;

	    public function build() {
		    $redirect = new Redirect();
		    $redirect->destination = "/documentation";
		    $redirect->ip = $_SERVER['REMOTE_ADDR'];
		    $redirect->userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
		    $redirect->save();

		    header("Location: https://github.com/pp3345/Pancake/wiki");
		    exit;
	    }
    }
?>
