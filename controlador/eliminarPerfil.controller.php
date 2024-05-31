<?php

require_once('../model/user.model.php');



if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST['submit'])){
    
    $password = $_POST['password'];

    $idUser = $_SESSION['user'];

    $usuari = new User();

    $user = $usuari->getUser($idUser);

    if(password_verify($password, $user['Password'])){
        $usuari->deleteAccount($idUser);
        session_destroy();
        header('Location: ../vista/login.php');
        exit();
    }else{
        $_SESSION['errorDelete'] = 'Contrasenya incorrecta';
        header('Location: perfil.controller.php');
        exit();
    }

}else{
    header('Location: ../vista/login.php');
    exit();
}





?>