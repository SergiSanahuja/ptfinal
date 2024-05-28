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

if(isset($_SESSION['errorArticle'])){
    unset($_SESSION['errorArticle']);
}

if(isset($_SESSION['successArticle'])){
    unset($_SESSION['successArticle']);
}

if(empty($id)){
    $_SESSION['errorArticle'] = 'No pots veure els teus articles sense iniciar sessió';
    header('Location: ../controlador/foro.controller.php');
    exit();
}else{
    $_SESSION['errorArticle'] = null;
}

$foros = $foro->getForoByID($id);



include '../vista/foro.view.php';


?>