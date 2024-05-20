<?php

require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['error'])) {
    
    unset($_SESSION['error']);
} 


if(isset($_SESSION['user'])){
    $usuario = $_SESSION['user'];
}else{
    $_SESSION['errorLogin'] = "No has iniciat sessió";
    $usuario = null;
}
if (isset($_SESSION['error'])) {
    
    unset($_SESSION['error']);
} 


//Creem un objecte de la classe Personatje
$personatges = new Personatje();

//Cridem a la funció getPersonatjeByUser per a que ens retorni tots els personatges de l'usuari
$llistaPersonatges = $personatges->getPersonatjeByUser($usuario);

if($_SESSION['user'] == 0 || $_SESSION['user'] == null){
    $_SESSION['error'] = "No has iniciat sessió";
    header("Location: index.controler.php");
    exit();
}   







include_once '../vista/personatges.view.php';


?>