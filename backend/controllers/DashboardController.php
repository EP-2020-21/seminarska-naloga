<?php

require_once('/home/ep/NetBeansProjects/seminarska-naloga/Viewhelper.php');
require_once("backend/model/ShopModel.php");
require_once("backend/model/ProfileModel.php");

class DashboardController
{
     private static $VIEWS_PATH = 'frontend/views/dashboard/';

     public static function showIndexPage($message = ""){
         $stranke = ProfileModel::getAllStranke();
         $zaposleni = ProfileModel::getAllZaposleni();
         $ponudba   = ShopModel::getAll();
         $nakupi = ShopModel::getNakupi();
         $vars = ["nakupi" => $nakupi, "ponudba" => $ponudba, "zaposleni" => $zaposleni, "stranke" => $stranke];
         if (!empty($message)) {
             $vars["message"] = $message;
             ViewHelper::render(self::$VIEWS_PATH . "index.php", $vars );
         } else {
             ViewHelper::render(self::$VIEWS_PATH . "index.php", $vars);
         }

     }
    public static function addItem(){
        $naziv = $_POST["naziv"];
        $opis  = $_POST["opis"];
        $cena  = $_POST["cena"];
        $slika = $_POST['img_url'];
        $kategorija = $_POST["kategorija"];
        ShopModel::addItem($naziv, $opis, $cena, $slika, $kategorija);
        self::showIndexPage("Artikel $naziv je bil dodan!");
    }

    public static function showAddForm(){
         $kategorije = ShopModel::getKategorije();
         ViewHelper::render(self::$VIEWS_PATH . "addItem.php", ["kategorije" => $kategorije]);
    }

    public static function showEditForm(){
        $id = $_GET["id"];
        $item = ShopModel::getItemById($id);
        $kategorije = ShopModel::getKategorije();
        ViewHelper::render(self::$VIEWS_PATH . "editItem.php", ["item" => $item, "kategorije" => $kategorije]);
    }

    public static function editItem(){
        $id = $_POST["id"];
        $naziv = $_POST["naziv"];
        $opis  = $_POST["opis"];
        $cena  = $_POST["cena"];
        $slika = $_POST['img_url'];
        $kategorija = $_POST["kategorija"];
        ShopModel::editItem($id, $naziv, $opis, $cena, $slika, $kategorija);
        self::showIndexPage("Artikel $naziv je bil posodobljen!");
    }

     public static function deleteItem($id){
        ShopModel::deleteItem($id);
        self::showIndexPage("Artikel je bil izbrisan!");
     }

    public static function deleteStranka($id){
        ProfileModel::deleteStranka($id);
        self::showIndexPage("Stranka je bil izbrisan!");
    }

    public static function activateItem($id){
        ShopModel::activateItem($id);
        self::showIndexPage("Artikel je bil aktiviran!");
    }

    public static function activateStranka($id){
        ProfileModel::enableStranka($id);
        self::showIndexPage("Stranka je bil aktiviran!");
    }

    public static function deleteZaposleni($id){
        ProfileModel::deleteZaposleni($id);
        self::showIndexPage("Zaposleni je bil izbrisan!");
    }

    public static function activateZaposleni($id){
        ProfileModel::enableZaposleni($id);
        self::showIndexPage("Zaposleni je bil aktiviran!");
    }

    public static function purgeNakup($id){
        ShopModel::purgeNakup($id);
        self::showIndexPage("Nakup je bil storniran!");
    }

    public static function declineNakup($id){
        ShopModel::declineNakup($id);
        self::showIndexPage("Nakup je bil preklican!");
    }

    public static function confirmNakup($id){
        ShopModel::confirmNakup($id);
        self::showIndexPage("Nakup je bil potrjen!");
    }

    public static function concludeNakup($id){
        ShopModel::concludeNakup($id);
        self::showIndexPage("Nakup je bil zaključen!");
    }

    public static function verifyUser() {
        if (isset($_SESSION["profile"]["ID_ZAPOSLENI"])){            
            $id = $_SESSION["profile"]["ID_ZAPOSLENI"];            
            $certifikati = ProfileModel::getCertifikati($id);
            $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
            $cert_data = openssl_x509_parse($client_cert);
            if ($cert_data != false) {
            $hashCommonName = hash('md5', $cert_data['subject']['CN']);
            return (in_array($hashCommonName, $certifikati));
            }
            else return false;
       }
       else return false;
    }
}