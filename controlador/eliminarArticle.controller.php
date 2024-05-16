<?php




if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/foro.model.php';


$foro = new Foro();

$id = $_SESSION['user'];
$id_Article = $_GET['id'];


if(empty($id)){
    $_SESSION['error'] = 'No pots eliminar un article sense estar logueja';
    header('Location: ../controlador/foro.controller.php');
    exit();
}


if ($id_Article == null) {
    $_SESSION['error'] = 'No pots eliminar un article sense seleccionar-lo';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

if($foro->getCreadorArticle($id_Article)['id_Usuari'] != $id){
    $_SESSION['error'] = 'No pots eliminar un article que no has creat';
    header('Location: ../controlador/foro.controller.php');
    exit();
}

$foro->eliminarForo($id_Article);

$_SESSION['success'] = 'Article eliminat correctament';

header('Location: ../controlador/foro.controller.php');
exit();


?>