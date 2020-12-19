<?php

require_once('/home/ep/NetBeansProjects/seminarska-naloga/Viewhelper.php');
require_once("backend/model/ShopModel.php");
require_once("backend/model/ProfileModel.php");

class DashboardController
{
     private static $VIEWS_PATH = 'frontend/views/dashboard/';

     public static function showIndexPage($message = ""){
         if (isset($message)) {
             ViewHelper::render(self::$VIEWS_PATH . "index.php", ["message" => $message] );
         } else {
             ViewHelper::render(self::$VIEWS_PATH . "index.php");
         }

     }
    public static function addItem(){
         ShopModel::addItem();
         self::showIndexPage("Artikel je bil dodan v trgovino");
    }
    public static function showAddForm(){

    }

    public static function showUpdateForm($id){

    }
    public static function updateItem($id){
         ShopModel::updateItem($id);
         self::showIndexPage("Artikel številka $id je bil posodobljen!");
    }
     public static function deleteItem($id){
        ShopModel::deleteItem($id);
        self::showIndexPage("Artikel je bil izbrisan!");
     }
}