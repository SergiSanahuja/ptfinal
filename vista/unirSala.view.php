<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Sala</title>

    <!-- Bootstrap CSS -->
    <script defer src="../Xat/client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/sala.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark navegacio">
        <a href="../index.php" class="navbar-brand">
            <img src="../img/fondos/favicon.ico" alt="logo" class="d-inline-block align-text-center">
            FinalD
        </a>


        <div class="justify-content-center">
            <span class="navbar-brand mb-0 h1">Sala</span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user'])) {
            echo '<div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav
                ml-auto">
                <li class="nav-item">
                    <div id="name"  class="nav-link" ">' . $_SESSION['username'] . '</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/logout.controller.php">Logout</a>
                </li>
                </ul>
                </div>';
        } else {
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




    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3 col-sm-5">
                <div id="XatGlobal"></div>

                <form onsubmit="enviar(event)">
                    <textarea id="missatge" rows="3" onkeypress="enter(event)" placeholder="Escriu aquí el missatge" autofocus></textarea>
                </form>

                <div id="Codi" class="mb-3">
                    <?php echo $_SESSION['codigoSala']; ?>
                </div>
                <div>
                    <table class="table-personajes" id="Users">
                        <tr>
                            <th>Personatges</th>
                        </tr>

                    </table>
                </div>
            </div>
            <div id="ContenidorMapa" class="col-md-9  mt-2 col-sm-7">
                <div class="">




                    <div id="fondo" width="auto" height="auto" style="border: 1px solid black;">

                    </div>



                </div>

            </div>

        </div>
    </div>



    <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal">Fulla de personatge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="idPersonatge" hidden>
                        <?php echo $_SESSION['idPersonatge']; ?>
                    </div>

                    <div id="Img">

                    </div>
                    <div class="modal-header">
                        <div>
                            <label for="NomPersonatge">Nom</label>
                            <h3 class="modal-title" id="NomPersonatge"></h3>
                        </div>
                        <div>
                            <label for="Raza">Raça</label>
                            <h4 class="modal-title" id="raza"></h4>
                        </div>
                        <div>
                            <label for="clase">Classe</label>
                            <h4 class="modal-title" name='clase' id="clase"></h4>
                        </div>
                        <div>
                            <label for="nivel">LV:</label>
                            <h4 class="modal-title" name='nivel' id="nivel">LV</h4>
                        </div>
                    </div>
                    <div class="modal-body ">
                        <div class="row justify-content-around">

                            <div class="col-sm-3 col-md-6  h4">

                                <div class="row justify-content-center">
                                    <div>
                                        <i class="bi bi-heart-fill mr-1"></i>
                                    </div>
                                    <div class=""><label for="vida">Vida:</label></div>
                                    <div id="Vida">5</div>
                                </div>

                            </div>
                            <div class="col-sm-3 col-md-6 h4">
                                <div class="row justify-content-center">
                                    <div>
                                        <i class="bi bi-activity"></i>
                                    </div>

                                    <div><label for="Iniciativa">Iniciativa:</label></div>


                                    <div id="Iniciativa">5</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="infoPersonatge" class="row justify-content-sm-center align-items-center ">
                        <div class="col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" class="mr-1" width="25" height="25" viewBox="0 0 256 256" xml:space="preserve">
                                    <defs>
                                    </defs>
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                        <path d="M 25.948 90 c -0.34 0 -0.682 -0.009 -1.024 -0.024 c -11.138 -0.532 -20.531 -9.572 -20.94 -20.152 C 3.774 64.355 5.85 59.065 9.831 54.926 c 4.242 -4.409 10.117 -6.937 16.12 -6.937 c 3.403 0 6.736 0.82 9.725 2.383 c 3.63 -2.992 8.278 -4.791 13.339 -4.791 c 2.327 0 4.584 0.37 6.739 1.102 l 0.934 -17.239 c 0.139 -1.709 -0.658 -3.27 -2.077 -4.13 l -3.133 -1.898 c -1.855 -1.123 -4.094 -1.363 -6.143 -0.66 c -0.098 0.034 -0.19 0.082 -0.28 0.133 c -1.775 1.004 -3.9 1.036 -5.695 0.09 c -1.795 -0.946 -2.97 -2.719 -3.143 -4.74 c -0.02 -0.231 -0.081 -0.454 -0.183 -0.663 c -2.514 -5.19 -0.715 -11.404 4.185 -14.453 l 2.587 -1.61 c 3.254 -2.027 7.464 -2.016 10.72 0.027 c 20.243 12.694 32.697 38.063 32.503 66.206 c -0.004 0.497 -0.191 0.974 -0.527 1.34 C 72.819 82.884 57.155 88.397 38.949 85.498 C 35.24 88.424 30.688 90 25.948 90 z M 25.951 51.99 c -4.921 0 -9.745 2.081 -13.237 5.711 c -3.22 3.347 -4.9 7.598 -4.732 11.969 c 0.325 8.413 8.17 15.882 17.132 16.31 c 4.402 0.219 8.643 -1.252 11.956 -4.118 c 0.454 -0.393 1.061 -0.561 1.652 -0.458 c 17.165 2.993 31.339 -1.742 43.307 -14.459 C 81.985 40.488 70.293 16.777 51.4 4.929 c -1.97 -1.236 -4.515 -1.245 -6.481 -0.021 l -2.587 1.61 c -3.158 1.966 -4.318 5.97 -2.698 9.314 c 0.315 0.651 0.506 1.346 0.568 2.066 c 0.057 0.668 0.43 1.23 1.023 1.542 c 0.592 0.313 1.267 0.302 1.849 -0.028 c 0.332 -0.188 0.646 -0.332 0.962 -0.44 c 3.175 -1.089 6.642 -0.717 9.514 1.023 l 3.133 1.897 c 2.725 1.651 4.255 4.649 3.996 7.823 l -1.083 20.019 c -0.036 0.675 -0.411 1.285 -0.997 1.624 c -0.584 0.337 -1.303 0.356 -1.905 0.052 c -2.392 -1.213 -4.975 -1.828 -7.679 -1.828 c -9.376 0 -17.004 7.629 -17.004 17.005 c 0 1.105 -0.896 2 -2 2 s -2 -0.896 -2 -2 c 0 -5.001 1.756 -9.598 4.684 -13.209 C 30.577 52.465 28.286 51.99 25.951 51.99 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    </g>
                                </svg>

                                <div><label for="Fuerza">Força:</label></div>
                                <div id="Fuerza">

                                </div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <!-- <i class="bi bi-lightning-fill"></i> -->

                                <img src="..\img\fondos\noun-agility-4494012.svg" width="25" height="25" alt="imagen de destreza">
                                <div><label for="Destreza">Habilitat:</label></div>
                                <div id="Destreza"></div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <i class="bi bi-shield mr-1"></i>
                                <div><label for="Constitucion">Constitució:</label></div>
                                <div id="Constitucion"></div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <i class="bi bi-lightbulb mr-1"></i>
                                <div><label for="Inteligencia">intel·ligència:</label></div>
                                <div id="Inteligencia"></div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <i class="bi bi-book mr-1"></i>
                                <div><label for="Sabiduria">Saviesa:</label></div>
                                <div id="Sabiduria"></div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-xl-4 h4">
                            <div class="row d-flex justify-content-sm-center">
                                <i class="bi bi-emoji-smile mr-1"></i>
                                <div><label for="Carisma">Carisma:</label></div>
                                <div id="Carisma"></div>
                            </div>
                        </div>

                    </div>
                    <div id="inventari">
                        <div id="arma">
                            <div>
                                <h2>Arma</h2>
                            </div>
                            <hr>
                            <div id="armes">

                            </div>

                        </div>


                        <div id="armadura">
                            <div>
                                <h2>Armadura</h2>
                            </div>
                            <hr>
                            <div id="armadures">

                            </div>
                        </div>
                        <div id="pocio">
                            <div>
                                <h2>Poció</h2>
                            </div>
                            <hr>
                            <div id="objetos">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>
    </div>






</body>

</html>