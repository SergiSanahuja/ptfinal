<?php

require_once '../model/personatge.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['errorMapa'] = null;
$_SESSION['successMapa'] = null;
$_SESSION['errorArticle'] = null;
$_SESSION['successArticle'] = null;


if(isset($_SESSION['user'])){
    $usuario = $_SESSION['user'];
}else{
    $_SESSION['errorLogin'] = "No has iniciat sessió";

    header("Location: ../index.php");
    exit();
}



//Creem un objecte de la classe personatge
$personatges = new personatge();

//Cridem a la funció getPersonatgeByUser per a que ens retorni tots els personatges de l'usuari
$llistaPersonatges = $personatges->getPersonatgeByUser($usuario);



include_once '../vista/personatges.view.php';


?>