<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once '../model/User.model.php';


$usuario = new User();
$idMapa = $_GET['id'];
$id_usuario = $_SESSION['user'];
$mapaDescarregat = false;
$MapesUsuari = $usuario->getMapasUser($id_usuario);

foreach($MapesUsuari as $mapa){
    if($mapa['id'] == $idMapa){
        $mapaDescarregat = true;
        break;
    }else{
        $mapaDescarregat = false;
    }

}


if($mapaDescarregat){
    $_SESSION['errorMapa'] = "Ja tens aquest mapa descarregat";
    $mapaDescarregat = false;

    header("Location: ../cotrolador/mapes.controller.php");
    exit();

}else{

    $mapaUnicID = $usuario->getMapa($idMapa)['titol'];
    $nomMapa = $usuario->getMapa($idMapa)['nom_mapa'];

    $usuario->descarregarMapa($id_usuario, $nomMapa, $mapaUnicID);

    $_SESSION['successMapa'] = "Mapa descarregat correctament";
    header("Location: ../controlador/mapes.controller.php");
    exit();
}


?>