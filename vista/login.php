<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Futurista</title>



     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
     <link rel="stylesheet" href="../css/login.css">


       <!-- Bootstrap JS and jQuery -->
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="login-container">


        <?php
            
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if(isset($_SESSION['error'])){
                echo '<div class="error">'.$_SESSION['error'].'</div>';
             
                unset($_SESSION['error']);
            }
        ?>

        <h2>Login</h2>
        <form id="login-form" action="../controlador/login.controler.php" method="post">
            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
         </form>
    </div>


</body>
</html>
