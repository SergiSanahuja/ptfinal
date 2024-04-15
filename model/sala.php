<?php

require_once 'db.model.php';

class Sala extends DB{

    public function getSalas(){
        $sql = "SELECT * FROM salas";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearSala($id, $idAdmin){
        $sql = "INSERT INTO salas (Codi_sala,ID_Admin) VALUES ('$id','$idAdmin')";
        $this->connect()->query($sql);
    }

    public function deleteSala($id){
        $sql = "DELETE FROM salas WHERE ID_Admin = '$id'";
        $this->connect()->query($sql);
    }

    public function getSalaByUser($id){
        $sql = "SELECT * FROM salas WHERE ID_Admin = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSala($id){
        $sql = "SELECT * FROM salas WHERE Codi_sala = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateSala($id){
        $sql = "UPDATE salas SET Codi_sala = '$id'";

        $this->connect()->query($sql);
    }


};



?>
