<?php




if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/foro.model.php';

if(isset($_SESSION['errorArticle'])){
    unset($_SESSION['errorArticle']);
}

if(isset($_SESSION['success'])){
    unset($_SESSION['success']);
}


$foro = new Foro();

$id = $_SESSION['user'];
$id_Article = $_GET['id'];


if(empty($id)){
    $_SESSION['errorArticle'] = 'No pots eliminar un article sense estar logueja';
    header('Location: ../controlador/foro.controller.php');
    exit();
}


if ($id_Article == null) {
    $_SESSION['errorArticle'] = 'No pots eliminar un article sense seleccionar-lo';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

if($foro->getCreadorArticle($id_Article)['id_Usuari'] != $id){
    $_SESSION['errorArticle'] = 'No pots eliminar un article que no has creat';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

$foro->eliminarForo($id_Article);

$_SESSION['successArticle'] = 'Article eliminat correctament';

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();


?>