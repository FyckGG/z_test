<?php

spl_autoload_register(function (string $class_name) {

    $path = $_SERVER['DOCUMENT_ROOT'] . '/../app/' . $class_name . '.php';
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

    if (is_readable($path))
    {
        require $path;
    }
    else 
    {
        echo "Ошибка при загрузке класса <b>{$class_name}</b>."; 
        die();
    } 
});