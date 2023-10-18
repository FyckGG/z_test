<?php

namespace Core;

use Constants\RequestsMethods;

class Track // хранит части роута
{
  private string $controller;
  private string $action;
  private array $params;
  private string $method;

  public function __construct(string $controller, string $action, array $params = [], string $method = RequestsMethods::GET_METHOD)
  {
    $this->controller = $controller;
    $this->action = $action;
    $this->params = $params;
    $this->method = $method;
  }

  public function __get($propertry)
  {
    return $this->$propertry;
  }
}