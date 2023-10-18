<?php

declare(strict_types = 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

use Core\DataBaseConnection;
use Core\Router;
use Core\Dispatcher;
use Core\View;
use Constants\RequestsMethods;
use Core\SessionManager;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../autoload.php';

SessionManager::startOnce();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/connection.php';

DataBaseConnection::getConnection();

$routes = require $_SERVER['DOCUMENT_ROOT'] . '/../routes/web.php';

$requestSpecificMethods = [RequestsMethods::GET_METHOD, RequestsMethods::POST_METHOD, RequestsMethods::PUT_METHOD, RequestsMethods::DELETE_METHOD];

if (is_string(SessionManager::get('redirect_method')) // определяем метод запроса
&& in_array(strtoupper(SessionManager::get('redirect_method')), $requestSpecificMethods)) 
$requestMethod = strtoupper(SessionManager::pull('redirect_method'));
elseif (isset($_REQUEST['_method']) && in_array(strtoupper($_REQUEST['_method']), $requestSpecificMethods)) $requestMethod = strtoupper($_REQUEST['_method']);
else $requestMethod = $_SERVER['REQUEST_METHOD'];

$track = (new Router)->getTrack(strtok($_SERVER['REQUEST_URI'], '?'), $requestMethod, ...$routes);

$page = (new Dispatcher)->getPage($track);

echo (new View) -> render($page);