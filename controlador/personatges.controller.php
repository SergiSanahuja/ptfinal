<?php

require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}

if(isset($_SESSION['user'])){
    $usuario = $_SESSION['user'];
}else{
    $_SESSION['error'] = "No has iniciat sessió";
    $usuario = null;
}
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}


$personatges = new Personatje();

$llistaPersonatges = $personatges->getPersonatjeByUser($usuario);

if($_SESSION['user'] == 0 || $_SESSION['user'] == null){
    $_SESSION['error'] = "No has iniciat sessió";
    header("Location: index.controler.php");
    exit();
}




include_once '../vista/personatges.view.php';


?>