<?php

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


if(isset($_POST['PersonatgeID'])) {
    $personatgeID = $_POST['PersonatgeID'];

    require_once '../model/personatge.php';

    $personatges = new personatge();

    $personatge = $personatges->getPersonatgeByID($personatgeID);
    
    if($personatge['id_Usuari'] == $usuario) {

        echo json_encode($personatge);


    } else {
        $_SESSION['errorPersonatge'] = "No tens permisos per a editar aquest personatge";
        header("Location: personatges.controler.php");
        exit();
    }

} else {
    $_SESSION['errorPersonatge'] = "No has seleccionat cap personatge";
    header("Location: personatges.controler.php");
    exit();
}



    


?>