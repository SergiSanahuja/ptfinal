<?php

require_once '../model/sala.php';
require_once '../model/personatje.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}



if(isset($_POST['codigoSala'])){
    $codigoSala = $_POST['codigoSala'];
    
    
    $salas = new Sala();

    if($salas->getSala($codigoSala) == null){
        $_SESSION['error'] = "La sala no existeix";
         header("Location: index.controler.php");
        exit();
    }else{
        $_SESSION['codigoSala'] = $codigoSala;
        $Personatges = new Personatje();


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