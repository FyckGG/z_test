<?php

namespace Core;

use Constants\AlertTypes;
use Core\SessionManager;

class Helper // для методов общего назначения
{
    public static function alert(string $message, string $type = AlertTypes::PRIMARY) :void 
    {
        SessionManager::put('alert', ['message' => $message, 'type' => $type]);
    }

}