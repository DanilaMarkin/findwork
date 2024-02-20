<?php
include_once("../models/connection.php");
include_once("../models/admin.php");

$pdo = Connection::get()->connect();
$auth = new AuthAdmin($pdo);

$email = $_POST['email'];
$password = $_POST['password'];

$countLogin = $auth->countLogins($email, $password);

$error = "";

if ($email === "" or $password === "") {
    $error .= "Поля не должны быть пустыми";
}
if ($countLogin['count'] === 0) {
    $error .= "Неверный логин или пароль";
}

if(!empty($error)) {
    http_response_code(400);
    echo $error;
    die();
}

http_response_code(200);
$userId = $auth->login($email, $password);