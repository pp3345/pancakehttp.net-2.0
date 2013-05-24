<?php

	namespace net\pancakehttp;
/*
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	apache_child_terminate();
*/
	require_once 'Smarty/Smarty.class.php';
	spl_autoload_register('net\pancakehttp\autoload');
	spl_autoload_register('smartyAutoload');

	PancakeHTTP::getInstance()->onRequest();

?>
