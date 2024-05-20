<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Fòrum </title>
    <!-- Enlace a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/foroVista.css">
      <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >

    <header class="bg-dark text-white text-center p-3">
        <h1>Fòrum</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
    <div class="container-fluid ">  
        
        <a class="Inici  " href="../vista/index.php "> <img src="../img/fondos/favicon.ico" alt="logo"></a>
        <a class="Inici mr-3 " href="../vista/index.php "> FinalD</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="../controlador/personatges.controller.php" class="Personatges  nav-link">Personatges </a>
                        
                    </li>
                    <li class="nav-item">
                        <a href="../controlador/mapes.controller.php" class="Personatges  nav-link "> Mapes </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

        if(isset($_SESSION['errorArticle'])){
            echo '<div class="alert alert-danger error" role="alert">'.$_SESSION['errorArticle'].'</div>';
        }

        if(isset($_SESSION['successArticle'])){
            echo '<div class="alert alert-success success" role="alert">'.$_SESSION['successArticle'].'</div>';
           
        }

    ?>

    <div class="container mt-2 h-100 ">
        <h2>Últimes Publicacions</h2>       
        <?php
        
            // Agrega más publicaciones según sea necesario
            foreach($foros as $row){
                echo '<div class="card mb-3">
                        <div class="card-body ">
                         <h3 class="card-title">'.$row['titol'].'</h3>
                        <p class="card-text">'.$row['missatge'].'</p>
                        <small class="text-muted">Publicado por: '.$row['nom'].' | Fecha: '.$row['data'].'</small><br>';
            
                if(isset($_SESSION['user'])){
                    if($row['id_Usuari'] == $_SESSION['user']){
                        echo  '<div class="d-flex justify-content-end">';
                        echo '<a href="../controlador/eliminarArticle.controller.php?id='.$row['id'].'" class="btn btn-danger d-none d-md-inline delete mr-3" onclick="return confirm(\'¿Estás seguro de que quieres eliminar este artículo?\');">Eliminar</a>';
                        echo '<a href="../controlador/eliminarArticle.controller.php?id='.$row['id'].'" class="btn btn-danger d-inline d-md-none delete mr-3" onclick="return confirm(\'¿Estás seguro de que quieres eliminar este artículo?\');"><i class="bi bi-trash"></i></a>';
                        echo '<a href="../controlador/editarArticle.controller.php?id='.$row['id'].'" class="btn btn-primary d-none d-md-inline edit">Modificar</a>';
                        echo '<a href="../controlador/editarArticle.controller.php?id='.$row['id'].'" class="btn btn-primary d-inline d-md-none edit"><i class="bi bi-pencil"></i></a>';   
                        echo '</div>';
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
