<?php

require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}



$usuario = $_SESSION['user'];


if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}

$Personatges = new Personatje();


$llistaPersonatges = $Personatges->getPersonatjeByUser($usuario);

include_once '../vista/index.php'


?>