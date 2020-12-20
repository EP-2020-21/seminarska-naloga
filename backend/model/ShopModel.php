
<?php

require_once "DBinit.php";

class ShopModel { 
    // <!-- CREATE -->
    public static function addItem($naziv, $opis, $cena, $slika, $kategorija){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO PONUDBA (PATH_TO_IMG, CENA, OPIS, NAZIV_ARTIKEL, KATEGORIJA )
                                    VALUES (:slika, :cena, :opis, :naziv, :kategorija);");
        $statement->bindParam(":slika", $slika);
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":kategorija", $kategorija);

        $statement->execute();
    }
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

        $statement = $db->prepare("SELECT * FROM KATEGORIJA;");
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