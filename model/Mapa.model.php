<?php


require_once 'db.model.php';


class Mapa extends DB{

    //agafa tots els personatges de la base de dades
    public function getUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapasUser($id){
        $sql = "SELECT * FROM mapas WHERE id_Usuari = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapa($id){
        $sql = "SELECT * FROM mapas WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getQuantitatMapes(){
        $sql = "SELECT COUNT(*) as total FROM mapas";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapes($inicio, $mapasPorPagina){
        $sql = "SELECT * FROM mapas Group by titol LIMIT :inicio, :mapasPorPagina";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
        $stmt->bindParam(':mapasPorPagina', $mapasPorPagina, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function guardarMapa($id, $nomMapa, $titol){
        $sql = "INSERT INTO mapas (id_Usuari, nom_mapa, titol) VALUES (:id, :nomMapa, :titol)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id, 'nomMapa' => $nomMapa, 'titol' => $titol]);


    }

    public function descarregarMapa($id, $nomMapa, $titol){
        $sql = "INSERT INTO mapas (id_Usuari, nom_mapa, titol) VALUES (:id, :nomMapa, :titol)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id, 'nomMapa' => $nomMapa, 'titol' => $titol]);
    }

    public function eliminarMapa($id){
        $sql = "DELETE FROM mapas WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
    }   

}






?>