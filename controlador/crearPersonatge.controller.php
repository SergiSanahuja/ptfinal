<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $_SESSION['errorLogin'] = 'Has d\'iniciar sessió per crear un personatge';
    header('Location: ../index.php');
    exit();
}

if (isset($_SESSION['error'])) {

    unset($_SESSION['error']);
}



if (isset($_POST['submit'])) {

    if (isset($_POST['raza']) && isset($_POST['clase'])) {

        //Agafem les dades del formulari i les guardem a variables
        $id = $_SESSION['user'];
        $raza = $_POST['raza'];
        $clase = $_POST['clase'];
        $nombre = $_POST['nombre'];
        $fuerza = $_POST['Fuerza'];
        $vida = $_POST['vida'];
        $iniciativa = $_POST['iniciativa'];
        $constitucion = $_POST['Constitucion'];
        $destreza = $_POST['Destreza'];
        $inteligencia = $_POST['Inteligencia'];
        $sabiduria = $_POST['Sabiduria'];
        $carisma = $_POST['Carisma'];

        if(strlen($nombre) > 20){
            $_SESSION['errorPersonatge'] = 'El nom no pot tenir més de 20 caràcters';

            header('Location: ../controlador/crearPersonatge.controller.php');
            exit();

        }


        //depenent de que la img hagi sigut pujada o no, guardem la ruta de la img
        

        if (isset($_FILES['imgPerfil'])) {
            $imagen = $_FILES['imgPerfil'];
           
            
            var_dump($imagen['tmp_name'][0]);

            if (empty($imagen['tmp_name'][0])) {
                $_SESSION['errorPersonatge'] = 'Has de pujar una imatge';
            } else {

                $_SESSION['errorPersonatge'] = null;

                $infoImagen = getimagesize($imagen['tmp_name'][0]);
                $nameImage = $imagen['name'][0];
                $fileType = pathinfo($nameImage, PATHINFO_EXTENSION);

                // var_dump($fileType);
                $allow = array("png", "jpg", "jpeg");


                if (!in_array($fileType, $allow)) {
                    $_SESSION['errorPersonatge'] = 'El archivo debe ser una imagen JPEG o PNG';
                } else {

                    $UnicName = uniqid() . $imagen['name'][0];

                    $ruta = '../img/avatar/' . $UnicName;
                    move_uploaded_file($imagen['tmp_name'][0], $ruta);

                    $imagen = $UnicName;
                }
            }
        } else if (isset($_POST['nomImgPerfil'])) {

            if ($_POST['nomImgPerfil'] == '') {
                $_SESSION['errorPersonatge'] = 'Has de seleccionar una imatge de perfil';
            }
            $imagen = $_POST['nomImgPerfil'];
        } else {
            $_SESSION['errorPersonatge'] = 'Has de tenir una imatge de perfil';
        }

        if ($raza == 'Raza') {
            $_SESSION['errorPersonatge'] = 'Has de seleccionar una raça';
        }

        if ($clase == 'Class') {
            $_SESSION['errorPersonatge'] = 'Has de seleccionar una clase';
        }

        if ($nombre == '') {
            $_SESSION['errorPersonatge'] = 'El nom no pot estar buit';
        }

        if (!isset($_SESSION['errorPersonatge'])) {
            require_once '../model/personatge.php';
            $personatge = new personatge();
            $personatge->crearPersonatge($id, $raza, $clase, $nombre, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma, $imagen);
            $_SESSION['successMapes'] = 'Personatge creat correctament';
            $_SESSION['errorPersonatge'] = null;
            header('Location: ../index.php');
            die();
        }
    } else {
        $_SESSION['errorPersonatge'] = 'Falta seleccionar la raza y la clase';
        header('Location: ../vista/crearPersonatge.view.php');
        die();
    }
}

include_once '../vista/crearPersonatge.view.php';
