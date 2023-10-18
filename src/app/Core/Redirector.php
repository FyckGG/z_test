<?php

namespace Core;
use Constants\RequestsMethods;

class Redirector // класс для перенаправления на другую страницу
{
    public static function redirect(string $uri, string $method=RequestsMethods::GET_METHOD) :void
    {
        SessionManager::put('redirect_method', $method);

        $host = EnvManager::get('HOST');
        if (!$host) 
        {
            echo "Ошибка при попытке получения текущего хоста.";
            die();
        }

        $location = EnvManager::get('HOST') . $uri;
        if ($location)
        header("Location: $location");
        die();
    }
}