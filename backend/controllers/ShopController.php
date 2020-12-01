<?php

require_once('ViewHelper.php');
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
}