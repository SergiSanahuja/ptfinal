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

        if($_POST['Fuerza'] < 0 || $_POST['Fuerza'] > 20){
            $_SESSION['error'] = 'La força ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Vida'] < 0 || $_POST['Vida'] > 9999){
            $_SESSION['error'] = 'La vida ha d\'estar entre 0 i 9999';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Iniciativa'] < 0 || $_POST['Iniciativa'] > 20){
            $_SESSION['error'] = 'La iniciativa ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Constitucion'] < 0 || $_POST['Constitucion'] > 20){
            $_SESSION['error'] = 'La constitució ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Destreza'] < 0 || $_POST['Destreza'] > 20){
            $_SESSION['error'] = 'La destresa ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Inteligencia'] < 0 || $_POST['Inteligencia'] > 20){
            $_SESSION['error'] = 'La intel·ligència ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Sabiduria'] < 0 || $_POST['Sabiduria'] > 20){
            $_SESSION['error'] = 'La saviesa ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['Carisma'] < 0 || $_POST['Carisma'] > 20){
            $_SESSION['error'] = 'El carisma ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        if($_POST['nivel'] < 0 || $_POST['nivel'] > 20){
            $_SESSION['error'] = 'El nivell ha d\'estar entre 0 i 20';
            header("Location: personatges.controler.php");
            exit();
        }

        
        $personatge = $personatges->updatePersonatge($personatgeID, $_POST['Fuerza'], $_POST['Vida'], $_POST['Iniciativa'], $_POST['Constitucion'], $_POST['Destreza'], $_POST['Inteligencia'], $_POST['Sabiduria'], $_POST['Carisma'], $_POST['nivel']);

        
        echo json_encode($personatge);
    } else {
        $_SESSION['error'] = "No tens permisos per a editar aquest personatge";
        header("Location: personatges.controler.php");
        exit();
    }

}
  


?>