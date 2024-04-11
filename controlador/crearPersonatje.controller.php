<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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

        
       

        //depenent de que la img hagi sigut pujada o no, guardem la ruta de la img
        if (isset($_POST['imgPerfil'])) {
            $imagen = $_POST['imgPerfil'];

        }else if(isset($_POST['nomImgPerfil'])){
            $imagen = $_POST['nomImgPerfil'];
        }else{
            $_SESSION['error'] = 'Has de tenir una imatge de perfol';
        }

        if($raza == 'Raza'){
            $_SESSION['error'] = 'Has de seleccionar una raza';
        }

        if($clase == 'Class'){
            $_SESSION['error'] = 'Has de seleccionar una clase';
        }

        if ($nombre == '') {
            $_SESSION['error'] = 'El nombre no puede estar vacio';
                     
        }

        if(!isset($_SESSION['error'])){
            require_once '../model/personatje.php';
            $personatje = new Personatje();
            $personatje->crearPersonatje($id, $raza, $clase, $nombre, $fuerza, $vida, $iniciativa, $constitucion, $destreza, $inteligencia, $sabiduria, $carisma, $imagen);
            $_SESSION['success'] = 'Personatje creat correctament';
            header('Location: ../vista/personatjes.view.php');
            die();
        }
        
        
    } else {
        $_SESSION['error'] = 'Falta seleccionar la raza y la clase';
        header('Location: ../vista/crearPersonatje.view.php');
        die();
    }
}

include_once '../vista/crearPersonatje.view.php';
