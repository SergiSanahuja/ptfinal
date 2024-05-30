<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Els teus Personatges </title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/mapes.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="module" src="../personatge/buscarPersonatges.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>

    <header class="bg-dark text-white text-center p-3">
        <h1>Mapes</h1>
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

        if (isset($_SESSION['errorMapa'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMapa'] . '</div>';
            
        }
        ?>
    </div>

    <div>
        <?php
        if (isset($_SESSION['successMapes'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMapa'] . '</div>';
           
        }
        ?>
    </div>

    <div class="container ">

        <div class="row">
            <div class="col-md-8 mt-2 col-sm-12 titol justify-content-sm-center">
                <h1>Mapes</h1>
            </div>

        </div>
        <div class="row mt-1 ">
            <div class="col-6 input-group buscador">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                    </svg>
                </span>
                <input class="form-control" aria-label="Buscador de personatges pel nom" id="search" type="text">
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary afegirMapa"  data-toggle="modal" data-target="#addImageModal">
                    Afegir Mapa
                </button>

            </div>
        </div>
        <!-- Bucle per veure tots els personatges que te el usuari -->
        <div class="row mt-5 justify-content-md-around rounded llista-personatges">
            <?php

                foreach ($mapes as $mapa) {
                    
                    echo '<div class="col-md-4 col-sm-12">
                    <div class="card">
                        <img src="../img/mapa/' . $mapa['titol'] . '.webp" class="card-img-top"  height="270" alt="...">
                        <div class="card-body">
                            <h2 class="card-title">' . $mapa['nom_mapa'] . '</h2>                            
                            <a href="../controlador/eliminarMapa.controller.php?id=' . $mapa['id'] . '" class="btn btn-danger" onclick="return confirm(\'¿Estás seguro de que quieres eliminar este mapa?\');">Eliminar</a>
                        </div> </div> </div>';                  
                    }
            ?>
        </div>

    </div>


    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <form action="../controlador/guardarMapes.controller.php" method="post" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="addImageModalLabel">Afegir imatge</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí puedes poner el formulario para añadir la imagen y el título -->
                        <div class="form-group">
                            <label for="imageTitle">Títol</label>
                            <input type="text" class="form-control" id="imageTitle" max="20" name="nomMapa" placeholder="Introduce el título de la imagen">
                        </div>
                        <div class="form-grorp">
                            <label for="imgMapa">Nom Mapa</label>
                            <input type="file" class="form-control" name="imgMapa" id="imgMapa">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                        <button type="subit" class="btn btn-primary" name="submit">Guardar canvis</button>
                    </div>

                </div>
            </div>

        </form>
    </div>
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <p>FinalD&D</p>
                </div>
            </div>
        </div>
        
    </footer>
</body>

</html>