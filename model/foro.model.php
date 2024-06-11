<?php

require_once '../model/db.model.php';


class Foro extends DB{

    //agafa tots els articles de la base de dades
 
    public function getForo(){
        $sql = "SELECT u.nom,f.id, f.id_Usuari ,f.titol, f.missatge, f.data  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id ORDER BY data DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //crea un article a la base de dades
    public function crearArticle($id, $titulo, $contenido, $data){
        $sql = "INSERT INTO foro (id_Usuari, titol, missatge,data) VALUES (:id, :titulo, :contenido, :data)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id, 'titulo' => $titulo, 'contenido' => $contenido,  'data' => $data]);
    }

    //agafa els articles de la base de dades de l'usuari que esta loguejat
    public function getForoByID($id){
        $sql = "SELECT u.nom,f.id ,f.id_Usuari ,f.titol, f.missatge, f.data  FROM foro f JOIN usuaris u ON f.id_Usuari = u.id WHERE f.id_Usuari = :id ORDER BY data DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //agafa un article de la base de dades
    public function getContingutArticle($idArticel){
        $sql = "SELECT * FROM foro WHERE id = :idArticel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['idArticel' => $idArticel]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //elimina un article de la base de dades
    public function eliminarForo($id){
        $sql = "DELETE FROM foro WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);

    }

    //edita un article de la base de dades
    public function editarArticle($id, $titol, $missatge, $data){
        $sql = "UPDATE foro SET titol = :titol , missatge = :missatge, data = :fecha WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id, 'titol' => $titol, 'missatge' => $missatge, 'fecha' => $data]);
        
    }


    //agafa el creador de l'article
    public function getCreadorArticle($id){
        $sql = "SELECT id_Usuari FROM foro WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>