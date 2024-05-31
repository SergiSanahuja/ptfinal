<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}



if(isset($_SESSION['user'])){
    $idUser = $_SESSION['user'];
    require_once('../model/user.model.php');
    $usuari = new User();



    

    $user = $usuari->getUser($idUser);

    include_once('../vista/perfil.view.php');

}else{
    header('Location: ../vista/login.php');
    exit();
}





?>