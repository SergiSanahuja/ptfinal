<?php

require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['errorPersonatge'])) {  
    unset($_SESSION['errorPersonatge']);
} 

$personatges = new Personatje();




if(isset($_POST['eliminarPersonatge'])){
    $id = $_POST['id'];


    if($personatges->getPersonatge($id)['id_Usuari'] != $_SESSION['user']){
        $_SESSION['errorPersonatge'] = "No tens permisos per a eliminar aquest personatge";
        header("Location: personatges.controller.php");
        exit();
    }


    $nomAvarar = $personatges->getPersonatge($id);

    if($nomAvarar['Img'] != "avatar.png"){
        unlink("../img/".$nomAvarar['Img']);
    }

    $personatges->deletePersonatje($id);
    $_SESSION['successPersonatge'] = "Personatge eliminat correctament";
    header("Location: personatges.controller.php");
    exit();
}else{
    $_SESSION['errorPersonatge'] = "No has seleccionat cap personatge";
    header("Location: personatges.controller.php");
    exit();
}

?>