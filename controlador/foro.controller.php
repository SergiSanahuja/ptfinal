<?php


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/foro.model.php';


$foro = new Foro();
$id = $_SESSION['user'];

if(empty($id)){
    $_SESSION['error'] = 'No pots crear un foro sense estar loguejat';
    header('Location: ../controlador/index.controler.php');
}


$foros = $foro->getForo();






include '../vista/foro.view.php';

?>