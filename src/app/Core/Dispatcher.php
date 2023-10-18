<?php

namespace Core;

use Core\Track;
use Core\Page;

class Dispatcher 
{
    public function getPage(Track $track) :Page //вызов контролллера и функции контроллера из track
    {
        $controllerName = ucfirst($track->controller) . 'Controller';
        $controllerFullName = "\\Project\\Controllers\\$controllerName";

        $controller = new $controllerFullName;

        if (method_exists($controller, $track->action))
        {
            $result = $controller->{$track->action}(...$track->params);

            if ($result)
            {
                return $result;
            }
            else
            {
                return new Page('default_layout');
            }
        }

        else echo "Метод <b>{$track->action}</b> не найден в классе $controllerFullName."; 
        die();
    }
}