<?php

// URL Martin require_once("Viewhelper.php");
include_once "ep/netbeans/seminarska-naloga/Viewhelper.php";
require_once("backend/model/ProfileModel.php");

class ProfileController {

    private static $VIEWS_PATH = 'frontend/views/profile/';

    public static function Register() {
        // validate received POST data 
        $validation_rules = [
            "ime" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/[a-zA-Z]/"]
            ],
            "priimek" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/[a-zA-Z]/"]
            ],
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
            "potrdi_geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
            "ulica" => FILTER_SANITIZE_SPECIAL_CHARS,
            "hisna_stevilka" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^\d+[a-zA-Z]*$/"]
            ],
            "postna_stevilka" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/[0-9]{4}/"]
            ],
            "kraj" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/[a-zA-Z]/"]
            ],
        ];
    
        $receivedData = filter_input_array(INPUT_POST, $validation_rules);
        $ProfileExists = ProfileModel::checkIfStrankaExists($receivedData["email"]);
        $passwordsMatch = ($receivedData["geslo"] == $receivedData["potrdi_geslo"]);
        
        if (!$ProfileExists && $passwordsMatch){
            // insert naslov & kraj -> check first if already exists
            $NaslovExists = ProfileModel::checkIfNaslovExists($receivedData["ulica"], $receivedData["hisna_stevilka"]);
            $KrajExists = ProfileModel::checkIfKrajExists($receivedData["postna_stevilka"]);

            if (!$KrajExists){
                ProfileModel::insertKraj($receivedData["postna_stevilka"], $receivedData["kraj"]);
            }

            if (!$NaslovExists){
                ProfileModel::insertNaslov($receivedData["ulica"], $receivedData["hisna_stevilka"], $receivedData["postna_stevilka"]);
            }
            // add stranka to DB
            $naslovID = ProfileModel::getNaslovID($receivedData["ulica"], $receivedData["hisna_stevilka"])["ID_NASLOV"];
            ProfileModel::insertStranka($receivedData["email"], $receivedData["geslo"], $receivedData["ime"], $receivedData["priimek"], $naslovID);
            // redirect to login
            ViewHelper::redirect(BASE_URL . "/login");
        } else {
            self::RegisterForm(true, $receivedData);
        }
    }

    public static function RegisterForm($showError = false, $data=[]){
        if(empty($data)){
            $data = [
                "ime" => "",
                "priimek" => "",
                "email" => "",
                "geslo" => "",
                "potrdi_geslo" => "",
                "ulica" => "",
                "hisna_stevilka" => "",
                "postna_stevilka" => "",
                "kraj" => ""
            ];
        };

        if ($showError) ViewHelper::render(self::$VIEWS_PATH . "register.php", ['error' => $showError, 'data' => $data]);
        else ViewHelper::render(self::$VIEWS_PATH . "register.php", ['data' => $data]);
    }

    public static function Login() {
        // validate data
        $validation_rules = [
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
        ];

        $receivedData = filter_input_array(INPUT_POST, $validation_rules);
        $email = $receivedData["email"];
        $isZaposleni = preg_match("/^[a-zA-Z]+@{1}(fud.si)$/", $email);
        if ($isZaposleni){
            return self::loginZaposleni($receivedData);
        } else {
            return self::loginStranka($receivedData);
        }
    }

    public static function loginStranka($receivedData) {
        $stranka = ProfileModel::strankaLogin($receivedData["email"], $receivedData["geslo"]);

        if (isset($stranka)){
            // set session
            $_SESSION["profile"] = $stranka;
            //redirect to mainpage
            ViewHelper::redirect(BASE_URL . "");
        } else {
            self::LoginForm(true, $receivedData);
        }
    }

    public static function loginZaposleni($receivedData) {
        $zaposleni = ProfileModel::zaposleniLogin($receivedData["email"], $receivedData["geslo"]);

        if (isset($zaposleni)){
            // set session
            $_SESSION["profile"] = $zaposleni;
            //redirect to dashboard
            ViewHelper::redirect(BASE_URL . "dashboard");
        } else {
            self::LoginForm(true, $receivedData);
        }
        // else
    }

    public static function LoginForm($showError = false, $data = []) {
        if(empty($data)){
            $data = [
                "email" => "",
                "geslo" => "",
            ];
        };
        if ($showError) ViewHelper::render(self::$VIEWS_PATH . "login.php", ['error' => $showError, 'data' => $data]);
        else ViewHelper::render(self::$VIEWS_PATH . "login.php", ['data' => $data]);
    }

    public static function userLoggedIn() {
        return isset($_SESSION["profile"]);
    }

    public static function showProfile($id, $isZaposleni,$message = ""){
    if ($isZaposleni){
        $profile = ProfileModel::getZaposleniById($id);
        ViewHelper::render(self::$VIEWS_PATH . "showProfile.php", ["profile" => $profile]);
    } else {
        $profile = ProfileModel::getStrankaByID($id);
        $naslov  = ProfileModel::getNaslovByID($profile["ID_NASLOV"]);
        $kraj    = ProfileModel::getKrajByPostna($naslov["POSTNA_STEVILKA"]);
        $nakupi  = ShopModel::getNakupiByStranka($id);
        $vars = ["profile" => $profile, "naslov" => $naslov, "kraj" => $kraj,"message" => $message, "nakupi" => $nakupi];
        ViewHelper::render(self::$VIEWS_PATH . "showProfile.php", $vars);
    }
    }

    public static function editProfile() {
        // validate received POST data
        if (isset($_POST["id_stranka"])){
            //            update stranke
            $validation_rules = [
                "ime" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[a-zA-Z]/"]
                ],
                "priimek" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[a-zA-Z]/"]
                ],
                "email" => FILTER_VALIDATE_EMAIL,
                "staro_geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
                "novo_geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
                "ulica" => FILTER_SANITIZE_SPECIAL_CHARS,
                "hisna_stevilka" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/^\d+[a-zA-Z]*$/"]
                ],
                "postna_stevilka" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[0-9]{4}/"]
                ],
                "kraj" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[a-zA-Z]/"]
                ],
            ];

            $receivedData = filter_input_array(INPUT_POST, $validation_rules);
            $OldPasswordMatch = ProfileModel::checkIfPasswordMatchStranke($receivedData["staro_geslo"], $_POST["id_stranka"]);
            $KrajExists = ProfileModel::checkIfKrajExists($receivedData["postna_stevilka"]);
            if (!$KrajExists && $OldPasswordMatch) {
                ProfileModel::insertKraj($receivedData["postna_stevilka"], $receivedData["kraj"]);
            }
            if ($OldPasswordMatch) {
                $ime = $receivedData["ime"];
                $priimek = $receivedData["priimek"];
                $naslovID = ProfileModel::getStrankaNaslovID($_POST["id_stranka"])["ID_NASLOV"];
                $email = $receivedData["email"];
                $geslo = $receivedData["novo_geslo"];
                $ulica = $receivedData["ulica"];
                $hisna = $receivedData["hisna_stevilka"];
                $postna = $receivedData["postna_stevilka"];
                $update = ProfileModel::updateStranka($_POST["id_stranka"], $ime, $priimek, $email, $geslo, $naslovID, $ulica, $hisna, $postna);
                if ($update) {
                    self::showProfile($_POST["id_stranka"], false, "Posodobitev uspešna!");
                } else {
                    self::showProfile($_POST["id_stranka"], false, "Napaka pri posodobitvi!");
                }
            }

        } else {
            //            update zaposleni
            $id = $_POST["id_zaposleni"];
            $validation_rules = [
                "ime" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[a-zA-Z]/"]
                ],
                "priimek" => [
                    "filter" => FILTER_VALIDATE_REGEXP,
                    "options" => ["regexp" => "/[a-zA-Z]/"]
                ],
                "email" => FILTER_VALIDATE_EMAIL,
                "staro_geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
                "novo_geslo" => FILTER_SANITIZE_SPECIAL_CHARS
                ];
            $receivedData = filter_input_array(INPUT_POST, $validation_rules);
            $email = $receivedData["email"];
            $ime = $receivedData["email"];
            $priimek = $receivedData["email"];
            $geslo = $receivedData["novo_geslo"];
            $OldPasswordMatch = ProfileModel::checkIfPasswordMatchZaposleni($receivedData["staro_geslo"], $id);
            $rightEmail = preg_match("/^[a-zA-Z]+@{1}(fud.si)$/", $email);
            if ($OldPasswordMatch && $rightEmail){
               $update = ProfileModel::updateZaposleni($id, $ime, $priimek, $email, $geslo);
                if ($update) {
                    self::showProfile($_POST["id_stranka"], false, "Posodobitev uspešna!");
                } else {
                    self::showProfile($_POST["id_stranka"], false, "Napaka pri posodobitvi!");
                }
            }
        }
    }

    public static function Logout() {
        session_destroy();
        ViewHelper::redirect(BASE_URL . "");
    }

    public static function deleteProfile(){
        if (isset($_POST["id_stranka"])) {
            $id = $_POST["id_stranka"];
            ProfileModel::deleteStranka($id);
        } else {
            $id = $_POST["id_zaposleni"];
            ProfileModel::deleteZaposleni($id);
        }
        self::Logout();
    }

//    API ENDPOINTS
    public static function getStranke(){
        $stranke = ProfileModel::getAllStranke();
        $response = json_encode($stranke);
        echo $response;
    }

    public static function getZaposleni() {
        $zaposleni = ProfileModel::getAllZaposleni();
        $response = json_encode($zaposleni);
        echo $response;
    }

    public static function getStrankaById($id){
        $stranka = ProfileModel::getStrankaByID($id);
        $response = json_encode($stranka);
        echo $response;
    }

    public static function getZaposleniById($id){
        $zaposleni = ProfileModel::getStrankaByID($id);
        $response = json_encode($zaposleni);
        echo $response;
    }
}