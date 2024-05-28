<?php

require_once 'db.model.php';


class personatge extends DB{

    //agafa tots els personatges de la base de dades
    public function getPersonatges(){
        $sql = "SELECT * FROM personatge";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //crea un personatge a la base de dades
    public function crearPersonatge($id, $raza, $clase, $nombre, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma, $imagen){
        $sql = "INSERT INTO personatges (id_Usuari, raza, clase, nom, Fuerza, Vida, Iniciativa, Constitucion, Destreza, Inteligencia, Sabiduria, Carisma, Img) VALUES ('$id', '$raza', '$clase', '$nombre', '$fuerza', '$vida', '$iniciativa', '$constitucion', '$destreza', '$inteligencia', '$sabiduria', '$carisma', '$imagen')";
        $this->connect()->query($sql);
    }

    //agafa els personatges de la base de dades de l'usuari que esta loguejat
    public function deletepersonatge($id){
        $sql = "DELETE FROM personatges WHERE id = '$id'";
        $this->connect()->query($sql);
    }

    //agafa un personatge de la base de dades
    public function getPersonatge($id){
        $sql = "SELECT * FROM personatges WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //elimina un personatge de la base de dades
    public function updatePersonatge($id, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma,$nivel){
        $sql = "UPDATE personatges SET Fuerza = '$fuerza', Vida = '$vida', Iniciativa = '$iniciativa', Constitucion = '$constitucion', Destreza = '$destreza', Inteligencia = '$inteligencia', Sabiduria = '$sabiduria', Carisma = '$carisma', nivel = '$nivel' WHERE id = '$id'";

        $this->connect()->query($sql);
    }


    //agafa el personatge de l'usuari
    public function getPersonatgeByUser($id){
        $sql = "SELECT * FROM personatges WHERE id_Usuari = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //agafa el personatge per la id
    public function getPersonatgeByID($id){
        $sql = "SELECT * FROM personatges WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


}




?>