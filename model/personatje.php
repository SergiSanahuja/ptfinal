<?php

require_once 'db.model.php';


class Personatje extends DB{

    public function getPersonatjes(){
        $sql = "SELECT * FROM personatje";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearPersonatje($id, $raza, $clase, $nombre, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma, $imagen){
        $sql = "INSERT INTO personatges (id_Usuari, raza, clase, nom, Fuerza, Vida, Iniciativa, Constitucion, Destreza, Inteligencia, Sabiduria, Carisma, Img) VALUES ('$id', '$raza', '$clase', '$nombre', '$fuerza', '$vida', '$iniciativa', '$constitucion', '$destreza', '$inteligencia', '$sabiduria', '$carisma', '$imagen')";
        $this->connect()->query($sql);
    }

    public function deletePersonatje($id){
        $sql = "DELETE FROM personatges WHERE id = '$id'";
        $this->connect()->query($sql);
    }

    public function getPersonatje($id){
        $sql = "SELECT * FROM personatges WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updatePersonatje($id, $raza, $clase, $nombre, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma, $imagen){
        $sql = "UPDATE personatges SET raza = '$raza', clase = '$clase', nombre = '$nombre', fuerza = '$fuerza', vida = '$vida', iniciativa = '$iniciativa', constitucion = '$constitucion', destreza = '$destreza', inteligencia = '$inteligencia', sabiduria = '$sabiduria', carisma = '$carisma', imagen = '$imagen' WHERE id = '$id'";

        $this->connect()->query($sql);
    }


    public function getPersonatjeByUser($id){
        $sql = "SELECT * FROM personatges WHERE id_Usuari = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   


}




?>