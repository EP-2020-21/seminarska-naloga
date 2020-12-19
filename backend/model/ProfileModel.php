<?php

require_once "DBinit.php";

/*
    Profile model includes ZAPOSLENI, STRANKA, NASLOV, KRAJ entities
*/

class ProfileModel {
    // <!-- checks in db if exists --> returns bool
    public static function checkIfStrankaExists($email){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_STRANKA) FROM STRANKA
                                    WHERE EMAIL = :email;");
        $statement->bindParam(":email", $email);

        $statement->execute();
        
        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfNaslovExists($ulica, $hisna){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_NASLOV) FROM NASLOV
                                    WHERE ULICA = :ulica AND
                                          HISNA_STEVILKA = :hisna;");
        $statement->bindParam(":ulica", $ulica);
        $statement->bindParam(":hisna", $hisna);

        $statement->execute();
        
        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfKrajExists($postna){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(POSTNA_STEVILKA) FROM KRAJ
                                    WHERE POSTNA_STEVILKA = :postna;");
        $statement->bindParam(":postna", $postna);

        $statement->execute();
        
        return $statement->fetchColumn(0) == 1;
    }

    /*
    * Checks if valid login && returns profile id
    */
    public static function strankaLogin($email, $geslo){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_STRANKA) FROM STRANKA
                                    WHERE EMAIL = :email AND
                                          GESLO = :geslo;");
        
        $password_cypher = hash("crc32", $geslo);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":geslo", $password_cypher);

        $statement->execute();
        
        $valid = $statement->fetchColumn(0) == 1;

        if ($valid){
            $stranka = self::getStrankaByEmail($email);
            return $stranka;
        } else {
            return null;
        }
    }

    public static function zaposleniLogin($email, $geslo){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_ZAPOSLENI) FROM ZAPOSLENI
                                    WHERE EMAIL = :email AND
                                          GESLO = :geslo;");

        $statement->bindParam(":email", $email);
        $statement->bindParam(":geslo", $geslo);

        $statement->execute();

        $valid = $statement->fetchColumn(0) == 1;

        if ($valid){
            $zaposleni = self::getZaposleniByEmail($email);
            return $zaposleni;
        } else {
            return null;
        }
    }


    // <!-- create -->
    public static function insertStranka($email, $geslo, $ime, $priimek, $idNaslov){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO STRANKA (IME, PRIIMEK, EMAIL, GESLO, ID_NASLOV)
                                    VALUES (:ime, :priimek, :email, :geslo, :idNaslov );");

        $password_cypher = hash("crc32", $geslo);
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":priimek", $priimek);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":geslo", $password_cypher);
        $statement->bindParam(":idNaslov", $idNaslov);

        $statement->execute();
    }

    public static function insertNaslov($ulica, $hisna, $postna){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO NASLOV (ULICA, HISNA_STEVILKA, POSTNA_STEVILKA)
                                    VALUES (:ulica, :hisna, :postna);");
        $statement->bindParam(":ulica", $ulica);
        $statement->bindParam(":hisna", $hisna);
        $statement->bindParam(":postna", $postna);

        $statement->execute();
    }

    public static function insertKraj($postna, $kraj){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO KRAJ (POSTNA_STEVILKA, KRAJ)
                                    VALUES (:postna, :kraj);");
        $statement->bindParam(":postna", $postna);
        $statement->bindParam(":kraj", $kraj);

        $statement->execute();
    }

    // <!-- read -->

    public static function getAllStranke(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM STRANKA;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAllZaposleni(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM ZAPOSLENI;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getStrankaByID($id){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM STRANKA WHERE ID_STRANKA = :id;");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $stranka = $statement->fetch();

        if ($stranka != null) {
            return $stranka;
        } else {
            throw new InvalidArgumentException("No record with $id");
        }
    }

    public static function getStrankaByEmail($email){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM STRANKA WHERE email = :email;");
        $statement->bindParam(":email", $email);
        $statement->execute();

        $stranka = $statement->fetch();

        if ($stranka != null) {
            return $stranka;
        } else {
            throw new InvalidArgumentException("No record with $email");
        }
    }

    public static function getZaposleniByID($id){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM ZAPOSLENI WHERE ID_STRANKA = :id;");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $zaposleni = $statement->fetch();

        if ($zaposleni != null) {
            return $zaposleni;
        } else {
            throw new InvalidArgumentException("No record with $id");
        }
    }

    public static function getZaposleniByEmail($email){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM ZAPOSLENI WHERE email = :email;");
        $statement->bindParam(":email", $email);
        $statement->execute();

        $zaposleni = $statement->fetch();

        if ($zaposleni != null) {
            return $zaposleni;
        } else {
            throw new InvalidArgumentException("No record with $email");
        }
    }

    public static function getNaslovID($ulica, $hisna){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT ID_NASLOV FROM NASLOV
                                    WHERE ULICA = :ulica AND
                                          HISNA_STEVILKA = :hisna;");
        $statement->bindParam(":ulica", $ulica);
        $statement->bindParam(":hisna", $hisna);

        $statement->execute();

        $naslovID = $statement->fetch();

        if ($naslovID != null) {
            return $naslovID;
        } else {
            throw new InvalidArgumentException("No record with this address ($ulica $hisna)");
        }
    }
    
    // <!-- update -->
    
    // <!-- delete -->
}