<?php
session_save_path("../../../sessions");
session_start(); // Avvia la sessione

if(!isset($_SESSION['current_user']))
{
    header('Location: ../../login.php');
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Informazioni Prodotto</title>
</head>
<body>
<link rel="stylesheet" href="../../../css/styles.css">
<div class="title">Crea</div>
<div class="input-container">
<form action="../../../actions/create.php" method="post">
    <br>

    <label for="nome">Nome:</label>
    <input type="text" name="nome">

    <br>

    <label for="prezzo">Prezzo:</label>
    <input type="text" name="prezzo">

    <br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca">

    <br>

    <input type="submit" value="Invia">
</form>
</div>
</body>
</html>