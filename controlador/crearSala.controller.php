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


$salas->crearSala($idSala);




function crearCodigo(){
    $codigo = rand(100000, 999999);
    return $codigo;
}




include_once '../vista/crearSala.view.php';


?>