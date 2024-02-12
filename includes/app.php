<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    $db = conectarDB();
    use Model\ActiveRecord;

    ActiveRecord::setDB($db);

    define('TEMPLATES_URL',__DIR__ . '/templates');
    define('FUNCIONES_URL',__DIR__ . 'funciones.php');
?>