<?php
   if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }


    class Login{
        private $db;
        private $username;
        private $email;
        private $password;

        public function __construct(){
            require_once '../model/db.model.php';
            $this->db = new DB();
        }

        public function registre($username, $email, $password){
            $this->username = $username;
            $this->email = $email;

            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $password;

            $sql = "INSERT INTO usuaris (nom, email, password) VALUES ('$this->username', '$this->email', '$this->password')";
            $query = $this->db->connect()->query($sql);

            if($query){
                $_SESSION['success'] = 'Usuario registrado correctamente';
                header('Location: ../vista/login.php');
            }else{
                $_SESSION['error'] = 'Error al registrar el usuario';
                // header('Location: ../vista/registre.php');
            }
        }


        public function comprovaEmail($email){
            $this->email = $email;

            $sql = "SELECT * FROM usuaris WHERE email = '$this->email'";
            $query = $this->db->connect()->query($sql);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }


    require_once '../model/login.model.php';


    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPsw'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPsw = $_POST['confirmPsw'];


        if($password == $confirmPsw){
            $login = new Login();

            if($login->comprovaEmail($email)){
                $_SESSION['error'] = 'El email ya está registrado';
                // header('Location: ../vista/registre.php');
            }else{

                $login->registre($username, $email, $password);
            }
        }else{
            $_SESSION['error'] = 'Las contraseñas no coinciden';
            // header('Location: ../vista/registre.php');
        }
    
    }else{
        $_SESSION['error'] = 'Rellena todos los campos';
        // header('Location: ../vista/registre.php');
    }

    include_once '../vista/registre.php';

?>