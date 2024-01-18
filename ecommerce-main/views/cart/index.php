
<?php
session_save_path("../../sessions");


require_once "../../database.php";
require_once "../../models/products.php";
require_once "../../models/user.php";
require_once "../../models/carts.php";
require_once "../../models/cart_products.php";

session_start(); // Avvia la sessione

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

$query = "
        SELECT *
        FROM products
        INNER JOIN cart_products ON products.id  = cart_products.product_id 
        where cart_id = :cart_id
    ";

$cart_id = $cart->getId();

$stmt = $pdo->prepare($query);
$stmt->bindParam(':cart_id', $cart_id);
$stmt->execute();

$cart_products= $stmt->fetchAll(PDO::FETCH_CLASS,'models\cart_products');
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

        .product-details {
            margin-bottom: 10px;
        }

        .add-to-cart-btn {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
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
    <form action="../login.php">
        <input type="submit" value="Logout"/>
    </form>
    <form action="../products/index.php">
        <input type="submit" value="Products"/>
    </form>
</header>

<div class="products-container">
    <?php foreach ($cart_products as $cart_product): ?>
        <div class="product">
            <div class="product-details">
                <label>ID:</label>
                <div><?php echo $cart_product->getProduct_id(); ?></div>
                <label>Nome:</label>
                <div><?php echo $cart_product->getNome(); ?></div>
                <label>Prezzo:</label>
                <div><?php echo $cart_product->getPrezzo(); ?></div>
                <label>Marca:</label>
                <div><?php echo $cart_product->getMarca(); ?></div>
                <label>Quantità:</label>
                <div><?php echo $cart_product->getQuantita(); ?></div>
                <label>Prezzo totale:</label>
                <div><?php echo $cart_product->getQuantita() *  $cart_product->getPrezzo(); ?></div>
            </div>
            <form action="../../actions/remove.php" method="POST">
                <input type="hidden" name ="cart_products_id" value="<?php echo $cart_product->getId()?>">
                <button type="submit" class="add-to-cart-btn">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<hr>

<!-- Altri elementi della pagina, se necessario -->

</body>
</html>

