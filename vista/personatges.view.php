<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Els teus Personatges </title>

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/personatges.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="module" src="../Personatje/buscarPersonatges.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <a class="navbar-brand" href="../controlador/index.controler.php">FinalD</a>
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

    <div class="container">

            <div class="row">
                <div class="col-md-8 mt-2 col-sm-12 titol justify-content-sm-center">
                    <h1>Els teus Personatges</h1>
                </div>  
                <div class="col-md-4 col-sm-12 d-flex justify-content-md-end justify-content-sm-center ">
                    <a href="../controlador/crearPersonatje.controller.php" class="input-group-text CrearPersonatje" id="crearPersonatge">Crear Personatge</a>
                </div>
            </div>
            <div class="row mt-1 ">
               <div class="col-6 input-group buscador">
                    <span class="input-group-text" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                        </svg>
                    </span>
                    <input class="form-control" id="search" type="text">
               </div>
            </div>

            <div class="row mt-5 justify-content-md-around rounded llista-personatges">
                <?php
                
                   
                    foreach($llistaPersonatges as $personatge){
                        echo '  
                                    <div class="col-sm-12 col-md-5 p-1 col-lg-5 cartaPersonatge">
                                        
                                            <div class="fitxaPersonatge row ">
                                                <div class="col-lg-3 col-sm-3 col-md-4 align-self-center">                                                    
                                                    <img src="../img/avatar/'.$personatge['Img'].'" class="rounded-circle "  alt="imatge de perfil">
                                                </div>
                                                <div class="col-lg-9 col-sm-9 col-md-8">
                                                    <div class="row  ">
                                                        <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-3 col-md-12 col-lg-12 ">
                                                            <h3 class="card-title mt-2 ">'.$personatge['nom'].'</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="row">
                                                                <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-3 col-md-6 col-lg-4">
                                                                <div class="card-title mt-2">Nivell: '.$personatge['nivel'].'</div>
                                                                </div>
                                                                
                                                                <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-3 col-md-6 col-lg-4">
                                                                <div class="card-title  mt-2">'.$personatge['raza'].'</div>
                                                                </div>
                                                                <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-3 col-md-6 col-lg-4">
                                                                <div class="card-title mt-2">'.$personatge['clase'].'</div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row section-btn">
                                                
                                                    <a href="../controlador/eliminarPersonatge.controller.php?id='.$personatge['id'].'" class="btn" id="eliminarPersonatge">Eliminar</a>
                                                    <a href="../controlador/eliminarPersonatge.controller.php?id='.$personatge['id'].'" class="btn" id="modificarPersonatge">Modificar</a>
                                                   
                                                
                                            </div>
                                        
                                    </div>
                        
                                '
                        ;}

                ?>
            </div>

           
                        

            </div>


    </div>
    
</body>
</html>