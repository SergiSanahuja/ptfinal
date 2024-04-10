<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/index.css">
    <!-- CSS -->
        <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <a class="navbar-brand" href="#">FinalD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            if(isset($_SESSION['user'])){
                echo '<div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav
                ml-auto">
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
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registre.php">Register</a>

                </li>
                </ul>
            </div>';
            }

        ?>
        
    </nav>
    <section class="sala d-flex flex-column justify-content-center align-items-center">
        <div class="card">

            <h1>Sala de JOC</h1>
            <div class="row">
                <div class="col">
                    <button class="btn ">Crear Sala</button>
                    
                </div>
                <div class="col">
                    <button class="btn">Unir-se</button>
                </div>

                <div class="col">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<a href="../controlador/crearPersonatje.controller.php" class="btn">Crear Personaje</a>';
                    }
                    ?>
                    
                </div>
            </div>


        </div>
    </section>
    <section class="Mercat">
        
    </section>

    <section class="sala">
        
    </section>
</body>
</html>