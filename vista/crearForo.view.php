<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nou Missatge</title>

   <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/crearForo.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<header class="bg-dark text-white text-center p-3">
    <h1>Personatges</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="Inici nav-link " href="../controlador/index.controler.php ">FinalD</a>

                </li>
                <li class="nav-item">
                    <a href="../controlador/personatges.controller.php" class="Personatges  nav-link active">Personatges </a>

                </li>
                <li class="nav-item">
                    <a href="../controlador/foro.controller.php" class="nav-link">Forum </a>
                    
                </li>

            </ul>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            if(isset($_SESSION['user'])){
                echo '<div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav
                ml-auto">
                <li class="nav-item">
                <div id="name"  class="nav-link" ">'.$_SESSION['username'].'</div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../controlador/logout.controller.php">Logout</a>
                </li>
                </ul>
                </div>';
            }else{
                echo '<div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav
                ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="../vista/login.php">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../vista/registre.php">Register</a>
                
                </li>
                </ul>
                </div>';
            }
            
            ?>
        
        </div>
    </nav>

    <div>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger error" role="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
    </div>
    
    <div class="container">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> <a href="../controlador/foro.controller.php" >&times;</a></span>
        </button>
            
        
        <div class="row justify-content-center">
                    

            <div class="col-5 accordion">

                <h1>Nou Missatge</h1>
            </div>

           
        </div>
        <div class="row justify-content-center">

            <form action="../controlador/crearForo.controller.php" method="POST">
                <div>
                    
                    <input type="text" class="" placeholder="Títol" aria-label="titol" name="titol" id="titol" >
                </div>
                <div>
                    <textarea name="contingut" aria-label="contringut" id="contingut" class="form-control" cols="30" rows="10" placeholder="Escriu el teu contingut" required></textarea>
                </div>
                <div>
                    <label for="imatge" class="form-label">Imatge:</label>
                    <input type="file" class="form-control" name="img">
                </div>

                <button type="submit" name="submit">Publicar</button>
            
            </form>
        </div>
    </div>

</body>
</html>