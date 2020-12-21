<?php

require_once('/home/ep/NetBeansProjects/seminarska-naloga/Viewhelper.php');
require_once("backend/model/ShopModel.php");
require_once("backend/model/ProfileModel.php");

class DashboardController
{
     private static $VIEWS_PATH = 'frontend/views/dashboard/';

     public static function showIndexPage($message = ""){
         $nakupi = ShopModel::getNakupi();

         if (!empty($message)) {
             ViewHelper::render(self::$VIEWS_PATH . "index.php", ["message" => $message, "nakupi" => $nakupi] );
         } else {
             ViewHelper::render(self::$VIEWS_PATH . "index.php", ["nakupi" => $nakupi]);
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

    public static function showUpdateForm($id){

    }

    public static function updateItem($id){
         ShopModel::updateItem($id);
         self::showIndexPage("Artikel številka $id je bil posodobljen!");
    }
     public static function deleteItem($id){
        ShopModel::deleteItem($id);
        self::showIndexPage("Artikel je bil izbrisan!");
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
       $certifikati = ProfileModel::getCertifikati();
       $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
       $cert_data = openssl_x509_parse($client_cert);
       $commonname = $cert_data['subject']['CN'];
       return (in_array($commonname, $certifikati));
    }
}