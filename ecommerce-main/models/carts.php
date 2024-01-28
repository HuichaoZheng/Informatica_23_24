<?php
namespace models;
require_once $_SERVER['DOCUMENT_ROOT']."/database.php";


class carts
{
    private $id;
    private $used_id;

    public function getId() {
        return $this->id;
    }

    // Metodo setter per $id
    public function setId($id) {
        $this->id = $id;
    }

    // Metodo getter per $used_id
    public function getUsedId() {
        return $this->used_id;
    }

    // Metodo setter per $used_id
    public function setUsedId($used_id) {
        $this->used_id = $used_id;
    }

    public static function find($id){
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stmt = $pdo->prepare("SELECT * FROM carts WHERE user_id = :user_id");
        $user_id = $id;
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cart = $stmt->fetchObject('models\carts');
        return $cart;
    }
    public static function create_cart($user_id)
    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("insert into carts (user_id) VALUES (:user_id)");
        $stm->bindParam(":user_id", $user_id);
        $stm->execute();
    }


}