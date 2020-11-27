<?php

require_once("ViewHelper.php");
require_once("../model/ProfileModel.php");

class ProfileController {

    private static $VIEWS_PATH = 'frontend/views/profile/';

    public static function Register() {
        // get post data

        // validate data

        // insert naslov -> check first if already exists

        // get back naslov_id

        //insert stranka

        //redirect to login

    }

    public static function Login() {
        // get post data

        // validate data

        //check if login succesfull

        //redirect to mainpage

    }

    public static function editProfile() {
        // get post data

        // validate data

        // update profile
    }
}