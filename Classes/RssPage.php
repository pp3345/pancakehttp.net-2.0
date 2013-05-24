<?php

    namespace net\pancakehttp;

    class RSSPage {
		use Singleton;

	    public function build() {
		    PancakeHTTP::getInstance()->smarty->assign('versions', Version::getAll());

		    header('Content-Type: application/rss+xml');
		    return "rss";
	    }
    }
?>
