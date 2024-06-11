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
                $_SESSION['success'] = 'Usuari registrat correctament';
                $_SESSION['error'] = null;
                header('Location: ../vista/login.php');
                exit();
            }else{
                $_SESSION['error'] = 'Error al registrar el usuari';
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



    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPsw'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPsw = $_POST['confirmPsw'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'Format del correu incorrecte';
            
        }else{

            if($password == $confirmPsw){
                $login = new Login();

                if($login->comprovaEmail($email)){
                    $_SESSION['error'] = 'El email ja està registrat';
                    // header('Location: ../vista/registre.php');
                }else{

                    $login->registre($username, $email, $password);
                }
            }else{
                $_SESSION['error'] = 'Las contrasenyas no coincideixen';
                // header('Location: ../vista/registre.php');
            }
        }
    
    }else{
        $_SESSION['error'] = 'Has d\'omplir tots els camps';
        // header('Location: ../vista/registre.php');
    }

    include_once '../vista/registre.php';

?>