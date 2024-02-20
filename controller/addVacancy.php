<?php
include_once("../models/employer.php");

$id_employer = $_POST['id_employer'];
$name = $_POST["name"];
$price = $_POST["price"];
$city = $_POST["city"];
$stage = $_POST["stage"];
$info = $_POST["info"];

$error = "";

if ($name === "" or $$price === "" or $city === "" or $stage === "" or $info === "") {
    $error .= "Поля все должны быть заполнены";
}

if(!empty($error)) {
    http_response_code(400);
    echo $error;
    die();
}

http_response_code(200);
addVacancy($name, $price, $city, $stage, $info, $id_employer);

