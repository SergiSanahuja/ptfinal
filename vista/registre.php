<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/registre.css">
    <!-- CSS -->
        <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>
<body>
    

<div class="login-container">
        <h2>Registre</h2>
        <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
        <form id="login-form" action="../controlador/registre.controler.php" method="post">
            <input type="text" id="username" name="username" placeholder="Usuario" required>
            <input type="text" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="password" id="confirmPsw" name="confirmPsw" placeholder="Confirmar Contrasenya" required>
            <button type="submit">Registrar</button>
        </form>
        
    </div>




</body>
</html>