<?php
    
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../model/foro.model.php';

    if(isset($_SESSION['errorArticle'])){
        unset($_SESSION['errorArticle']);
    }

    if(isset($_SESSION['successArticle'])){
        unset($_SESSION['successArticle']);
    }

  
    $id = $_SESSION['user'];

    $foro = new Foro();
    if(empty($id)){
        $_SESSION['errorArticle'] = 'No pots crear un article sense estar loguejat';
        header('Location: ../controlador/foro.controller.php');
        exit();
    }else{

        $_SESSION['errorArticle'] = null;
    }

    if (isset($_SESSION['error'])) {
    
        unset($_SESSION['error']);
    } 
    

    
    if(isset($_POST['submit'])){

       

        $titulo = $_POST['titol'];
        $contenido = $_POST['contingut'];
       
        
        if(empty($titulo) || empty($contenido)){
            $_SESSION['errorArticle'] = 'Falten camps per omplir';
                
        }else{
            $_SESSION['successArticle'] = "Article creat correctament";
            $_SESSION['errorArticle'] = null;
            $foro->crearForo($id, $titulo, $contenido, $_FILES['img']['name'], date('Y-m-d H:i:s'));
            header('Location: ../controlador/foro.controller.php');
            exit();
        }

    }

   


    include '../vista/crearForo.view.php';



?>