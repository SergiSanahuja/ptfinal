<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
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
            $_SESSION['username'] = $result['email'];
            $_SESSION['user'] = $result['id'];
            header('Location: ../controlador/index.controler.php');
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