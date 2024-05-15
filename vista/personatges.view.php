<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Els teus Personatges </title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/personatges.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="module" src="../Personatje/buscarPersonatges.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>

<header class="bg-dark text-white text-center p-3">
    <h1>Personatges</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark navegacio">
    <div class="container-fluid"> 
        <a class="Inici  " href="../vista/index.php "> <img src="../img/fondos/favicon.ico" alt="logo"></a> 
        <a class="Inici nav-link " href="../controlador/index.controler.php ">FinalD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="../controlador/personatges.controller.php" class="Personatges  nav-link active">Personatges </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <div>
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
    </div>

    <div class="container h-100">
        
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
                    <input class="form-control" aria-label="Buscador de personatges pel nom" id="search" type="text">
                </div>

                <div class="col-4">
                    <select name="FiltrarClasse" aria-label="Filtar per clase" id="FiltrarClasse">
                        <option value="Tots">Tots</option>
                        <option value="Mago">Mag</option>
                        <option value="Guerrero">Guerrer</option>
                        <option value="Asesino">Assassí</option>
                        <option value="Arquero">Arquer</option>
                    </select>
                </div>
            </div>
        <!-- Bucle per veure tots els personatges que te el usuari -->
        <div class="row mt-5 justify-content-md-around rounded llista-personatges">
            <?php


            foreach ($llistaPersonatges as $personatge) {
                echo '  
                    <div class="col-sm-12 col-md-5  p-1 col-lg-5 cartaPersonatge">
                        
                            <div class="fitxaPersonatge row ">
                                <div class="col-lg-3 col-sm-3 col-md-12 align-self-center">                                                    
                                    <img src="../img/avatar/' . $personatge['Img'] . '" class="rounded-circle imgPerfil"  alt="imatge de perfil">
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-12">
                                    <div class="row">
                                        <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-12 col-md-12 col-lg-12 nomPersonatge ">
                                            <h3 class="card-title mt-2 ">' . $personatge['nom'] . '</h3>
                                        </div>
                                        
                                        <hr>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="mt-lg-2 mt-sm-4 mt-md-3 col-sm-4 col-md-6 col-lg-4">
                                                <div class="card-title mt-2">Lv: ' . $personatge['nivel'] . '</div>
                                                </div>
                                                
                                                <div class="mt-lg-2 mt-sm-4 mt-md-3 col-sm-4 col-md-6 col-lg-4">
                                                <div class="card-title  mt-2">' . $personatge['raza'] . '</div>
                                                </div>
                                                <div class="mt-lg-2 mt-sm-4 mt-md-3 col-sm-4 col-md-6 col-lg-4">
                                                <div class="card-title mt-2 clase">' . $personatge['clase'] . '</div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row section-btn">
                                <form action="../controlador/eliminarPersonatge.controller.php" method="POST">
                                    <input type="hidden" id="getId" name="id" value="' . $personatge['id'] . '">
                                    <button name="eliminarPersonatge" type="submit" class="btn">Eliminar</button>
                                </form>
                                <a class="btn editarPersonatge" data-toggle="modal"  tabindex="0" data-target="#modalPersonatge" id="'.$personatge['id'].'">Modificar</a>
                                
                            </div>
                        
                    </div>
                        
                    ';
            }

            ?>
        </div>




    </div>


    </div>

    <!-- Modal per a la fitxa de personatge  -->
    <div class="modal" id="modalPersonatge" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal">Hoja de personaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="id" hidden>

                    </div>

                    <div id="Img">

                    </div>
                    <div class="modal-header">
                        <div class="row">

                            <div class="col-6 col-md-6">
                                <label for="NomPersonatge">Nombre</label>
                                <h3 class="modal-title" id="NomPersonatge"></h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="Raza">Raza</label>
                                <h4 class="modal-title" id="raza"></h4>
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="clase">Clase</label>
                                <h4 class="modal-title" name='clase' id="clase"></h4>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="nivel">LV:</label>
                                <!-- <h4 class="modal-title" name='nivel' id="nivel">LV</h4> -->
                                <input type="number" min="0" max="20" name='nivel' id="nivel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body ">
                        <div class="row justify-content-around">

                            <div class="col-sm-4 h4">

                                <div class="row">

                                    <i class="bi bi-heart-fill mr-1"></i>
                                    <div class=""><label for="vida">Vida:</label></div>
                                    <!-- <div id="Vida"></div> -->
                                    <input type="number" min="0" max="20" name="Vida" id="Vida">
                                </div>

                            </div>
                            <div class="col-sm-5 h4">
                                <div class="row">

                                 <i class="bi bi-activity"></i>
                                    <div><label for="Iniciativa">Iniciativa:</label></div>
                                    <!-- <div id="Iniciativa"></div> -->
                                    <input type="number" min="0" max="20" name="Iniciativa" id="Iniciativa">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="infoPersonatge" class="row justify-content-center align-items-center ">
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" class="mr-1" width="25" height="25" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs>
                                    </defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 25.948 90 c -0.34 0 -0.682 -0.009 -1.024 -0.024 c -11.138 -0.532 -20.531 -9.572 -20.94 -20.152 C 3.774 64.355 5.85 59.065 9.831 54.926 c 4.242 -4.409 10.117 -6.937 16.12 -6.937 c 3.403 0 6.736 0.82 9.725 2.383 c 3.63 -2.992 8.278 -4.791 13.339 -4.791 c 2.327 0 4.584 0.37 6.739 1.102 l 0.934 -17.239 c 0.139 -1.709 -0.658 -3.27 -2.077 -4.13 l -3.133 -1.898 c -1.855 -1.123 -4.094 -1.363 -6.143 -0.66 c -0.098 0.034 -0.19 0.082 -0.28 0.133 c -1.775 1.004 -3.9 1.036 -5.695 0.09 c -1.795 -0.946 -2.97 -2.719 -3.143 -4.74 c -0.02 -0.231 -0.081 -0.454 -0.183 -0.663 c -2.514 -5.19 -0.715 -11.404 4.185 -14.453 l 2.587 -1.61 c 3.254 -2.027 7.464 -2.016 10.72 0.027 c 20.243 12.694 32.697 38.063 32.503 66.206 c -0.004 0.497 -0.191 0.974 -0.527 1.34 C 72.819 82.884 57.155 88.397 38.949 85.498 C 35.24 88.424 30.688 90 25.948 90 z M 25.951 51.99 c -4.921 0 -9.745 2.081 -13.237 5.711 c -3.22 3.347 -4.9 7.598 -4.732 11.969 c 0.325 8.413 8.17 15.882 17.132 16.31 c 4.402 0.219 8.643 -1.252 11.956 -4.118 c 0.454 -0.393 1.061 -0.561 1.652 -0.458 c 17.165 2.993 31.339 -1.742 43.307 -14.459 C 81.985 40.488 70.293 16.777 51.4 4.929 c -1.97 -1.236 -4.515 -1.245 -6.481 -0.021 l -2.587 1.61 c -3.158 1.966 -4.318 5.97 -2.698 9.314 c 0.315 0.651 0.506 1.346 0.568 2.066 c 0.057 0.668 0.43 1.23 1.023 1.542 c 0.592 0.313 1.267 0.302 1.849 -0.028 c 0.332 -0.188 0.646 -0.332 0.962 -0.44 c 3.175 -1.089 6.642 -0.717 9.514 1.023 l 3.133 1.897 c 2.725 1.651 4.255 4.649 3.996 7.823 l -1.083 20.019 c -0.036 0.675 -0.411 1.285 -0.997 1.624 c -0.584 0.337 -1.303 0.356 -1.905 0.052 c -2.392 -1.213 -4.975 -1.828 -7.679 -1.828 c -9.376 0 -17.004 7.629 -17.004 17.005 c 0 1.105 -0.896 2 -2 2 s -2 -0.896 -2 -2 c 0 -5.001 1.756 -9.598 4.684 -13.209 C 30.577 52.465 28.286 51.99 25.951 51.99 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    </g>
                                </svg>

                                <div><label for="Fuerza">Fuerza:</label></div>
                                <input type="number" min="0" max="20" name="Strenght" id="Fuerza" value=""></input>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <img src="..\img\fondos\noun-agility-4494012.svg" width="25" height="25" alt="imagen de destreza">
                                <div><label for="Destreza">Destreza:</label></div>

                                <input type="number" min="0" max="20" name="skill" id="Destreza"></input>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <i class="bi bi-shield mr-1"></i>
                                <div><label for="Constitucion">Constitucion:</label></div>
                                <input type="number" min="0" max="20" name="constitution" id="Constitucion"></input>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <i class="bi bi-lightbulb mr-1"></i>
                                <div><label for="Inteligencia">Inteligencia:</label></div>
                                <input type="number" min="0" max="20" name="inteligence" id="Inteligencia"></input>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <i class="bi bi-book mr-1"></i>
                                <div><label for="Sabiduria">Sabiduria:</label></div>
                                <input type="number" min="0" max="20" name="wisdom" id="Sabiduria"></input>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 h4">
                            <div class="row">
                                <i class="bi bi-emoji-smile mr-1"></i>
                                <div><label for="Carisma">Carisma:</label></div>
                                <input type="number" min="0" max="20" name="charisma" id="Carisma"></input>
                            </div>
                        </div>

                    </div>
                    <div id="inventari">
                        <div id="arma"></div>
                        <div id="armadura"></div>
                        <div id="pocio"></div>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" id="updateCharacter" class="btn btn-primary">Save changes</button>
                    
                </div>
            </div>
        </div>
    </div>
</body>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                <p>FinalD&D</p>
            </div>
        </div>
    </div>

</footer>


</html>