<?php

function addUser($firstname,$lastname,$phone,$email)
{
    $pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");

    $sql = "INSERT INTO users (firstname,lastname,phone,email) VALUES (:firstname, :lastname, :phone, :email)";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(":firstname", $firstname);
    $statement->bindParam(":lastname", $lastname);
    $statement->bindParam(":phone", $phone);
    $statement->bindParam(":email", $email);
    $statement->execute();
}

function editUser($id, $firstname,$lastname,$phone,$email)
{
    $pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");

    $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone, email = :email WHERE id = :userid";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(":firstname", $firstname);
    $statement->bindParam(":lastname", $lastname);
    $statement->bindParam(":phone", $phone);
    $statement->bindParam(":email", $email);
	$statement->bindParam(":userid", $id);
    $statement->execute();
}

function getUser($user_id){
    $pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");

    $sql = "SELECT * FROM users  WHERE id=:userid";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(":userid", $user_id);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function getUsers(){
    $pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");
    $statement = $pdo->prepare("SELECT * FROM users");
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function deleteUsers($usersIds) {
	$pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");
	$sql = 'DELETE FROM users WHERE id IN (' . implode(', ', $usersIds) . ')';
	$statement = $pdo->prepare($sql);
	$statement->execute();
}

function deleteUser($userId) {
        $pdo = new PDO ("mysql:host=localhost;dbname=testtask","root","");
        $sql = 'DELETE FROM users WHERE id=:userId';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":userId", $userId);
        $statement->execute();
  //  }
    
}

$apiconn = mysqli_connect('localhost', 'root', '', 'testtask');
date_default_timezone_set('Europe/Kiev');
$date = date('Y-m-d G:i:s');