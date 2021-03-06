
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

    public static function insertNakup($stranka, $totalValue, $items){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("INSERT INTO NAKUP (ID_STATUS, ID_STRANKA, SKUPNA_CENA) VALUES (1, :stranka,:cena);");
        $statement->bindParam(":stranka", $stranka);
        $statement->bindParam(":cena", $totalValue);
        $statement->execute();
        $nakupID = $db->lastInsertId();

        $statement2 = $db -> prepare("INSERT INTO IZBRANI_ARTIKLI (ID_ARTIKEL, IDNAKUPA, KOLICINA) VALUES (:id, :nakup,:kol);");
        foreach ($items as $item){
            $statement2->bindParam(":id", $item["itemID"]);
            $statement2->bindParam(":nakup", $nakupID);
            $statement2->bindParam(":kol", $item["kolicina"]);
            $statement2->execute();
        }
    }
    // <!-- READ -->
    public static function getAll(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM PONUDBA;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAllActive(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM PONUDBA WHERE IZBRISAN = 0;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getNakupi(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM NAKUP N JOIN STRANKA S ON S.ID_STRANKA = N.ID_STRANKA;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getNakupiByStranka($id){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM NAKUP WHERE ID_STRANKA = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getArtikliByNakup($idNakup){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM IZBRANI_ARTIKLI IA JOIN PONUDBA A ON IA.ID_ARTIKEL = A.ID_ARTIKEL WHERE IA.IDNAKUPA = :id;");
        $statement->bindParam(":id", $idNakup);
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
    public static function concludeNakup($idNakupa) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE NAKUP SET ID_STATUS = 5, DATUMCAS_SPREMEMBE = :now WHERE IDNAKUPA = :id");
        $now = date("Y-m-d h:i:s");
        $statement->bindParam(":id", $idNakupa);
        $statement->bindParam(":now", $now);


        $statement->execute();
    }


    public static function confirmNakup($idNakupa) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE NAKUP SET ID_STATUS = 2, DATUMCAS_SPREMEMBE = :now WHERE IDNAKUPA = :id");
        $now = date("Y-m-d h:i:s");
        $statement->bindParam(":id", $idNakupa);
        $statement->bindParam(":now", $now);

        $statement->execute();
    }

    public static function purgeNakup($idNakupa) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE NAKUP SET ID_STATUS = 3, DATUMCAS_SPREMEMBE = :now WHERE IDNAKUPA = :id");
        $now = date("Y-m-d h:i:s");
        $statement->bindParam(":id", $idNakupa);
        $statement->bindParam(":now", $now);

        $statement->execute();
    }

    public static function declineNakup($idNakupa) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE NAKUP SET ID_STATUS = 4, DATUMCAS_SPREMEMBE = :now WHERE IDNAKUPA = :id");
        $now = date("Y-m-d h:i:s");
        $statement->bindParam(":id", $idNakupa);
        $statement->bindParam(":now", $now);

        $statement->execute();
    }

    public static function deleteItem($id) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE PONUDBA SET IZBRISAN = 1 WHERE ID_ARTIKEL = :id");
        $statement->bindParam(":id", $id);

        $statement->execute();
    }

    public static function activateItem($id) {
        $db = DBinit::getInstance();

        $statement = $db ->prepare("UPDATE PONUDBA SET IZBRISAN = 0 WHERE ID_ARTIKEL = :id");
        $statement->bindParam(":id", $id);

        $statement->execute();
    }

    public static function editItem($id, $naziv, $opis, $cena, $slika, $kategorija){
        $db = DBinit::getInstance();

        $statement = $db->prepare("UPDATE PONUDBA SET PATH_TO_IMG = :slika, CENA = :cena, NAZIV_ARTIKEL = :naziv,
                                            OPIS = :opis, KATEGORIJA = :kategorija WHERE ID_ARTIKEL = :id;");

        $statement->bindParam(":id", $id);
        $statement->bindParam(":slika", $slika);
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":kategorija", $kategorija);

        $statement->execute();
    }
    // <!-- DELETE --> 

}