<?php

require_once '../model/sala.php';
require_once '../model/User.model.php';


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
} 




$salas = new Sala();
$Usuari = new User();
$idSala =  crearCodigo();



if($_SESSION['user'] == 0 || $_SESSION['user'] == null){
    $_SESSION['errorLogin'] = "No has iniciat sessió";
    header("Location: index.controler.php");
    exit();
}

if($salas->getSalaByUser($_SESSION['user']) != null){
    $salas->deleteSala($_SESSION['user']);
    $salas->crearSala($idSala,$_SESSION['user']);
}else{
    $salas->crearSala($idSala,$_SESSION['user']);
    
}

$mapas = $Usuari->getMapasUser($_SESSION['user']);


function crearCodigo(){
    $codigo = rand(100000, 999999);
    return $codigo;
}




include_once '../vista/crearSala.view.php';


?>