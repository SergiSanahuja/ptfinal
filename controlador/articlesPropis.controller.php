<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
 

require_once '../model/foro.model.php';

$foro = new Foro();
$id = $_SESSION['user'];

if(empty($id)){
    $_SESSION['error'] = 'No estas loguejat';
    header('Location: ../controlador/foro.controller.php');
}

$foros = $foro->getForoByID($id);



include '../vista/foro.view.php';


?>