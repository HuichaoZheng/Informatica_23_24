<?php
require_once "../models/cart_products.php";

$cart_product_id = $_POST['cart_products_id'];

\models\cart_products::delete($cart_product_id);

header('Location: ../views/cart/index.php');