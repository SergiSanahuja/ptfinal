<?php

require_once '../model/sala.php';
require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['errorLogin'] = null;


if(isset($_POST['codigoSala'])){
    $codigoSala = $_POST['codigoSala'];
    $idPersonaje = $_POST['Personatge'];
    $_SESSION['idPersonatge'] = $idPersonaje;
    
    // var_dump($_SESSION['idPersonatge']);
    $salas = new Sala();


    if($salas->getSala($codigoSala) == null){
        $_SESSION['errorLogin'] = "La sala no existeix";
         header("Location: ../index.php");
        exit();
    }else{
        $Personatges = new Personatje();      
        $salas = new Sala();

        if($Personatges->getPersonatge($idPersonaje) == null){
            $_SESSION['errorLogin'] = "El personatge no existeix";
            header("Location: ../index.php");
            exit();
        }else if($Personatges->getPersonatge($idPersonaje)['id_Usuari'] != $_SESSION['user']){
            $_SESSION['errorLogin'] = "No pots unirte amb un personatge que no és teu";
            header("Location: ../index.php");
            exit();
        }

        
        $_SESSION['codigoSala'] = $codigoSala;
      


       

        if (isset($_POST['closeRoom'])) {
            $closeRoom = $_POST['closeRoom'];

        
            if ($closeRoom == '1') {
                // Código para cerrar la sala
                $_SESSION['SalaCerrada'] = true;
            } else {
                // Código para abrir la sala
                $_SESSION['SalaCerrada'] = false;
            }
        }


        
            include_once '../vista/unirSala.view.php';
        
        
        
    }
    
    
    


}







?>