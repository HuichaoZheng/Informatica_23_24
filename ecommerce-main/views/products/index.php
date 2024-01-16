<?php
session_save_path("../../sessions");
session_start(); // Avvia la sessione

require_once "../../database.php";
require_once "../../models/products.php";

$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');

$query = "SELECT * FROM products";
$stmt = $pdo->query($query);

$products = $stmt->fetchAll(PDO::FETCH_CLASS,'models\products');

?>
<form action="../login.php">
    <input type="submit" value="logout"/>
</form>
<div>
    <?php foreach ($products as $product): ?>
        <div>
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
            <form action="../../actions/addcart.php">
                <input type="submit" value="Add"/>
            </form>

        <hr> <!-- Linea orizzontale per separare i prodotti -->
    <?php endforeach; ?>
</div>