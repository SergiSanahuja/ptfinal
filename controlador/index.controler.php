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

// if(isset($_SESSION['error'])){
//      $_SESSION['error'];
// }


$Personatge = new Personatje();

$llistaPersonatges = $Personatge->getPersonatjeByUser($usuario);

include_once '../vista/index.php'


?>