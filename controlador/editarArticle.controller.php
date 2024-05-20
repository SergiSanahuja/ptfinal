<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once '../model/foro.model.php';


if (isset($_SESSION['errorArticle'])) {
    
    unset($_SESSION['errorArticle']);
} 

if (isset($_SESSION['successArticle'])) {
    
    unset($_SESSION['successArticle']);
}


$idArticle = $_GET['id'];
$idUsuari = $_SESSION['user'];

$article = new Foro();

$contingut = $article->getContingutArticle($idArticle);

if($idUsuari == null){
    $_SESSION['errorLogin'] = 'Has d\'estar loguejat per editar un article';
    header('Location: ../controlador/foro.controller.php');
    die();
}

if(isset($_POST['submit'])){

    $titol = $_POST['titol'];
    $missatge = $_POST['contingut'];

    if(empty($titol) || empty($missatge) || $titol == null || $missatge == null){
        $_SESSION['errorArticle'] = 'Has d\'omplir tots els camps';
        header('Location: ../controlador/editarArticle.controller.php?id='.$idArticle);
        die();
    }

    $article->editarArticle($idArticle, $titol, $missatge, date('Y-m-d H:i:s'));

    $_SESSION['successArticle'] = 'Article editat correctament';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

if($article->getCreadorArticle($idArticle)['id_Usuari'] != $idUsuari){
    $_SESSION['errorArticle'] = 'No pots editar aquest article '.$idArticle.' perque no ets el creador'.$idUsuari;
    header('Location: articlesPropis.controller.php');
    die();
}









include '../vista/editarArticle.view.php';



?>