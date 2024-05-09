<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}


if(isset($_SESSION['user'])){
    $usuario = $_SESSION['user'];
}else{
    $_SESSION['error'] = "No has iniciat sessió";
    $usuario = null;
}

if(isset($_POST['PersonatgeID'])) {
    $personatgeID = $_POST['PersonatgeID'];
    require_once '../model/personatje.php';

    $personatges = new Personatje();

    $personatge = $personatges->getPersonatgeByID($personatgeID);
    
    if($personatge['id_Usuari'] == $usuario) {

        $personatge = $personatges->updatePersonatje($personatgeID, $_POST['Fuerza'], $_POST['Vida'], $_POST['Iniciativa'], $_POST['Constitucion'], $_POST['Destreza'], $_POST['Inteligencia'], $_POST['Sabiduria'], $_POST['Carisma'], $_POST['nivel']);

        
        echo json_encode($personatge);
    } else {
        $_SESSION['error'] = "No tens permisos per a editar aquest personatge";
        header("Location: personatges.controler.php");
        exit();
    }

}
  


?>