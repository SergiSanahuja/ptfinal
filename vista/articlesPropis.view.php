

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

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../controlador/index.controler.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vista/crearForo.view.php">Crear nou Missatge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Els teus articles</a>
                </li>
                <!-- Agrega más categorías según sea necesario -->
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Últimas Publicacions</h2>  
        <?php
        // Agrega más publicaciones según sea necesario
            foreach($foros as $row){
                echo '<div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">'.$row['titol'].'</h3>
                <p class="card-text">'.$row['missatge'].'</p>
                <small class="text-muted">Publicado por: '.$row['nom'].' | Fecha: '.$row['data'].'</small>
                    </div>
             </div>';
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



