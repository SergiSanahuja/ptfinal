<?php

require_once '../model/db.model.php';
require_once '../model/personatge.php';


class User extends DB{
    private $id;
    private $email;
    private $usuari;
    private $contrasenya;

    public function __construct(){
        parent::__construct();
    }

    public function setUser($email, $usuari, $contrasenya){
    
        $this->email = $email;
        $this->usuari = $usuari;
        $this->contrasenya = $contrasenya;
    }

    public function getUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuaris WHERE id = :user');
        $query->execute(['user' => $user]);

        foreach($query as $currentUser){
            $this->id = $currentUser['id'];
            $this->email = $currentUser['email'];
            $this->contrasenya = $currentUser['Password'];
        }

        return $currentUser;
    }

    public function deleteAccount($user){


    // Elimina el inventario de todos los personajes del usuario
        $query = $this->connect()->prepare('DELETE inventario FROM inventario INNER JOIN personatges ON inventario.id_personatge = personatges.id WHERE personatges.id_usuari = :user');
        $query->execute(['user' => $user]);

    // Elimina los personajes del usuario
        $query = $this->connect()->prepare('DELETE FROM personatges WHERE id_usuari = :user');
        $query->execute(['user' => $user]);

    // Elimina los comentarios
        $query = $this->connect()->prepare('DELETE FROM articles WHERE id_usuari = :user');
        $query->execute(['user' => $user]);

    // Elimina las salas
        $query = $this->connect()->prepare('DELETE FROM salas WHERE ID_Admin = :user');
        $query->execute(['user' => $user]);

    // Elimina los mapas
        $query = $this->connect()->prepare('DELETE FROM mapas WHERE id_usuari = :user');
        $query->execute(['user' => $user]);
        
    // Elimina el usuario
        $query = $this->connect()->prepare('DELETE FROM usuaris WHERE id = :user');
        $query->execute(['user' => $user]);
        


    }

    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUsuari(){
        return $this->usuari;
    }

    public function getContrasenya(){
        return $this->contrasenya;
    }
}






?>

