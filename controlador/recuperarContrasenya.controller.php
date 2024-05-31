<?php

require_once "../model/db.model.php";
require_once "../model/userDAO.model.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



    if(isset($_POST['submit'])){

        $correu = $_POST['email'];
        $token = md5(rand());

        update_token($token,$correu);

        $url = "http://localhost/Proyecto/ptfinal/vista/canviarContrasenya.php?code=". $token;

        $assumpte = "Recuperacio de contrasenya";

        $missatge = "<p>Ingressa al link adjuntat per recuperar la teva contrasenya</p> <p>link: <a href='" . $url . "'>" . $url . "</a></p>";

        require "../phpmail.php";

        header("Location: ../index.php");
        exit();


    }

/**
 * update_token
 * Aquesta funcio fa un update del token de l'usuari i la seva data de expiracio
 * @param  string $token token que sustituira al token de l'usuari
 * @param  string $correu correu de l'usuari 
 * @return void
 */
function update_token($token,$correu){
    $expiracio = date('U') + 1800;
    try {
       
        $userDAO = new userDAO();

        $userDAO->updateToken($token,$correu,$expiracio);


       
    } catch (Exception $e) {
        $errors = "Error a la hora connectar a la base de dades";
        die('Error: ' . $e->getMessage());
    } finally {
        $base = null;
    }
}
?>