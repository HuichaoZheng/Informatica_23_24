<?php
session_save_path("../../sessions");
session_start(); // Avvia la sessione

if(!isset($_SESSION['current_user']))
{
    header('Location: ../login.php');
}

require_once "../../database.php";
require_once "../../models/products.php";

$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');

$query = "SELECT * FROM products";
$stmt = $pdo->query($query);

$products = $stmt->fetchAll(PDO::FETCH_CLASS,'models\products');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Your Store</title>
</head>
<body>
<header>
    <form action="../logout.php">
        <input type="submit" value="Logout"/>
    </form>
    <form action="../cart/index.php">
        <input type="submit" value="Cart"/>
    </form>
</header>

<div class ="title">
    Prodotti
</div>

<div class="products-container">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <div class="product-details">
                <label>ID:</label>
                <div><?php echo $product->getId(); ?></div>
                <label>Nome:</label>
                <div><?php echo $product->getNome(); ?></div>
                <label>Prezzo:</label>
                <div><?php echo $product->getPrezzo(); ?></div>
                <label>Marca:</label>
                <div><?php echo $product->getMarca(); ?></div>
            </div>
            <form action="../../actions/addcart.php" method="POST">
                <input type ="text" name="quantita", value="1">
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<hr>
</body>
</html>