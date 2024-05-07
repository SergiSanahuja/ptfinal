<?php

require_once '../model/personatje.php';


if(session_status() === PHP_SESSION_NONE) {
    session_start();
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





include_once '../vista/index.php'


?>