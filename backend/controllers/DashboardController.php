<?php


class DashboardController {
    
    private static $VIEWS_PATH = 'frontend/views/dashboard/';

    public static function showIndexPage($message = ""){
         if (isset($message)) {
             ViewHelper::render(self::$VIEWS_PATH . "index.php", ["message" => $message] );
         } else {
             ViewHelper::render(self::$VIEWS_PATH . "index.php");
         }

     }
    public static function addItem(){
        $naziv = $_POST["naziv"];
        $opis  = $_POST["opis"];
        $cena  = $_POST["cena"];
        $slika = $_FILES['slika'];
        $kategorija = $_POST["kategorija"];
        $slikaDir = "frontend/static/images/ponudba/";
        $slikaName = basename($_FILES['slika']['name']);
        $targetFile = $slikaDir . $slikaName;
        $imageOK = self::checkUploadImage($targetFile, $slika);

        if ($imageOK){
            //var_dump($uploadedSlika);
            //echo $uploadedSlika["url"];
            //ShopModel::addItem($naziv, $opis, $cena, $slika, $kategorija);
            //self::showIndexPage("Artikel je bil dodan v trgovino");
        } else {
            echo "ni slo!";
            //self::showAddForm(); // error msg
        }

    }

    public static function checkUploadImage($target_file, $slika) {
        if ($slika["size"] > 500000){
            return false;
        }

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
            return false;
        }

        return true;
     }

    public static function showAddForm(){
         ViewHelper::render(self::$VIEWS_PATH . "addItem.php");
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

    public static function verifyUser() {
       $certifikati = ProfileModel::getCertifikati();
       $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
       $cert_data = openssl_x509_parse($client_cert);
       $commonname = $cert_data['subject']['CN'];
       return (in_array($commonname, $certifikati));
    }
}