<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Nou Article</title>

   <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/crearArticle.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<header class="bg-dark text-white text-center p-3">
    <h1>Nou Article</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark navegacio">
    <div class="container-fluid">  
        <a class="Inici nav-link  text-light pb-1" href="../index.php "> <img src="../img/fondos/favicon.ico" alt="És el logo de la pàgina">FinalD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="../controlador/personatges.controller.php" class="Personatges  nav-link text-light">Personatges </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdownMapa" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Mapa
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMapa">
                            <a class="dropdown-item" href="../controlador/mapes.controller.php">Inici</a>
                            <a class="dropdown-item" href="../controlador/mapesPropis.controller.php">Els teus mapes</a>
                        </div>
                    </li>  
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Fòrum
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../controlador/foro.controller.php">Inici</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../controlador/crearArticle.controller.php">Crear missatge</a>
                            <a class="dropdown-item" href="../controlador/articlesPropis.controller.php">Els teus articles</a>
                        </div>
                    </li>            
                    
                </ul>    
                
                 
                <?php
                if(isset($_SESSION['user'])){
                    echo '
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <div id="name"  class="nav-link text-light" ">'.$_SESSION['username'].'</div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-light" href="../controlador/logout.controller.php">Logout</a>
                    </li>
                    </ul>
                    ';
                }else{
                    echo '
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="../vista/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../vista/registre.php">Register</a>
                    
                    </li>
                    </ul>
                    ';
                }
                
                ?>
               
            
            </div>
        </div>
    </nav>

    <div>
        <?php
        if (isset($_SESSION['errorArticle'])) {
            echo '<div class="alert alert-danger error" role="alert">' . $_SESSION['errorArticle'] . '</div>';
            
        }
        ?>
    </div>
    
    <div class="container mt-3">
        <div class="w-auto h-auto formulari">

        
        
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> <a href="../controlador/foro.controller.php" class="cross" >&times;</a></span>
            </button>
                
            
            <div class="row justify-content-center">
                        

                <div class="col-12 col-sm-5  accordion">
                    <h1>Nou Article</h1>
                </div>

            
            </div>
            <div class="row justify-content-center p-3">
                <div class="col-12 col ">
                    
                    <form action="../controlador/crearArticle.controller.php" method="POST">
                        <div>
                            
                            <input type="text" class="" placeholder="Títol" min=1 max="40" aria-label="titol" name="titol" id="titol" >
                        </div>
                        <div>
                            <textarea name="contingut" aria-label="contringut" id="contingut" class="form-control" cols="30" rows="10" placeholder="Escriu el teu contingut" required></textarea>
                        </div>
                        <!-- <div>
                            <label for="imatge" class="form-label">Imatge:</label>
                            <input type="file" class="form-control" name="img">
                        </div> -->

                        <button type="submit" name="submit">Publicar</button>
                    
                    </form>
                </div> 
            </div>
        </div>
    </div>

</body>
</html>