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

    public function getMapa($id){
        $sql = "SELECT * FROM mapas WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapes(){
        $sql = "SELECT * FROM mapas";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function guardarMapa($id, $nomMapa, $titol){
        $sql = "INSERT INTO mapas (id_Usuari, nom_mapa, titol) VALUES ('$id', '$nomMapa', '$titol')";
        $this->connect()->query($sql);
    }

    public function eliminarMapa($id){
        $sql = "DELETE FROM mapas WHERE id = '$id'";
        $this->connect()->query($sql);
    }

}






?>