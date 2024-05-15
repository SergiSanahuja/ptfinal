<?php

require_once '../model/db.model.php';


class Foro extends DB{

    public function getForo(){
        $sql = "SELECT u.nom,f.id, f.id_Usuari ,f.titol, f.missatge, f.data,f.img  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id ORDER BY data DESC";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearForo($id, $titulo, $contenido, $img, $data){
        $sql = "INSERT INTO foro (id_Usuari, titol, missatge,img,data) VALUES ('$id', '$titulo', '$contenido', '$img', '$data')";
        $this->connect()->query($sql);
    }

    public function getForoByID($id){
        $sql = "SELECT u.nom,f.id ,f.id_Usuari ,f.titol, f.missatge, f.data,f.img  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id WHERE f.id_Usuari = '$id' ORDER BY data DESC";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarForo($id){
        $sql = "DELETE FROM foro WHERE id = '$id'";
        $this->connect()->query($sql);
    }


    public function getCreadorArticle($id){
        $sql = "SELECT id_Usuari FROM foro WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>