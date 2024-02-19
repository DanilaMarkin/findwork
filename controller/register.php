<?php 
include_once("../models/connection.php");
include_once("../models/users.php");

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);

$login = $_POST["login"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$error = "";

$countLogin = $auth->countUserLogin($login);
$countEmail = $auth->countUserEmail($email);

if ($login === "" or $name === "" or $surname === "" or $email === "" or $password === "") {
    $error .= "Все поля должны быть заполнены <br />";
}
if ($password !== $confirm_password) {
    $error .= "Пароль не совпадает <br />";
}
if ($countLogin > 0) {
    $error .= "Такой логин уже существует <br />";
}
if ($countEmail > 0) {
    $error .= "Такая почта уже существует <br />";
}
if (!empty($error)) {
    http_response_code(400);
    echo $error;
    die();
}

http_response_code(200);
$userId = $auth->register($login, $name, $surname, $email, $password);