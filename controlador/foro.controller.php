<?php


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/foro.model.php';


if(isset($_SESSION['user'])){
    unset($_SESSION['errorArticle']);
}

unset($_SESSION['errorPersonatges']);
unset($_SESSION['successPersonatges']);
unset($_SESSION['errorMapa']);
unset($_SESSION['successMapa']);





$foro = new Foro();


$foros = $foro->getForo();






include '../vista/foro.view.php';

?>