<?php

namespace models;

//require_once "../database.php";

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
    public static function Find($id)

    {
        $pdo = \Database::Connessione('localhost', 'ecommerce5E', '/config.txt');
        $stm = $pdo->prepare("select * from sessions where id=:id");
        $stm->bindParam("id", $id);
        if ($stm->execute()) {
            return $stm->fetchObject("session");
        } else {
            throw new PDOException("Errore nella find");
        }
    }
}

