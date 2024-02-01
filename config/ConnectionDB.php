<?php
    class ConnectionDB{
        public static function connect(){
            $db = new mysqli('localhost', 'root', '', 'the__blossom');
            $db->query("SET NAMES 'utf8'");
            return $db;
        }
    }
?>