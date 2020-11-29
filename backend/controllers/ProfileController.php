<?php

require_once("ViewHelper.php");
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
            // "potrdi_geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
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

        if (!$ProfileExists){
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
            self::RegisterForm();
        }
    }

    public static function RegisterForm(){
        ViewHelper::render(self::$VIEWS_PATH . "register.php");
    }

    public static function Login() {
        // validate data
        $validation_rules = [
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
        ];

        $receivedData = filter_input_array(INPUT_POST, $validation_rules);
        //check if login succesfull
        $stranka = ProfileModel::strankaLogin($receivedData["email"], $receivedData["geslo"]);
        
        if (isset($stranka)){
            // set session
            $_SESSION["profile"] = $stranka;
            //redirect to mainpage
            ViewHelper::redirect(BASE_URL . "");
        } else {
            self::LoginForm();
        }
    }

    public static function LoginForm() {
        ViewHelper::render(self::$VIEWS_PATH . "login.php");
    }

    public static function editProfile() {
        // get post data

        // validate data

        // update profile
    }
}