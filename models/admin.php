<?php
require_once 'connection.php'; //Подключение к бд

class AuthAdmin {
    private $pdo;
    private $hash = 'asdasdadadfktwtwl234';
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function findUser($email)
    {
        $sql = "SELECT * FROM findwork.admins WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function findProfile($email) {
        $sql = "SELECT * FROM findwork.admins JOIN findwork.roles ON admins.id_role = roles.id WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function countLogins($email, $password){
		$password = md5($password . $this->hash);
		$sql = 'SELECT COUNT(*) FROM findwork.admins WHERE email = :email AND password = :password';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$countLogin = $stmt->fetch(PDO::FETCH_ASSOC);
		return $countLogin;
	}
    public function login($email, $password) {
		$findUser = $this->findUser($email);
		$password = md5($password . $this->hash);
		if ($findUser !== null){
			$sql = "SELECT * FROM findwork.admins WHERE email = :email AND password = :password";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':email', $email);
			$stmt->bindValue(':password', $password);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin'] = $user['email'];
	    }
		return false;
    }
    public function logout() {
        unset($_SESSION['admin']);
    }
}
function countUsers(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT COUNT(*) FROM findwork.users';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $countUsers = $statement->fetch(PDO::FETCH_ASSOC);
    return $countUsers;
}
function countVacancy(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT COUNT(*) FROM findwork.vacancy';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $countVacancy = $statement->fetch(PDO::FETCH_ASSOC);
    return $countVacancy;
}
function countEmployer(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT COUNT(*) FROM findwork.employer';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $countEmployer = $statement->fetch(PDO::FETCH_ASSOC);
    return $countEmployer;
}
function latestUsers(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM findwork.users ORDER BY users.id DESC LIMIT 5';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $latestUsers = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $latestUsers;
}
function latestEmployers(){
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM findwork.employer ORDER BY employer.id DESC LIMIT 5';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $latestEmployers = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $latestEmployers;
}
