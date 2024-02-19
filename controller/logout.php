<?php
include_once '../models/connection.php';
include_once '../models/users.php';

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);

$auth->logout();

header('Location: ../pages/vacancy.php');