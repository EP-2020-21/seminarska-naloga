
<?php

require_once "DBinit.php";

class ShopModel { 
    // <!-- CREATE -->

    // <!-- READ -->
    public static function getAll(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM PONUDBA;");
        $statement->execute();

        return $statement->fetchAll();
    }
    // <!-- UPDATE -->

    // <!-- DELETE --> 

}