<?php

//Claves de recapcha
$siteKey= "6LdlFtgpAAAAAEoSuX1wBSbC-O194jDPkZwFezEa";
$secretKey = "6LdlFtgpAAAAABiBoKVr9gUEnW9ypPYHgyFI7q2G";

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}



//Verifica la respuesta de recapcha
if (isset($_POST['g-recaptcha-response'])) {
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse";
    $response = file_get_contents($url);
    $response = json_decode($response);

    if (!$response->success) {
        $_SESSION['error'] = 'Error de reCAPTCHA';
        // Redirige al usuario de vuelta al formulario de inicio de sesión
        header('Location: login.controler.php');
        exit();
    }
}

if(isset($_POST['email']) && isset($_POST['password'])){
    $username = $_POST['email'];
    $password = $_POST['password'];

    require_once '../model/db.model.php';

   

    $db = new DB();
    $sql = "SELECT * FROM usuaris WHERE email = '$username'";
    $query = $db->connect()->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    
   

    if($result){
        if(password_verify($password, $result['Password'])){
            $_SESSION['useremail'] = $result['email'];
            $_SESSION['username'] = $result['nom'];
            $_SESSION['user'] = $result['id'];
            $_SESSION['errorLogin'] = null;
            header('Location: ../index.php');
            exit();
        }else{
            $_SESSION['error'] = 'Contraseña incorrecta';
            
        }
    }else{
        $_SESSION['error'] = 'Usuario no encontrado';
        
       
    }


}else{
    $_SESSION['error'] = 'Rellena todos los campos';
    
}

include_once '../vista/login.php';
?>