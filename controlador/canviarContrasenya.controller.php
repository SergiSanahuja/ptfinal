<?php

require_once '../model/userDAO.model.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {

    $token = $_POST['token'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    

    if ($newPassword === $confirmPassword) {
        $userDAO = new userDAO();

        if (!$userDAO->getUserByToken($token)) {
            $_SESSION['errorLogin'] = 'Error al canviar la contrasenya token no vàlid';
            header('Location: ../index.php?');
            exit();
        }

        $user = $userDAO->getUserByToken($token);

        if ($user) {
            $userDAO->updatePassword($user['id'], password_hash($newPassword, PASSWORD_DEFAULT));
            $_SESSION['successLogin'] = 'Contrasenya canviada correctament';
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['errorLogin'] = 'Error al canviar la contrasenya';
            header('Location: ../vista/canviarContrasenya.php?code=' . $token);
            exit();
        }
    } else {
        $_SESSION['errorLogin'] = 'Les contrasenyes no coincideixen';
        header('Location: ../vista/canviarContrasenya.php?code=' . $token);
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}







?>