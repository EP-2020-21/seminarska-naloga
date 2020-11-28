<?php

require_once('ViewHelper.php');

class ShopController {

    private static $VIEWS_PATH = 'frontend/views/shop/';

    public static function showIndexPage(){
        ViewHelper::render(self::$VIEWS_PATH . "shop.php");
    }
}