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
            $orm->connect();
            $user = R::getAll("SELECT * FROM users WHERE BINARY login='$user_model->login' AND BINARY password='".md5($user_model->password)."'");
            if ($user != null) {
                echo "Вы успешно вошли в аккаунт";
                return;
            } else {
                echo "Неверный логин или пароль";
                return;
            }
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
            $user = R::getAll("SELECT * FROM users WHERE BINARY login='$user_model->login'");

            if ($user != null) {
                echo "Пользователь с указанным логином уже зарегистрирован";
                return;
            }

            $user = R::dispense('users');
            $validation_result = $user_model->validate();
            
            if ($validation_result["status"]) {
                $user->login = $user_model->login;
                $user->password = md5($user_model->password);
                R::store($user);
                echo "Аккаунт успешно зарегистрирован";
                return;
            }

            ExceptionHandler::generateError($validation_result["message"]);
        }

        echo "Данные не дошли или неверные имена полей";
    }
}