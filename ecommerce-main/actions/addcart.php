<?php
    require_once "../database.php";
    require_once "../models/user.php";
    require_once "../models/carts.php";

    session_save_path("../sessions");
    session_start();
    $product_id = $_POST['product_id'];
    $quantita = $_POST['quantita'];

    $pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');

    $current_user = $_SESSION['current_user'];

    $stmt = $pdo->prepare("SELECT * FROM carts WHERE user_id = :user_id");
    $user_id = $current_user->getId();
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $cart = $stmt->fetchObject('models\carts');

    if(!$cart)
    {
        $stm = $pdo->prepare("insert into carts (user_id) VALUES (:user_id)");
        $stm->bindParam(":user_id", $user_id);
        $stm->execute();
        $stmt = $pdo->prepare("SELECT * FROM carts WHERE user_id = :user_id");
        $user_id = $current_user->getId();
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cart = $stmt->fetchObject('models\carts');
    }

    $pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
    $stm = $pdo->prepare("insert into cart_products (cart_id, product_id, quantita) VALUES (:cart_id, :product_id, :quantita)");
    $cart_id = $cart->getId();
    $stm->bindParam(":cart_id", $cart_id);
    $stm->bindParam(":product_id", $product_id);
    $stm->bindParam(":quantita", $quantita);
    $stm->execute();

    header('Location: ../views/cart/index.php');