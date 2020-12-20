<?php declare(strict_types=1);
//require packages


session_start();

require_once("backend/controllers/ShopController.php");
require_once('backend/controllers/ProfileController.php');
require_once('backend/controllers/DashboardController.php');

// Defining constant paths
define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "frontend/static/js/");
define("ROOT_DIR", __DIR__);

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// Routing to controllers
$urls = [
	"" => function(){
		return ShopController::showIndexPage();
	},

	"register" => function(){
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			return ProfileController::Register();
		} else {
			return ProfileController::RegisterForm();
		}
	},

	"login" => function(){
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			return ProfileController::Login();
		} else {
			return ProfileController::LoginForm();
		}
	},

        "dashboard" => function() {
            if (DashboardController::verifyUser()) {
                return DashboardController::showIndexPage();
            } else {
                ViewHelper::redirect(BASE_URL . "login");
            }
        },

    "profile" => function(){
    if (ProfileController::userLoggedIn()){
        if (($_SERVER["REQUEST_METHOD"] == "GET") && !(isset($_GET["id"]))){
            // pogledamo svoj profil
            if (isset($_SESSION["profile"]["ID_ZAPOSLENI"])){
                ProfileController::showProfile($_SESSION["profile"]["ID_ZAPOSLENI"], true);
            } else {
                ProfileController::showProfile($_SESSION["profile"]["ID_STRANKA"], false);
            }

        } else {
            // pogledamo profil od id-ja
            if (isset($_SESSION["profile"]["ID_ZAPOSLENI"])) {
                $id = $_GET["id"];
                $isStranka = ProfileModel::checkIfStrankaExistsById($id);
                $isZaposleni = ProfileModel::checkIfStrankaExistsById($id);
                if ($isStranka) {
                    ProfileController::showProfile($id, false);
                } else if ($isZaposleni) {
                    ProfileController::showProfile($id, true);
                } else {
                    // 404 page
                }

            } else {
                // 404 page
            }
        }
    }
    },

    "profile/edit" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            ProfileController::editProfile();
        }
    },

    "profile/delete" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            ProfileController::deleteProfile();
        }
    },
    "checkout" => function() {
        return ShopController::showCheckout();
    },

    "checkout/oddajNakup" => function(){
        return ShopController::oddajNakup();
    },

    "dashboard" => function() {
        // if certifikat
        return DashboardController::showIndexPage();
    },

    "dashboard/addItem" => function() {
    // if certifikat
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            return DashboardController::addItem();
        }
        return DashboardController::showAddForm();
    },


	// API
	"api/items" => function(){
        if (isset($_GET["id"])){
            return ShopController::getItemsById($_GET['id']);
        }
        if (isset($_GET["kategorijaID"])){
            return ShopController::getItemsWithKategorija($_GET["kategorijaID"]);
        }
		return ShopController::getItems();
	},

    "api/kategorije" => function() {
        return ShopController::getKategorije();
    },

    "api/stranke" => function () {
        if (ProfileController::userLoggedIn()) {
            if (isset($_GET["id"])){
                return ProfileController::getStrankaById($_GET["id"]);
            }
            return ProfileController::getStranke();
        } else {
            echo "You must be logged in to access this page!";
        }

    },

    "api/zaposleni" => function () {
    if (ProfileController::userLoggedIn()){
        if (isset($_GET["id"])){
            return ProfileController::getZaposleniById($_GET["id"]);
        }
        return ProfileController::getZaposleni();
    } else {
        echo "You must be logged in to access this page!";
    }
    },

    "api/delete_item" => function () {
        // preveri certifikat TODO
        if (isset($_POST["id"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            return DashboardController::deleteItem($_POST["id"]);
        }
    },

    "api/addToBasket" => function() {
        $id = $_GET["id"];
        ShopController::addToBasket($id);
    }


//    "" => function () {
//        ViewHelper::redirect(BASE_URL . "shop");
//    },
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
