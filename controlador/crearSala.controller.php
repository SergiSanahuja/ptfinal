<?php

require_once '../model/sala.php';


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}



$salas = new Sala();
$idSala =  crearCodigo();



if($_SESSION['user'] == 0 || $_SESSION['user'] == null){
    $_SESSION['error'] = "No has iniciat sessió";
    header("Location: index.controler.php");
    exit();
}

if($salas->getSalaByUser($_SESSION['user']) != null){
    $salas->deleteSala($_SESSION['user']);
    $salas->crearSala($idSala,$_SESSION['user']);
}else{
    $salas->crearSala($idSala,$_SESSION['user']);
    
}





function crearCodigo(){
    $codigo = rand(100000, 999999);
    return $codigo;
}




include_once '../vista/crearSala.view.php';


?>