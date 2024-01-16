<?php

require_once "../database.php";
require_once "../models/user.php";

$email = $_POST["email"];
//$password = hash('sha256',$_POST["password"]);
$password = hash('sha256',$_POST["password"]);
$role_id = $_POST["role_id"];

$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
$stm = $pdo->prepare("insert into users (email, password, role_id) VALUES (:email, :password, :role_id)");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $password);
$stm->bindParam(":role_id", $role_id);
$stm->execute();

header('Location: ../views/login.php');
exit;