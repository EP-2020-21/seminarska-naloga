<?php

require_once "DBinit.php";

class UserModel {
    // <!-- create -->
    public static function insertStranka($email, $geslo, $ime, $priimek, $idNaslov){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO STRANKA (IME, PRIIMEK, EMAIL, GESLO, DATUMREGISTRACIJE, ID_NASLOV)
                                    VALUES (:ime, :priimek, :email, :geslo, :datumreg, :idNaslov );");

        $password_cypher = hash("crc32", $geslo);
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":priimek", $priimek);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":geslo", $password_cypher);
        $statement->bindParam(":datumreg", date("Y-M-D"));
        $statement->bindParam(":idNaslov", $idNaslov);

        $statement->execute();
    }

    // <!-- read -->

    public static function getAllStranke(){
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT * FROM STRANKE;");
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
    
    // <!-- update -->
    
    // <!-- delete -->
}