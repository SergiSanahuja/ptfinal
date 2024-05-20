<?php


require_once '../model/db.model.php';
require_once '../model/User.model.php';

if(session_status () == PHP_SESSION_NONE){
    session_start();
}

$User = new User();
$id_Usuari = $_SESSION['user'];


//Eliminar les variables de sessió de error d'altres controladors 
unset($_SESSION['errorArticle']);
unset($_SESSION['successArticle']);
unset($_SESSION['errorPersonatges']);
unset($_SESSION['successPersonatges']);






if(!isset($_SESSION['user'])){
    $_SESSION['errorLogin'] = "No has iniciat sessió";
    header('Location: ../controlador/index.controler.php');
    exit();
}




    
$mapes = $User->getMapes();






include '../vista/mapes.view.php';


?>