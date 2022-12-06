<?php

use PHPView\View;
use PHPTemplater\Template;
use PHPExceptionHandler\ExceptionHandler;

class PageController {
    public static function index_page() {
        $template = new Template(__DIR__ . "/../pages/index.html");
        echo View::createFromTemplate($template);
    }

    public static function auth_page() {
        $template = new Template(__DIR__ . "/../pages/auth.html");
        echo View::createFromTemplate($template);
    }

    public static function registration_page() {
        $template = new Template(__DIR__ . "/../pages/registration.html");
        echo View::createFromTemplate($template);
    }

    public static function generate_error() {
        ExceptionHandler::generateError("Тестовое исключение");
    }
}