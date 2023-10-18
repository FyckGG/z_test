<?php

namespace Project\Controllers;
use Core\Controller;

class GeneralController extends Controller
{
    public function index()
    {
        return $this->render('main');
    }
}