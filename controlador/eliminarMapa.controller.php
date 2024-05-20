<?php

require_once '../model/User.model.php';


if(session_status () == PHP_SESSION_NONE){
    session_start();
}



$User = new User();

$id_Usuari = $_SESSION['user'];
$id_Article = $_GET['id'];

$mapa = $User->getMapa($id_Article);



if (isset($_SESSION['error'])) {
    
    unset($_SESSION['error']);
} 


if(!isset($_SESSION['errorLogin'])){
    $_SESSION['error'] = "No has iniciat sessió";
    header('Location: ../controlador/index.controler.php');
    exit();
}

if($mapa['id_usuari'] == $id_Usuari){

    $_SESSION['error'] = null;

    $rutaImagen = "../img/mapa/".$mapa['titol'].".webp";

     // Elimina la imagen
     if (file_exists($rutaImagen)) {
        unlink($rutaImagen);
    }

    $User->eliminarMapa($id_Article);
    header('Location: ../controlador/mapes.controller.php');
    exit();


}else{
    $_SESSION['error'] = "No tens permisos per eliminar aquest mapa";
    header('Location: ../controlador/mapes.controller.php');
    exit();
}

?>