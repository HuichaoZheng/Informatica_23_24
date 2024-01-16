<?php

require_once "../database.php";
require_once "../models/user.php";
require_once "../models/session.php";

$email = $_POST["email"];
$password = hash('sha256',$_POST["password"]);


$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');

$stm = $pdo->prepare("select * from ecommerce5E.users where email=:email and password=:password limit 1");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $password);
$stm->execute();
$current_user = $stm->fetchObject("\models\user");

if ($current_user) {

    session_start();
    $params=array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId());
    \models\session::Create($params);
    $_SESSION['current_user'] = $current_user;
    header('Location: http://localhost:8000/views/products/index.php');
    exit;
} else {
    header('Location: http://localhost:8000/views/login.php');
    exit;
}