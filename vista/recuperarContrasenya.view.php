<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Recuperar contrasenya</title>
</head>

<body>

    <header class="bg-dark text-white text-center p-3">
        <h1>Recuperar contrasenya</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <div class="container-fluid">
            <b><a class="Inici nav-link active text-light " href="./index.php "> <img src="./img/fondos/favicon.ico" alt="És el logo de la pàgina">FinalD</a></b>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="./controlador/personatges.controller.php" class="Personatges  nav-link text-light">Personatges </a>

                    </li>
                    <li class="nav-item">
                        <a href="./controlador/mapes.controller.php" class="Personatges  nav-link text-light"> Mapes </a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Fòrum
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./controlador/foro.controller.php">Inici</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./controlador/crearArticle.controller.php">Crear missatge</a>
                            <a class="dropdown-item" href="./controlador/articlesPropis.controller.php">Els teus articles</a>
                        </div>
                    </li>

                </ul>


                <?php
                if (isset($_SESSION['user'])) {
                    echo '
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a id="name" href="./controlador/perfil.controller.php"  class="nav-link text-light" ">' . $_SESSION['username'] . '</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="./controlador/logout.controller.php">Logout</a>
                    </li>
                    </ul>
                    ';
                } else {
                    echo '
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="./vista/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./vista/registre.php">Register</a>
                    
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

        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger msgError" role="alert">' . $_SESSION['errorLogin'] . '</div>';
        }
        ?>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="../controlador/recuperarContrasenya.controller.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Recuperar contrasenya</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>