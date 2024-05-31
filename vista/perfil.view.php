<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Perfil</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/perfil.css">
    

    <!-- CSS -->
        <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>
<body>

    <header class="bg-dark text-white text-center p-3">
        <h1>Perfil</h1>
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
                         <b>Fòrum</b>
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

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                if(isset($_SESSION['errorDelete'])){
                    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['errorDelete'].'</div>';
                    unset($_SESSION['errorDelete']);
                }
                ?>
            </div>
        </div>

    <div class="container">
       
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Informació de l'usuari</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nom:</strong> <?php echo $user['nom']; ?></p>
                                
                                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                               
                               
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- <a href="editarPerfil.view.php" class="btn btn-warning">Editar perfil</a> -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarPerfilModal">Eliminar perfil</button>
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal eliminar perfil-->
<div class="modal fade" id="eliminarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="eliminarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="eliminarPerfilModalLabel">Eliminar perfil</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="eliminarPerfilForm" action="../controlador/eliminarPerfil.controller.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" form="eliminarPerfilForm" name="submit" class="btn btn-danger">Eliminar perfil</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
</body>
</html>