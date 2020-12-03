<?php declare(strict_types=1);
//require packages

session_start();

// Import Controllers with require_once
$CONTROLLER_PATH = 'backend/controllers/';
require_once($CONTROLLER_PATH.'ShopController.php');
require_once($CONTROLLER_PATH.'ProfileController.php');

// Defining constant paths
define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/js/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// Routing to controllers
$urls = [
	"" => function(){
		return ShopController::showIndexPage();
	},

	"register" => function(){
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			ProfileController::Register();
		} else {
			ProfileController::RegisterForm();
		}
	},

	"login" => function(){
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			ProfileController::Login();
		} else {
			ProfileController::LoginForm();
		}
	},

	// API
	"api/getItems" => function(){
		ShopController::getItems();
	}

];

// Route to controller if exists else sent 404
try {
	if (isset($urls[$path])) {
		$urls[$path]();
	} else {
		echo "No controller for '$path'";
	}
} catch (Exception $e) {
	echo "An error occurred: <pre>$e</pre>";
};
