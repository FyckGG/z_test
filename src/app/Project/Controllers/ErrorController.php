<?php

namespace Project\Controllers;
use Core\Controller;
use Core\Page;

class ErrorController extends Controller
{
    public function notFound() :Page
    {
        return $this->render('not_found_view');
    }
}