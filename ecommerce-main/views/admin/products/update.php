<?php
session_save_path("../../../sessions");
session_start(); // Avvia la sessione

if(!isset($_SESSION['current_user']))
{
    header('Location: ../../login.php');
}
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $marca = $_POST['marca'];
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
<form action="../../../actions/update.php" method="post">
    <input type = "hidden" name = "id" value="<?php echo $id?>">
    <br>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $nome?>">

    <br>

    <label for="prezzo">Prezzo:</label>
    <input type="text" name="prezzo" value="<?php echo $prezzo?>">

    <br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" value="<?php echo $marca?>">

    <br>

    <input type="submit" value="Invia">
</form>
</div>

</body>
</html>