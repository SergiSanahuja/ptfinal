<?php

require_once '../model/sala.php';

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
        
        include_once '../vista/unirSala.view.php';
    }
    
    


}







?>