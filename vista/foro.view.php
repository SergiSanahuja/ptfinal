<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro de Discusión</title>
    <!-- Enlace a los estilos de Bootstrap -->
    <link rel="stylesheet" href="../css/foroVista.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >

    <header class="bg-dark text-white text-center p-3">
        <h1>Foro de Discusión</h1>
    </header>

              
    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="Inici nav-link " href="../controlador/index.controler.php ">FinalD</a>

                </li>
                <li class="nav-item">
                    <a href="../controlador/personatges.controller.php" class="Personatges  nav-link ">Personatges </a>

                </li>
                <li class="nav-item">
                    <a href="../controlador/foro.controller.php" class="nav-link active">Forum </a>
                    
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="../vista/crearForo.view.php">Crear nou Missatge</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../controlador/articlesPropis.controller.php">Els teus articles</a>
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

    <div class="container mt-4">
        <h2>Últimas Publicaciones</h2>

       
        <?php
        
        // Agrega más publicaciones según sea necesario
            foreach($foros as $row){
                echo '<div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">'.$row['titol'].'</h3>
                    <p class="card-text">'.$row['missatge'].'</p>
                    <small class="text-muted">Publicado por: '.$row['nom'].' | Fecha: '.$row['data'].'</small>';
                    
                    if($row['id_Usuari'] == $_SESSION['user']){
                        echo '<a href="../controlador/eliminarArticle.controller.php?id='.$row['id'].'" class="btn btn-danger delete">Eliminar</a>';
                    };

                    echo '</div></div>';
            }



        ?>

        <!-- Agrega más publicaciones según sea necesario -->

    </div>

    <footer class="bg-dark text-white text-center p-2 mt-5">
        <p>&copy; 2024 Foro de Discusión</p>
    </footer>
    
    <!-- Scripts de Bootstrap y jQuery (asegúrate de incluir jQuery antes de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>