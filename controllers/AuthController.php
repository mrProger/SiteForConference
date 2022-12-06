<?php

// Подключение моделей
include __DIR__ . '/../models/User.php';

use PHPExceptionHandler\ExceptionHandler;

class AuthController {
    // Написать чтение данных пользователя из бд по логину и паролю...
    public static function auth() {
        global $router, $orm;

        $data = $router->getPostRouteData();

        if (isset($data["login"], $data["password"])) {
            $user_model = new User($data["login"], md5($data["password"]));
        }

        echo "Данные не дошли или неверные имена полей";
    }

    // Добавить проверку, что логин не занят
    public static function registration() {
        global $router, $orm;

        $data = $router->getPostRouteData();
        
        if (isset($data["login"], $data["password"])) {
            $user_model = new User($data["login"], md5($data["password"]));
            $orm->connect();
            $user = R::dispense('users');
            $validation_result = $user_model->validate();
            
            if ($validation_result["status"]) {
                $user->login = $user_model->login;
                $user->password = $user_model->password;
                R::store($user);
                echo "Аккаунт успешно зарегистрирован";
                return;
            }

            ExceptionHandler::generateError($validation_result["message"]);
        }

        echo "Данные не дошли или неверные имена полей";
    }
}