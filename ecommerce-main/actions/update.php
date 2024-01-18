<?php
    require_once "../database.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$prezzo = $_POST['prezzo'];
$marca = $_POST['marca'];
$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
$query = "
    UPDATE products
    SET nome = :nome, prezzo = :prezzo, Marca = :marca
    WHERE id = :id;
";
$stm = $pdo->prepare($query);
$stm->bindParam(":nome", $nome);
$stm->bindParam(":prezzo", $prezzo);
$stm->bindParam(":marca", $marca);
$stm->bindParam(":id", $id);
$stm->execute();
header('Location: ../views/products/show.php');
