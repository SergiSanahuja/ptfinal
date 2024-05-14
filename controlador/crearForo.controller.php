<?php
    
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../model/foro.model.php';

  
    $id = $_SESSION['user'];

    $foro = new Foro();
    if(empty($id)){
        $_SESSION['error'] = 'No pots crear un foro sense estar loguejat';
        header('Location: ../controlador/foro.controller.php');
        exit();
    }
    
    if(isset($_POST['submit'])){

       

        $titulo = $_POST['titol'];
        $contenido = $_POST['contingut'];
       
        
        if(empty($titulo) || empty($contenido)){
            $_SESSION['error'] = 'Falten camps per omplir';
                
        }else{
            $foro->crearForo($id, $titulo, $contenido, $_FILES['img']['name'], date('Y-m-d H:i:s'));
            header('Location: foro.controller.php');
            exit();
        }

    }

   


    include '../vista/crearForo.view.php';



?>