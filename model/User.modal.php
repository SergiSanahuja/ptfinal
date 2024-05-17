<?php


require_once 'db.model.php';


class User extends DB{

    //agafa tots els personatjes de la base de dades
    public function getUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapasUser($id){
        $sql = "SELECT * FROM mapas WHERE id_Usuari = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}






?>