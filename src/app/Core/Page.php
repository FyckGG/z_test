<?php

namespace Core;

class Page // содержит части - названия файлов и переменные одного представления
{
    private string $layout;
    private string $title;
    private ?string $view;
    private array $data;

    public function __construct(string $layout, string $title = '', string $view = null, array $data = [])
    {
        $this->layout = $layout;
        $this->title = $title;
        $this->view = $view;
        $this->data = $data;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}