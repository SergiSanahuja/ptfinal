<?php


require_once '../model/db.model.php';
require_once '../model/Mapa.model.php';

if(session_status () == PHP_SESSION_NONE){
    session_start();
}

$User = new Mapa();
$id_Usuari = $_SESSION['user'];




if (isset($_SESSION['errorMapa'])) {
    
    unset($_SESSION['errorMapa']);
} 



if(!isset($_SESSION['user'])){
    $_SESSION['errorLogin'] = "No has iniciat sessió";
    header('Location: ../index.php');
    exit();
}




    
$mapes = $User->getMapasUser($_SESSION['user']);






include '../vista/mapesPropis.view.php';


?>