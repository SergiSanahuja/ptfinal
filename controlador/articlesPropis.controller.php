<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
 

unset($_SESSION['errorPersonatges']);
unset($_SESSION['successPersonatges']);
unset($_SESSION['errorMapa']);
unset($_SESSION['successMapa']);

require_once '../model/foro.model.php';

$foro = new Foro();
$id = $_SESSION['user'];

// Si hi ha algun error, esborra la variable errorArticle i successArticle
if(isset($_SESSION['errorArticle'])){
    unset($_SESSION['errorArticle']);
}

if(isset($_SESSION['successArticle'])){
    unset($_SESSION['successArticle']);
}

// Comprova si l'usuari ha iniciat sessió
if(empty($id)){
    $_SESSION['errorArticle'] = 'No pots veure els teus articles sense iniciar sessió';
    header('Location: ../controlador/foro.controller.php');
    exit();
}else{
    $_SESSION['errorArticle'] = null;
}


//agarra el articles de l'usuari loguejat
$foros = $foro->getForoByID($id);



include '../vista/foro.view.php';


?>