<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Forum </title>
    <!-- Enlace a los estilos de Bootstrap -->
    <link rel="stylesheet" href="../css/foroVista.css">
      <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >

    <header class="bg-dark text-white text-center p-3">
        <h1>Forum</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
    <div class="container-fluid">  
        <a class="Inici nav-link " href="../controlador/index.controler.php ">FinalD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="../controlador/personatges.controller.php" class="Personatges  nav-link">Personatges </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Forum
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../controlador/foro.controller.php">Inici</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../controlador/crearForo.controller.php">Crear missatge</a>
                            <a class="dropdown-item" href="../controlador/articlesPropis.controller.php">Els teus articles</a>
                        </div>
                    </li>            
                    
                </ul>    
                
                 
                <?php
                if(isset($_SESSION['user'])){
                    echo '<div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
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
                    <ul class="navbar-nav ml-auto">
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
        </div>
    </nav>

    <?php

        if(isset($_SESSION['error'])){
            echo '<div class="alert alert-danger error" role="alert">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success success" role="alert">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }

    ?>

    <div class="container mt-2  ">
        <h2>Últimas Publicaciones</h2>

       
        <?php
        
        // Agrega más publicaciones según sea necesario
            foreach($foros as $row){
                echo '<div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">'.$row['titol'].'</h3>
                    <p class="card-text">'.$row['missatge'].'</p>
                    <small class="text-muted">Publicado por: '.$row['nom'].' | Fecha: '.$row['data'].'</small>';
                    

                    if(isset($_SESSION['user'])){
                        
                        
                        if($row['id_Usuari'] == $_SESSION['user']){
                            echo '<a href="../controlador/eliminarArticle.controller.php?id='.$row['id'].'" class="btn btn-danger delete">Eliminar</a>';
                        };
                    }

                    echo '</div></div>';
            }



        ?>
    </div>

   
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <p>&copy; FinalD&D</p>
                </div>
            </div>
        </div>

    </footer>


   
</body>
</html>
