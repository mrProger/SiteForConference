<?php

$router->post("api/v1/auth", "AuthController::auth");

$router->post("api/v1/registration", "AuthController::registration");

$router->get("/", "PageController::index_page");

$router->get("auth", "PageController::auth_page");

$router->get("registration", "PageController::registration_page");