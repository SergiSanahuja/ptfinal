<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
 

require_once '../model/foro.model.php';

$foro = new Foro();
$id = $_SESSION['user'];

if(empty($id)){
    $_SESSION['error'] = 'No pots veure els teus articles sense estar loguejat';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

$foros = $foro->getForoByID($id);



include '../vista/foro.view.php';


?>