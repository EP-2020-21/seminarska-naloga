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
        $kategorije = ShopModel::getKategorije();

        if (isset($_GET["kategorija"])){
            $kategorijaID = $_GET["kategorija"];
            $items = ShopModel::getItemsWithKategorija($kategorijaID);
        }
        $vars = ["featuredItems" => $featuredItems, "items" => $items, "kategorije" => $kategorije ];
        ViewHelper::render(self::$VIEWS_PATH . "index.php", $vars);
    }

    private static function readBasket() {
        $totalValue = 0;
        $basket = array();
        foreach ($_SESSION["basket"] as $item => $quatity){
            $artikel = ShopModel::getItemById($item);
            $cena = $artikel["CENA"];
            $naziv = $artikel["NAZIV_ARTIKEL"];
            $cenaSkupaj = $cena * $quatity;
            $totalValue = $totalValue + $cenaSkupaj;

            $basketItem["itemID"] = $item;
            $basketItem["naziv"] = $naziv;
            $basketItem["cena"] = $cena;
            $basketItem["kolicina"] = $quatity;
            $basketItem["cenaSkupaj"] = $cenaSkupaj;
            $basket["$item"] = $basketItem;
        }
        $vars = ["basket" => $basket, "totalValue" => $totalValue];

        return $vars;
    }

    public static function showCheckout() {
        $vars = self::readBasket();
        ViewHelper::render(self::$VIEWS_PATH . "checkout.php", $vars);
    }

    public static function oddajNakup(){
        $vars = self::readBasket();
        $basket = $vars["basket"];
        $totalValue = $vars["totalValue"];
        $stranka = $_SESSION["profile"]["ID_STRANKA"];
        ShopModel::insertNakup($stranka, $totalValue, $basket);
        unset($_SESSION["basket"]);
        ViewHelper::redirect(BASE_URL . "");
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

    public static function addToBasket($id)
    {
        try {
            $artikel = ShopModel::getItemById($id);
            $artikelID = $artikel["ID_ARTIKEL"];
            if (isset($_SESSION["basket"][$artikelID])) {
                $_SESSION["basket"][$artikelID]++;
            } else {
                $_SESSION["basket"][$artikelID] = 1;
            }
            $response = json_encode($_SESSION["basket"]);
            echo $response;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
