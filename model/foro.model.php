<?php

require_once '../model/db.model.php';


class Foro extends DB{

    //agafa tots els articles de la base de dades
    public function getForo(){
        $sql = "SELECT u.nom,f.id, f.id_Usuari ,f.titol, f.missatge, f.data,f.img  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id ORDER BY data DESC";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //crea un article a la base de dades
    public function crearForo($id, $titulo, $contenido, $img, $data){
        $sql = "INSERT INTO foro (id_Usuari, titol, missatge,img,data) VALUES ('$id', '$titulo', '$contenido', '$img', '$data')";
        $this->connect()->query($sql);
    }

    //agafa els articles de la base de dades de l'usuari que esta loguejat
    public function getForoByID($id){
        $sql = "SELECT u.nom,f.id ,f.id_Usuari ,f.titol, f.missatge, f.data,f.img  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id WHERE f.id_Usuari = '$id' ORDER BY data DESC";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //agafa un article de la base de dades
    public function getContingutArticle($idArticel){
        $sql = "SELECT * FROM foro WHERE id = '$idArticel'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //elimina un article de la base de dades
    public function eliminarForo($id){
        $sql = "DELETE FROM foro WHERE id = '$id'";
        $this->connect()->query($sql);
    }

    //edita un article de la base de dades
    public function editarArticle($id, $titol, $missatge, $data){
        $sql = "UPDATE foro SET titol = '$titol', missatge = '$missatge', data = '$data' WHERE id = '$id'";
        $this->connect()->query($sql);
    }


    //agafa el creador de l'article
    public function getCreadorArticle($id){
        $sql = "SELECT id_Usuari FROM foro WHERE id = '$id'";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>