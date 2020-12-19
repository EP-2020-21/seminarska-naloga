<?php

require_once("Viewhelper.php");
require_once("backend/model/ShopModel.php");
require_once("backend/model/ProfileModel.php");

class DashboardController
{
     private static $VIEWS_PATH = 'frontend/views/dashboard/';

     public static function showIndexPage(){
         ViewHelper::render(self::$VIEWS_PATH . "index.php");
     }
}