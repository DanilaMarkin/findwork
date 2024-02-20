<?php 
include_once("../models/connection.php");
include_once("../models/employer.php");

$pdo = Connection::get()->connect();
$auth = new AuthEmployer($pdo);

$login = $_POST['login'];
$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$error = "";

$countLogin = $auth->countUserLogin($login);
$countEmail = $auth->countUserEmail($email);

if ($login === "" or $email === "" or $name === "" or $password === "" or $confirm_password === "") {
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
$userId = $auth->register($login,$email, $name, $password);