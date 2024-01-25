<?php

require_once "../database.php";

    $nome =$_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $marca = $_POST['marca'];

$pdo = Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
$stm = $pdo->prepare("insert into products (nome, prezzo, marca) VALUES ( :nome, :prezzo, :marca)");
$stm->bindParam(":nome", $nome);
$stm->bindParam(":prezzo", $prezzo);
$stm->bindParam(":marca", $marca);
$stm->execute();

header('Location: ../views/products/show.php');