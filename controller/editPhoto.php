<?php
require_once '../models/connection.php';
include_once("../models/users.php");

$login = $_POST["login"];
$img = $_FILES["photo"];

$filename = uploadImage($img);

editPhoto($login, $filename);
header("Location: ".$_SERVER['HTTP_REFERER']);

