<?php

require_once "DBinit.php";

/*
    Profile model includes ZAPOSLENI, STRANKA, NASLOV, KRAJ entities
*/

class ProfileModel {
    // <!-- checks in db if exists --> returns bool
    public static function checkIfPasswordMatchStranke($geslo, $id){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_STRANKA) FROM STRANKA
                                    WHERE GESLO = :geslo AND ID_STRANKA = :id;");
        $password_cypher = hash("crc32", $geslo);
        $statement->bindParam(":geslo", $password_cypher);
        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfPasswordMatchZaposleni($geslo, $id){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_ZAPOSLENI) FROM ZAPOSLENI
                                    WHERE GESLO = :geslo AND ID_ZAPOSLENI = :id;");
        $statement->bindParam(":geslo", $geslo);
        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfStrankaExists($email){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_STRANKA) FROM STRANKA
                                    WHERE EMAIL = :email;");
        $statement->bindParam(":email", $email);

        $statement->execute();
        
        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfStrankaExistsById($id){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_STRANKA) FROM STRANKA
                                    WHERE ID_STRANKA = :id;");
        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetchColumn(0) == 1;
    }

    public static function checkIfZaposleniExistsById($id){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(ID_ZAPOSLENI) FROM ZAPOSLENI
                                    WHERE ID_ZAPOSLENI = :id;");
        $statement->bindParam(":id", $id);

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
                                          GESLO = :geslo AND IZBRISAN = 0 AND AKTIVIRAN = 1;");
        
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
                                          GESLO = :geslo AND IZBRISAN = 0;");

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
    public static function insertStranka($email, $geslo, $ime, $priimek, $idNaslov, $aktiviran){
        $db = DBinit::getInstance();

        $statement = $db->prepare("INSERT INTO STRANKA (IME, PRIIMEK, EMAIL, GESLO, ID_NASLOV, AKTIVIRAN)
                                    VALUES (:ime, :priimek, :email, :geslo, :idNaslov, :aktiviran);");

        $password_cypher = hash("crc32", $geslo);
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":priimek", $priimek);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":geslo", $password_cypher);
        $statement->bindParam(":idNaslov", $idNaslov);
        $statement->bindParam(":aktiviran", $aktiviran);

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

    public static function getStrankaNaslovID($id) {
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT ID_NASLOV FROM STRANKA WHERE ID_STRANKA = :id;");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $naslovID= $statement->fetch();

        if ($naslovID != null) {
            return $naslovID;
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

        $statement = $db->prepare("SELECT * FROM ZAPOSLENI WHERE ID_ZAPOSLENI = :id;");
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

    public static function getNaslovByID($id){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT * FROM NASLOV
                                    WHERE ID_NASLOV = :id;");
        $statement->bindParam(":id", $id);

        $statement->execute();

        $naslov = $statement->fetch();

        if ($naslov != null) {
            return $naslov;
        } else {
            throw new InvalidArgumentException("No record with this address ($id)");
        }
    }

    public static function getKrajByPostna($postna){
        $db = DBinit::getInstance();

        $statement = $db -> prepare("SELECT * FROM KRAJ
                                    WHERE POSTNA_STEVILKA = :postna;");
        $statement->bindParam(":postna", $postna);

        $statement->execute();

        $kraj = $statement->fetch();

        if ($kraj != null) {
            return $kraj;
        } else {
            throw new InvalidArgumentException("No record with this postna ($postna)");
        }
    }

    public static function getCertifikati($id) {
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT CERT FROM ZAPOSLENI WHERE ID_ZAPOSLENI = :id;");
        $statement->bindParam(":id", $id);
        $statement->execute();

        $certifikati = $statement->fetchAll(PDO::FETCH_COLUMN);

        if ($certifikati != null) {
            return $certifikati;
        } else {
            throw new InvalidArgumentException("No certificates");
        }
    }

    public static function checkIfStrankaIsActivated($email) {
        $db = DBinit::getInstance();

        $statement = $db->prepare("SELECT AKTIVIRAN FROM STRANKA WHERE email = :email;");
        $statement->bindParam(":email", $email);
        $statement->execute();

        $aktiviran = $statement->fetchColumn();
        return $aktiviran;
    }

    public static function updateAktiviran($email){
        $db = DBinit::getInstance();

        $statement = $db->prepare("UPDATE STRANKA SET AKTIVIRAN = 1 WHERE EMAIL = :email");
        $statement->bindParam(":email", $email);

        $statement->execute();
    }

    // <!-- update -->

    public static function updateStranka($id, $ime, $priimek, $email, $geslo, $naslovID, $ulica, $hisna, $postna){
        $db = DBinit::getInstance();
        $updateNaslov = $db-> prepare("UPDATE NASLOV SET HISNA_STEVILKA = :hisna, ULICA = :ulica, POSTNA_STEVILKA = :postna
                                                        WHERE ID_NASLOV = :naslovID;");
        $updateNaslov->bindParam(":hisna", $hisna);
        $updateNaslov->bindParam(":ulica", $ulica);
        $updateNaslov->bindParam(":postna", $postna);
        $updateNaslov->bindParam(":naslovID", $naslovID);

        $updateStranka = $db-> prepare("UPDATE STRANKA SET IME = :ime, PRIIMEK = :priimek, EMAIL = :email, GESLO = :geslo
                                                        WHERE ID_STRANKA = :id");
        $password_cypher = hash("crc32", $geslo);
        $updateStranka->bindParam(":ime", $ime);
        $updateStranka->bindParam(":priimek", $priimek);
        $updateStranka->bindParam(":email", $email);
        $updateStranka->bindParam(":geslo", $password_cypher);
        $updateStranka->bindParam(":id", $id);

        $updateNaslov->execute();
        $updateStranka->execute();
        return true;
    }

    public static function updateZaposleni($id, $ime, $priimek, $email, $geslo){
        $db = DBinit::getInstance();

        $updateZaposleni = $db-> prepare("UPDATE ZAPOSLENI SET IME = :ime, PRIIMEK = :priimek, EMAIL = :email, GESLO = :geslo
                                                        WHERE ID_ZAPOSLENI = :id");
        $updateZaposleni->bindParam(":ime", $ime);
        $updateZaposleni->bindParam(":priimek", $priimek);
        $updateZaposleni->bindParam(":email", $email);
        $updateZaposleni->bindParam(":geslo", $geslo);
        $updateZaposleni->bindParam(":id", $id);

        $updateZaposleni->execute();
        return true;
    }


    // <!-- delete -->
    public static function deleteStranka($id){
        $db = DBinit::getInstance();
        $updateStranka = $db-> prepare("UPDATE STRANKA SET IZBRISAN = 1 WHERE ID_STRANKA = :id");
        $updateStranka ->bindParam(":id", $id);

        $updateStranka->execute();
        return true;
    }

    public static function deleteZaposleni($id){
        $db = DBinit::getInstance();
        $updateZaposleni = $db-> prepare("UPDATE ZAPOSLENI SET IZBRISAN = 1 WHERE ID_ZAPOSLENI = :id");
        $updateZaposleni ->bindParam(":id", $id);

        $updateZaposleni->execute();
        return true;
    }

    public static function enableStranka($id){
        $db = DBinit::getInstance();
        $updateStranka = $db-> prepare("UPDATE STRANKA SET IZBRISAN = 0 WHERE ID_STRANKA = :id");
        $updateStranka ->bindParam(":id", $id);

        $updateStranka->execute();
        return true;
    }

    public static function enableZaposleni($id){
        $db = DBinit::getInstance();
        $updateZaposleni = $db-> prepare("UPDATE ZAPOSLENI SET IZBRISAN = 0 WHERE ID_ZAPOSLENI = :id");
        $updateZaposleni ->bindParam(":id", $id);

        $updateZaposleni->execute();
        return true;
    }
}