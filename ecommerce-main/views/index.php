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
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            header {
                text-align: right;
                padding: 10px;
                background-color: #f0f0f0;
            }

            form {
                display: inline-block;
                margin-left: 10px;
            }

            .products-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
                padding: 20px;
            }

            .product {
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 5px;
            }

            label {
                font-weight: bold;
            }

            hr {
                margin: 20px 0;
                border: none;
                border-top: 1px solid #ddd;
            }
        </style>
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
                    <!-- Aggiungi qui gli input necessari per l'aggiunta al carrello -->
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>

    <!-- Altri elementi della pagina, se necessario -->

    </body>
    </html>