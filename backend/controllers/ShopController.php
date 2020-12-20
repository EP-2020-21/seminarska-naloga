<?php
// URL Martin require_once("Viewhelper.php");
require_once("Viewhelper.php");
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

    public static function getItemsById($id){
        $items = ShopModel::getItemById($id);
        $response = json_encode($items);
        echo $response;
    }

    public static function getKategorije() {
        $kategorije = ShopModel::getKategorije();
        $response = json_encode($kategorije);
        echo $response;
    }

    public static function getItemsWithKategorija($id){
        $items = ShopModel::getItemsWithKategorija($id);
        $response = json_encode($items);
        echo $response;
    }
}
