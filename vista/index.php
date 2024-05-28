<html lang="ca">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/fondos/favicon.ico" type="image/x-icon">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="../css/index.css">

    <!-- CSS -->
        <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <header class="bg-dark text-white text-center p-3">
        <h1>FinalD</h1>
    </header>

    

    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
    <div class="container-fluid">  
        <a class="Inici  " href="./index.php "> <img src="./img/fondos/favicon.ico" alt="logo"></a>
        <a class="Inici nav-link active " href="./index.php ">FinalD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="./controlador/personatges.controller.php" class="Personatges  nav-link ">Personatges </a>
                        
                    </li>
                    <li class="nav-item">
                        <a href="./controlador/mapes.controller.php" class="Personatges  nav-link "> Mapes </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                if(isset($_SESSION['user'])){
                    echo '
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <div id="name"  class="nav-link" ">'.$_SESSION['username'].'</div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./controlador/logout.controller.php">Logout</a>
                    </li>
                    </ul>
                    ';
                }else{
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
    <section class="sala d-flex  justify-content-center align-items-center">

            <div>
                <?php
                 
                    if(isset($_SESSION['errorLogin'])){
                        echo '<div class="alert alert-danger msgError" role="alert">'.$_SESSION['errorLogin'].'</div>';
                    }
                ?>
            </div>

        <div class="card">
            <div class="row justify-content-center">
                <h1>Sala de JOC</h1>

            </div>

            <div class="row">
                <div class="col-4 ">
                    <?php
                    

                    
                        echo '<a href="./controlador/crearSala.controller.php" class="btn">Crear Sala</a>';
                    
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
                          
                            <form action="./controlador/unirSala.controller.php" method="post">
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
                            echo '<a href="./index.php" class=" btn">Unir Sala</a>';
                        }
                    ?>
                </div>

                <?php
                    if (isset($_SESSION['username'])) {
                       echo "<div class='col-4'>
                        <a href='./controlador/crearPersonatge.controller.php' class='btn'>Crear Personatge</a>
                        </div>";
                    }else{
                        echo "<div class='col-4'>
                        <a href='./index.php' class='btn'>Crear Personatge</a>
                        </div>";
                    }
                    
                ?>

            </div>
        </div>

        <!-- <div >
            <button class="btncrearPersonatge">
                <a href="./controlador/crearPersonatge.controller.php">
                    <img src="./img/fondos/Crearpersonaje.png" class="crearPersonatge" title="Crear Personaje" alt="Crear Personaje">
                </a>
            </button>
        </div> -->


    </section>
    <section class="Mercat d-flex justify-content-center align-items-center">
        <div class="card ">

            <div class="row p-3 justify-content-center">
                <h1>Fòrum</h1>        
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="./controlador/foro.controller.php" class="btn">Entrar</a>
                </div>
            </div> 
        </div>
    </section>

    <section class="sala">
        
    </section>

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