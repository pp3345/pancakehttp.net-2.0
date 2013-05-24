<?php

    namespace net\pancakehttp;

    class ExceptionPage {
		use Singleton;

	    public function build($exception) {
		    PancakeHTTP::getInstance()->smarty->assign('exception', $exception);

		    return "exception";
	    }
    }
?>
