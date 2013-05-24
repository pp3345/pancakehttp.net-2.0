<?php

    namespace net\pancakehttp;

    class GetPage {
		use Singleton;

	    public function build() {
		    $smarty = PancakeHTTP::getInstance()->smarty;
		    $smarty->assign('navElementActive', '/get');
		    $smarty->assign('latest', Version::getFirst()->version);

		    return "get";
	    }
    }
?>
