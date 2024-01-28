<?php

    require_once "../models/products.php";
    $params =[
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'prezzo' => $_POST['prezzo'],
        'marca' => $_POST['marca']
    ];


    \models\products::update($params);
header('Location: ../views/products/show.php');
