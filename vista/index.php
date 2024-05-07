<html lang="ca">
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
        <a href="../controlador/personatges.controller.php">Personatges </a>
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
        
    </nav>
    <section class="sala d-flex  justify-content-center align-items-center">

            <div>
                <?php
                 
                    if(isset($error)){
                        echo '<div class="alert alert-danger msgError" role="alert">'.$error.'</div>';
                    }
                ?>
            </div>

        <div class="card">
            <div class="row justify-content-center">
                <h1>Sala de JOC</h1>

            </div>

            <div class="row">
                <div class="col-4  align-content-center">
                    <?php
                    

                    if (isset($_SESSION['username'])) {
                        echo '<a href="crearSala.controller.php" class="btn">Crear Sala</a>';
                    }else{
                        echo '<a href="../controlador/index.controler.php" class="btn">Crear Sala</a>';
                    }

                    ?>
                    
                    
                </div>

                <div class="modal fade " id="modalUnirSala" tabindex="-1" role="dialog" aria-labelledby="modalUnirSalaLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUnirSalaLabel">Unirse a Sala</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../controlador/unirSala.controller.php" method="post">
                            <div class="form-group">

                                <label for="Personatge">Selecciona el teu personatge</label>
                                <select class="form-control mb-3" id="Personatge" name="Personatge" required>
                                    <?php
                                        foreach ($llistaPersonatges as $personatge) {
                                            echo '<option value="'.$personatge['id'].'">'.$personatge['nom'].' - nivell'.$personatge['nivel'].'</option>';
                                        }
                                    ?>
                                </select>
                                <label for="codigoSala">Código de la Sala</label>
                                <input type="text" class="form-control" id="codigoSala" name="codigoSala" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Unirse</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                   <?php
                        if (isset($_SESSION['username'])) {
                            echo '<a href="#" class="btn" data-toggle="modal" data-target="#modalUnirSala">Unir Sala</a>';
                        }else{
                            echo '<a href="../controlador/index.controler.php" class=" btn">Unir Sala</a>';
                        }
                    ?>
                </div>

                <?php
                    if (isset($_SESSION['username'])) {
                       echo "<div class='col-4'>
                        <a href='../controlador/crearPersonatje.controller.php' class='btn'>Crear Personatge</a>
                        </div>";
                    }else{
                        echo "<div class='col-4'>
                        <a href='../controlador/index.controler.php' class='btn'>Crear Personatge</a>
                        </div>";
                    }
                    
                    ?>

            </div>
        </div>

        <!-- <div >
            <button class="btnCrearPersonatje">
                <a href="../controlador/crearPersonatje.controller.php">
                    <img src="../img/fondos/Crearpersonaje.png" class="CrearPersonatje" title="Crear Personaje" alt="Crear Personaje">
                </a>
            </button>
        </div> -->


    </section>
    <section class="Mercat">
        
    </section>

    <section class="sala">
        
    </section>

</body>


</html>