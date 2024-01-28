<?php

require_once "../models/user.php";

$params = [
    'email' => $_POST["email"],
    'password' => hash('sha256',$_POST["password"]),
    'role_id' => $_POST["role_id"]
];

\models\user::create($params);

header('Location: ../views/login.php');
exit;