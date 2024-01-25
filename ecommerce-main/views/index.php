<?php
session_save_path("../sessions");
session_start(); // Avvia la sessione

require_once "../database.php";
require_once "../models/products.php";

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
        <link rel="stylesheet" href="../css/styles.css">
        <title>Your Store</title>
    </head>
    <body>
    <header>
        <form action="login.php">
            <input type="submit" value="Login"/>
        </form>
        <form action="signup.php">
            <input type="submit" value="Signup"/>
        </form>
    </header>
    <div class="title">Index</div>
    <div class="products-container">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <label>ID:</label>
                <div><?php echo $product->getId(); ?></div>
                <div>
                    <label>Nome:</label>
                    <div><?php echo $product->getNome(); ?></div>
                </div>
                <div>
                    <label>Prezzo:</label>
                    <div><?php echo $product->getPrezzo(); ?></div>
                </div>
                <div>
                    <label>Marca:</label>
                    <div><?php echo $product->getMarca(); ?></div>
                </div>
                <form action="../actions/addcart.php">
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>


    </body>
    </html>