<?php

require_once('/home/ep/NetBeansProjects/seminarska-naloga/Viewhelper.php');
require_once("backend/model/ShopModel.php");

class ShopController {

    private static $VIEWS_PATH = 'frontend/views/shop/';

    public static function showIndexPage(){
        $items = ShopModel::getAll();
        $featuredItems = array_slice($items, count($items) - 3, count($items));
        shuffle($items);

        $vars = ["featuredItems" => $featuredItems, "items" => $items ];	
        ViewHelper::render(self::$VIEWS_PATH . "index.php", $vars);
    }

    public static function getItems() {
        $items = ShopModel::getAll();
        $response = json_encode($items);
        echo $response;
    }
}
