<?php

    namespace net\pancakehttp;

    class ChangelogPage {
		use Singleton;

	    public function build() {
		    $smarty = PancakeHTTP::getInstance()->smarty;
		    $smarty->assign('versions', Version::getAll());
		    $smarty->assign('navElementActive', "");

		    return "changelog";
	    }
    }
?>
