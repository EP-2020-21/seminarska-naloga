<?php
//require packages
require 'vendor/autoload.php';

session_start();

// Import Controllers with require_once

// Defining constant paths
define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "src/frontend/styles");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// Routing to controllers
$urls = [
  "" => function(){
    // Controller::helloo
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
} 