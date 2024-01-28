<?php

namespace models;
require_once $_SERVER['DOCUMENT_ROOT']."/database.php";

class products
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;


    public function getId()
    {
        return $this->id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public static function create($params)
    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("insert into products (nome, prezzo, marca) VALUES ( :nome, :prezzo, :marca)");
        $stm->bindParam(":nome", $params['nome']);
        $stm->bindParam(":prezzo", $params['prezzo']);
        $stm->bindParam(":marca", $params['marca']);
        $stm->execute();
    }
    public static function update($params)
    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $query = "
                UPDATE products
                SET nome = :nome, prezzo = :prezzo, Marca = :marca
                WHERE id = :id;
        ";
        $stm = $pdo->prepare($query);
        $stm->bindParam(":nome", $params['nome']);
        $stm->bindParam(":prezzo", $params['prezzo']);
        $stm->bindParam(":marca", $params['marca']);
        $stm->bindParam(":id", $params['id']);
        $stm->execute();
    }

}
