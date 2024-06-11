<?php

require_once 'db.model.php';

class Sala extends DB{

    //agafa ttes les sales de la base de dades
    public function getSalas(){
        $sql = "SELECT * FROM salas";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearSala($id, $idAdmin){
        $sql = "INSERT INTO salas (Codi_sala,ID_Admin) VALUES (:id, :idAdmin)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id, 'idAdmin' => $idAdmin]);
    }

    public function deleteSala($id){
        $sql = "DELETE FROM salas WHERE ID_Admin = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function getSalaByUser($id){
        $sql = "SELECT * FROM salas WHERE ID_Admin = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSala($id){
        $sql = "SELECT * FROM salas WHERE Codi_sala = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateSala($id){
        $sql = "UPDATE salas SET Codi_sala = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);

      
    }

    public function UsuarisConectats($id){
        $sql = "SELECT Usuaris_Conectats FROM salas WHERE Codi_sala = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function UsuarisEnSala($UsuarisConectats, $id){
        $sql = "UPDATE salas SET Usuaris_Conectats = :UsuarisConectats WHERE Codi_sala = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['UsuarisConectats' => $UsuarisConectats, 'id' => $id]);
    }


};



?>
