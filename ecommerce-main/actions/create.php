<?php

require_once "../models/products.php";
    $params = [
        'nome' => $_POST['nome'],
        'prezzo' => $_POST['prezzo'],
        'marca' => $_POST['marca']
    ];

\models\products::create($params);

header('Location: ../views/products/show.php');