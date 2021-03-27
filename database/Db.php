<?php
abstract class Db {
    private static $conn;

    public static function getInstance(){
        if(self::$conn != null){
            echo "🚫";
            return self::$conn;
        } else{
            self::$conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            return self::$conn;
        }

    }
}