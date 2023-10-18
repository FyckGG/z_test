<?php

namespace Core;
class EnvManager { // менеджер для переменных окружения

   private static string $envPath = __DIR__ . '/../../.env';

   private static function getEnv() :array
     {
        $envPath = self::$envPath;
        $env = parse_ini_file($envPath);
        if (!$env) {
         echo "Не найден env файл по пути $envPath"; die();
        } 

        return $env;
     } 
     

     public static function get(string $variableName) :string|bool
     {
        $env = self::getEnv();
        if (isset($env[$variableName])) return $env[$variableName];
        return false;
     }
} 