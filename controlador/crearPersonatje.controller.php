<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['submit'])) {

    if (isset($_POST['raza']) && isset($_POST['clase'])) {

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

        
       


        if (isset($_POST['imgPerfil'])) {
            $imagen = $_POST['imgPerfil'];

        }else if(isset($_POST['nomImgPerfil'])){
            $imagen = $_POST['nomImgPerfil'];
        }else{
            $_SESSION['error'] = 'Has de tenir una imatge de perfol';
        }


        if ($nombre == '') {
            $_SESSION['error'] = 'El nombre no puede estar vacio';
                     
        }

        
        
    } else {
        $_SESSION['error'] = 'Falta seleccionar la raza y la clase';
        header('Location: ../vista/crearPersonatje.view.php');
        die();
    }
}

include_once '../vista/crearPersonatje.view.php';
