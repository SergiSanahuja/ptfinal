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
    header('Location: ../index.php');
    exit();
}




    
$quantitatMapes = $User->getQuantitatMapes();



// En tu controlador
$mapasPorPagina = 10; // Cambia esto al número de mapas que quieres mostrar por página
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $mapasPorPagina;

$totalPagines = ceil($quantitatMapes['total'] / 10);
$mapes = $User->getMapes($inicio, $mapasPorPagina);


include '../vista/mapes.view.php';


?>