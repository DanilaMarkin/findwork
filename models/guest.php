<?php
require_once 'connection.php'; //Подключение к бд

function getVacancy() {
    $pdo = Connection::get()->connect();
    $sql = "SELECT * FROM findwork.vacancy JOIN findwork.employer ON vacancy.id_employer = employer.id";
    $statement = $pdo->prepare($sql);
	$statement->execute();
	return $statement->fetchALL(PDO::FETCH_ASSOC);
}
