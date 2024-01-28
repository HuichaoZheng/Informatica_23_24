<?php

namespace models;

require_once $_SERVER['DOCUMENT_ROOT']."/database.php";

class user
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    private $email;
    private $password;

    private $role_id;
    public function getRole_id()
    {
        return $this->role_id;
    }
    public static function find($params)

    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("select * from ecommerce5E.users where email=:email and password=:password limit 1");
        $stm->bindParam(":email", $params['email']);
        $stm->bindParam(":password", $params['password']);
        $stm->execute();
        return $stm->fetchObject("\models\user");
    }
    public static function create($params)
    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("insert into users (email, password, role_id) VALUES (:email, :password, :role_id)");
        $stm->bindParam(":email", $params['email']);
        $stm->bindParam(":password", $params['password']);
        $stm->bindParam(":role_id", $params['role_id']);
        $stm->execute();
    }
}

