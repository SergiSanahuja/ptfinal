<?php

require_once '../model/Mapa.model.php';


if(session_status () == PHP_SESSION_NONE){
    session_start();
}



$User = new Mapa();

$id_Usuari = $_SESSION['user'];
$id_Article = $_GET['id'];

$mapa = $User->getMapa($id_Article);



if (isset($_SESSION['errorMapa'])) {
    
    unset($_SESSION['errorMapa']);
} 



if($mapa['id_usuari'] == $id_Usuari){

    $_SESSION['error'] = null;

    // $rutaImagen = "../img/mapa/".$mapa['titol'].".webp";

    //  // Elimina la imagen
    // if (file_exists($rutaImagen)) {
    //     unlink($rutaImagen);
    // }

    $User->eliminarMapa($id_Article);

    unlink("../img/mapa/".$mapa['titol'].".webp");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();


}else{
    $_SESSION['errorMapa'] = "No tens permisos per eliminar aquest mapa";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>