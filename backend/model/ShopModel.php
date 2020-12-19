
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

    public static function getItemById($id){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM PONUDBA WHERE ID_ARTIKEL = :id;");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $item = $statement->fetch();
        if ($item != null) {
            return $item;
        } else {
            throw new InvalidArgumentException("No record with $id");
        }
    }


    public static function getKategorije(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM KATEGORIJE;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getItemsWithKategorija($kategorijaID){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM PONUDBA WHERE KATEGORIJA=:id;");
        $statement->bindParam("id", $kategorijaID);
        $statement->execute();

        $items = $statement->fetchAll();
        if ($items != null) {
            return $items;
        } else {
            throw new InvalidArgumentException("No record with $kategorijaID");
        }

    }
    // <!-- UPDATE -->

    // <!-- DELETE --> 

}