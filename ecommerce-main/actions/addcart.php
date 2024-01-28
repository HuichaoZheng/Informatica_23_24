<?php
    require_once "../models/user.php";
    require_once "../models/carts.php";
    require_once "../models/cart_products.php";

    session_save_path("../sessions");
    session_start();

    $params = [
        'id' => $_POST['product_id'],
        'quantita' => $_POST['quantita']
    ];

    $current_user = $_SESSION['current_user'];

    $cart = \models\carts::find($current_user->getId());

    if(!$cart)
    {
        \models\carts::create_cart($current_user->getId());
        $cart = \models\carts::find($current_user->getId());
    }

    \models\cart_products::create($cart, $params);

    header('Location: ../views/cart/index.php');