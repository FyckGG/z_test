<?php

namespace Core;

abstract class Controller
{
    protected $layout = 'default_layout';
    protected $title = 'Page title';

    protected function render($view, $data = []) :Page
    {
        return new Page($this->layout, $this->title, $view, $data);
    }
}