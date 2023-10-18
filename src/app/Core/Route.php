<?php

namespace Core;

final class Route // содержит метод, uri, контроллер и метод контроллера для обработки запроса 
{
    private string $method;
    private string $path;
    private string $controller;
    private string $action;

    public function __construct(string $method, string $path, string $controller, string $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}