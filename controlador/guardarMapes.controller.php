<?php

require '../model/User.model.php';

if(session_status () == PHP_SESSION_NONE){
    session_start();
}


$User = new User();

$id_Usuari = $_SESSION['user'];
var_dump($_FILES['imgMapa']);

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
}else{
    $error = null;
}

if(!isset($_SESSION['user'])){
    $_SESSION['error'] = "No has iniciat sessió";
    header('Location: ../controlador/index.controler.php');
    exit();
}

if(isset($_POST['submit'])){
    $nom = $_POST['nomMapa'];
    $mapa = $_FILES['imgMapa'];
    
    if(empty($nom) || empty($mapa)){
        $_SESSION['error'] = 'Has d\'omplir tots els camps';
    }else{


        $infoMapa = getimagesize($mapa['tmp_name']);

        $nameMapa = $mapa['name'];
        $fileType = pathinfo($nameMapa, PATHINFO_EXTENSION);

        $allow = array("png", "jpg", "jpeg");

        if(!in_array($fileType, $allow)){
            $_SESSION['error'] = 'El archivo debe ser una imagen JPEG o PNG';
        }else{

            $_SESSION['error'] = null;

            $UnicName = uniqid() . $mapa['name'][0];

            $ruta = '../img/mapa/' . $UnicName . '.webp';
            move_uploaded_file($mapa['tmp_name'], $ruta);

            $mapa = $UnicName;

            $User->guardarMapa($id_Usuari, $nom, $mapa);
            header('Location: ../controlador/mapes.controller.php');
            exit();
        }

    }


}

include '../vista/mapes.view.php';

?>