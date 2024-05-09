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

$personatges = new Personatje();

if(isset($_POST['eliminarPersonatge'])){
    $id = $_POST['id'];

    $nomAvarar = $personatges->getPersonatje($id);

    if($nomAvarar['Img'] != "avatar.png"){
        unlink("../img/".$nomAvarar['Img']);
    }

    $personatges->deletePersonatje($id);
    header("Location: personatges.controller.php");
    exit();
}else{
    $_SESSION['error'] = "No has seleccionat cap personatge";
    header("Location: personatges.controller.php");
    exit();
}

?>