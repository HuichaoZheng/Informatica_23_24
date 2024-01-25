<?php

namespace models;


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
}
