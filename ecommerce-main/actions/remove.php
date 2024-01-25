<?php
require_once "../database.php";

$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
$stm = $pdo->prepare("DELETE FROM cart_products WHERE id = :cart_product_id;");
$cart_product_id = $_POST['cart_products_id'];
$stm->bindParam(":cart_product_id", $cart_product_id);
$stm->execute();

header('Location: ../views/cart/index.php');