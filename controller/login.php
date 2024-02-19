<?php 
include_once("../models/connection.php");
include_once("../models/users.php");

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);

$login = $_POST['email'];
$email = $_POST['email'];
$password = $_POST['password'];

$countLogin = $auth->countLogins($login, $password);

$error = "";

if ($login === "" or $password === "") {
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
$userId = $auth->login($login, $email, $password);