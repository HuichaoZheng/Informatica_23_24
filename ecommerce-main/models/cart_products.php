<?php

namespace models;
require_once $_SERVER['DOCUMENT_ROOT']."/database.php";

class cart_products {
    private $id;
    private $product_id;
    private $nome;
    private $prezzo;
    private $marca;
    private $quantita;

    // Metodi Getter
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getProduct_id() {
        return $this->product_id;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getQuantita() {
        return $this->quantita;
    }

    // Metodi Setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setQuantita($quantita) {
        $this->quantita = $quantita;
    }

    public static function create($cart, $params){
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("insert into cart_products (cart_id, product_id, quantita) VALUES (:cart_id, :product_id, :quantita)");
        $cart_id = $cart->getId();
        $stm->bindParam(":cart_id", $cart_id);
        $stm->bindParam(":product_id", $params['id']);
        $stm->bindParam(":quantita", $params['quantita']);
        $stm->execute();
    }
    public static function delete($cart_product_id)
    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("DELETE FROM cart_products WHERE id = :cart_product_id;");
        $stm->bindParam(":cart_product_id", $cart_product_id);
        $stm->execute();
    }
}
