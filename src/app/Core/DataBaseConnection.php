<?php

namespace Core;

use mysqli;

final class DataBaseConnection //singleton для подключения к бд
{
    private static ?mysqli $connection = null;
    
    protected function __construct() {}
    protected function __clone():void {}

    public static function getConnection(): mysqli 
    {
        if (self::$connection === null) {
            self::$connection = new mysqli('mysql', DB_USER, DB_PASSWORD, DB_NAME);
            if (mysqli_connect_errno() !== 0)
            {
                $connectionError = self::$connection->connect_error;
                echo "Ошибка при подключении к базе данных: $connectionError";
                die();
            }
        }

        return self::$connection;
    }
}