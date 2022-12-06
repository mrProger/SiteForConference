<?php

// Подключение системных библиотек
include __DIR__ . '/app/PHPRouter/Router.php';
include __DIR__ . '/app/PHPOrm/MySQL.php';
include __DIR__ . '/app/PHPTemplater/Template.php';
include __DIR__ . '/app/PHPView/View.php';
include __DIR__ . '/app/PHPRequester/Request.php';

// Подключение системных пространств имен
use PHPRouter\Router;
use PHPRequester\Request;

// Создание системных объектов
$router = new Router();
$orm = new MySQL("localhost", "root", "", "conference_site");
$request = new Request();

// Подключение контроллеров
include __DIR__ . '/controllers/PageController.php';
include __DIR__ . '/controllers/AuthController.php';

// Подключение файла с маршрутами
include __DIR__ . '/routes/web.php';

$router->exec();
