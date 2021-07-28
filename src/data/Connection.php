<?php
class Connection
{
    public static function getConnection()
    {
        $database = "dummydb";
        $username = "root";
        $password = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $password);
    }
}
