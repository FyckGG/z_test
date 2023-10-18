<?php

use Core\Route;
use Constants\RequestsMethods;

return [
    new Route(RequestsMethods::GET_METHOD, '/', 'general', 'index'),
    new Route(RequestsMethods::GET_METHOD, '/customers', 'customer', 'index'),
    new Route(RequestsMethods::GET_METHOD, '/customers/create', 'customer', 'create'),
    new Route(RequestsMethods::POST_METHOD, '/customers', 'customer', 'store'),
    new Route(RequestsMethods::GET_METHOD, '/customers/:customer_id/edit', 'customer', 'edit'),
    new Route(RequestsMethods::PUT_METHOD,  '/customers/:customer_id', 'customer', 'update'),
    new Route(RequestsMethods::DELETE_METHOD, '/customers/:customer_id', 'customer', 'destroy')
]; 