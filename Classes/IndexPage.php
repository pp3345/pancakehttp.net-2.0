<?php

    namespace net\pancakehttp;

    class IndexPage {
		use Singleton;

	    public function build() {
		    $smarty = PancakeHTTP::getInstance()->smarty;
		    $smarty->assign('navElementActive', '/');
		    $smarty->assign('versions', Version::getRange(3));

		    return "index";
	    }
    }
?>
