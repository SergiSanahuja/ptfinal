<?php


require_once 'DB.model.php';

class userDAO extends DB{

    public function __construct(){
        parent::__construct();
    }

    public function getUserByEmail($email){
        $query = $this->connect()->prepare('SELECT * FROM usuaris WHERE email = :email');
        $query->execute(['email' => $email]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserById($id){
        $query = $this->connect()->prepare('SELECT * FROM usuaris WHERE id = :id');
        $query->execute(['id' => $id]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function updateToken($token, $email, $expiracio){
        $query = $this->connect()->prepare('UPDATE usuaris SET token = :token, expiracio = :expiracio WHERE email = :email');
        $query->execute(['token' => $token, 'expiracio' => $expiracio, 'email' => $email]);
    }
    

    public function setUser($nom, $cognom, $email, $usuari, $contrasenya){
        $query = $this->connect()->prepare('INSERT INTO usuaris (nom, cognom, email, usuari, contrasenya) VALUES (:nom, :cognom, :email, :usuari, :contrasenya)');
        $query->execute(['nom' => $nom, 'cognom' => $cognom, 'email' => $email, 'usuari' => $usuari, 'contrasenya' => $contrasenya]);
    }

    public function setRecoveryToken($id, $recoveryToken){
        $query = $this->connect()->prepare('UPDATE usuaris SET token = :token WHERE id = :id');
        $query->execute(['token' => $recoveryToken, 'id' => $id]);
    }

    public function getUserByToken($token){
        $query = $this->connect()->prepare('SELECT * FROM usuaris WHERE token = :token');
        $query->execute(['token' => $token]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function updatePassword($id, $password){
        $query = $this->connect()->prepare('UPDATE usuaris SET contrasenya = :contrasenya WHERE id = :id');
        $query->execute(['contrasenya' => $password, 'id' => $id]);
    }

    public function deleteUser($id){
        $query = $this->connect()->prepare('DELETE FROM usuaris WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}






?>