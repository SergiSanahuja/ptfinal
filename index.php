<?php

require_once './model/personatge.php';


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['errorMapa'] = null;
$_SESSION['successMapa'] = null;
$_SESSION['errorArticle'] = null;
$_SESSION['successArticle'] = null;
$_SESSION['errorPersonatge'] = null;
$_SESSION['successPersonatge'] = null; 

$usuario = null;
if(isset($_SESSION['user'])){
    $usuario = $_SESSION['user'];
}

// if(isset($_SESSION['error'])){
//      $_SESSION['error'];
// }


$Personatge = new personatge();

$llistaPersonatges = $Personatge->getPersonatgeByUser($usuario);

include_once './vista/index.php'


?>