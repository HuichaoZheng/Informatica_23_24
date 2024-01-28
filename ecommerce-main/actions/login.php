<?php

require_once "../models/user.php";
require_once "../models/session.php";

$params = [
    'email' => $_POST["email"],
    'password' => hash('sha256',$_POST["password"])
];

$current_user = \models\user::find($params);

if ($current_user) {
    session_save_path("../sessions");
    session_start();
    $params=array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId());
    \models\session::Create($params);
    $_SESSION['current_user'] = $current_user;
    if($current_user->getRole_id() == 1)
    header('Location: ../views/products/index.php');
    else if($current_user->getRole_id() == 2)
        header('Location: ../views/products/show.php');
    exit;
} else {
    header('Location: ../views/error.php');
    exit;
}


