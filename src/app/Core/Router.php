<?php

namespace Core;

use Core\Route;
use Core\Track;

class Router // устанавливает для запроса корректную обработку путём возврата частей роута в виде экземпляра класса track
{
  public function getTrack(string $uri, string $method, Route ...$routes) :Track
  {
    foreach ($routes as $route)
    {
        $pattern = $this->createPattern($route->path);

        if (preg_match($pattern, $uri, $params) && $route->method === $method)
        {
            $params = $this->clearParams($params);

            return new Track($route->controller, $route->action, $params, $route->method);
        }
    }

    return new Track('error', 'notFound');

  }

  private function createPattern(string $path) :string
	{
		return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '/?$#';
	}

    private function clearParams(array $params) :array
	{
		$result = [];
			
		foreach ($params as $key => $param) {
			if (!is_int($key)) {
				$result[$key] = $param;
			}
		}
			
		return $result;
	}

}
