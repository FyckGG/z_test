<?php 

namespace Core;

final class SessionManager //класс для работы с сессией
{
    private static bool $didStart = false;

    protected function __construct() {}
    protected function __clone():void {}
    
    public static function get(string $name) :string|array|bool
    {
        if (!isset($_SESSION[$name])) return false;
        return $_SESSION[$name];
    }

    public static function startOnce() :void
    {
        if (!self::$didStart) 
        {
            session_start();
        };
        self::$didStart = true;
    }

    public static function put(string $name, string|bool|array $value) :void
    {
        $_SESSION[$name] = $value;
    }

    public static function pull(string $name) :string|array|false
    {
        if (!isset($_SESSION[$name])) return false;

        $value = $_SESSION[$name];
        
        unset($_SESSION[$name]);
        return $value;

    }
}