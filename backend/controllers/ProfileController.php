<?php

// URL Martin require_once("Viewhelper.php");
require_once('/home/ep/NetBeansProjects/seminarska-naloga/Viewhelper.php');
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
            ]
        ];
    
        $receivedData = filter_input_array(INPUT_POST, $validation_rules);
        $ProfileExists = ProfileModel::checkIfStrankaExists($receivedData["email"]);
        $passwordsMatch = ($receivedData["geslo"] == $receivedData["potrdi_geslo"]);
                
        if(isset($_POST['g-recaptcha-response'])){
             $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
            self::RegisterForm(true, $receivedData);
        } else {
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $responseKeys = json_decode($response, true);

            if($responseKeys["success"] == 1) {
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
            } else {
                self::RegisterForm(true, $receivedData);
            }
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
                "kraj" => "",
            ];
        }

        if ($showError) {
            ViewHelper::render(self::$VIEWS_PATH . "register.php", ['error' => $showError, 'data' => $data]);
        } else {
            ViewHelper::render(self::$VIEWS_PATH . "register.php", ['data' => $data]);
        }
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

    public static function editProfile() {
        // get post data

        // validate data

        // update profile
    }
}