<?php
require_once 'connection.php'; //Подключение к бд
class AuthEmployer {
    private $pdo;
    private $hash = 'asdasdadadfktwtwl234';
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function findUser($login, $email)
    {
        $sql = "SELECT * FROM findwork.employer WHERE login = :login AND email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
	public function findProfile($login) {
		$sql = 'SELECT * FROM findwork.employer WHERE login = :login LIMIT 1';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		$row_count = $stmt->rowCount();
		if($row_count !== 0) {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
    public function countUserLogin($login)
    {
        $sql = 'SELECT COUNT(*) FROM findwork.employer WHERE login = :login';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $countLogin = $stmt->fetchColumn();
        return $countLogin;
    }
    public function countUserEmail($email)
    {
        $sql = 'SELECT COUNT(*) FROM findwork.employer WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $countEmail = $stmt->fetchColumn();
        return $countEmail;
    }
    public function register($login, $email, $name, $password)
    {
        $findUser = $this->findUser($login, $email);
        $password = md5($password . $this->hash);
        if ($findUser === false){
            $sql = 'INSERT INTO findwork.employer (login, email, name, password) VALUES (:login, :email, :name, :password)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
        }
        return false;
    }

	public function login($login, $email, $password) {
		$findUser = $this->findUser($login, $email);
		$password = md5($password . $this->hash);
		if ($findUser !== null){
			$sql = "SELECT * FROM findwork.employer WHERE (login = :login OR email = :login) AND password = :password";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':login', $login);
			$stmt->bindValue(':password', $password);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['employer'] = $user['login'];
	    }
		return false;
    }
    public function countLogins($login, $password){
		$password = md5($password . $this->hash);
		$sql = 'SELECT COUNT(*) FROM findwork.employer WHERE (login = :login OR email = :login) AND password = :password';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$countLogin = $stmt->fetch(PDO::FETCH_ASSOC);
		return $countLogin;
	}
    public function logout()
	{
        unset($_SESSION['employer']);
    }

	public function isAuthed() {
		if (array_key_exists('user', $_SESSION) && $_SESSION['user'] !== null) {
			return true;
		} else {
			return false;
		}
	}
	public function getCurrentUser() {
		if ($this->isAuthed()) {
			return $this->findProfile($_SESSION['employer']);
		}
		return false;
	}
}

function addVacancy($work, $price, $city, $stage, $info, $id_employer) {
    $pdo = Connection::get()->connect();
	$sql = 'INSERT INTO findwork.vacancy (work, price, city, stage, info, id_employer) VALUES(:work, :price, :city, :stage, :info, :id_employer)';
	$statement = $pdo->prepare($sql);
	$statement->bindValue(":work", $work);
	$statement->bindValue(":price", $price);
	$statement->bindValue(":city", $city);
	$statement->bindValue(":stage", $stage);
	$statement->bindValue(":info", $info);
	$statement->bindValue(":id_employer", $id_employer);
	$statement->execute();
}
