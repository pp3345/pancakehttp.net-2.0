<?php

    namespace net\pancakehttp;

    use Exception;
	use PDO;
	use PDOException;
	use Smarty;

	class PancakeHTTP {
		use Singleton;

		/**
		 * @var Smarty
		 */
		public $smarty;

		/**
		 * @var PDO
		 */
		public $pdo;

		private function __construct() {
			$this->smarty = new Smarty;
			$this->connect();
		}

		private function connect() {
			$this->pdo = new PDO(DATABASE_DNS, DATABASE_USER, DATABASE_PASSWORD);
			$this->pdo->query('SET NAMES "utf8"');
		}

	    public function onRequest() {
		    header('Content-Type: text/html; charset=utf-8');
		    session_start();

		    try {
			    $this->pdo->query('SELECT 1');
		    } catch(PDOException $e) {
			    $this->connect();
		    }

		    $createData = explode('/', urldecode($_SERVER['REQUEST_URI']));
		    $pageName = $createData[1] ?: "Index";
		    unset($createData[0], $createData[1]);

		    try {
			    $this->buildPage($pageName, $createData);
		    } catch(Exception $exception) {
			    $this->buildPage("Exception", [$exception]);
		    }
	    }

	    private function buildPage($pageName, $createData = array()) {
		    $className = __NAMESPACE__ . "\\" . $pageName . "Page";

		    if(!class_exists($className, true)) {
			    throw new PageNotFoundException($pageName);
		    }

		    $template = call_user_func_array([$className::getInstance(), "build"], $createData);

		    $this->smarty->assign('navElements', ['Get Pancake' => '/get', 'Documentation' => '/documentation']);
		    $this->smarty->display('Templates/' . $template . '.tpl');
		    $this->smarty->clearAllAssign();
	    }
    }

?>
