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
                <div class="col-12">
                    <h1>Els teus Personatges</h1>
                </div>  
            </div>
            <div class="row">
               <div class="col-6">
                    <input type="text">
               </div>
            </div>

            <div class="row mt-5 justify-content-md-around rounded llista-personatges">
                <?php
                
                   
                    foreach($llistaPersonatges as $personatge){
                        echo '  
                                    <div class="col-sm-12 col-md-5 p-1 col-lg-5 cartaPersonatge">
                                        
                                            <div class="fitxaPersonatge row ">
                                                <div class="col-lg-3 col-sm-3 col-md-4 align-self-center">                                                    
                                                    <img src="../img/avatar/'.$personatge['Img'].'" class="img-fluid rounded-circle "  alt="imatge de perfil">
                                                </div>
                                                <div class="col-lg-9 col-sm-9 col-md-8">
                                                    <div class="row  ">
                                                        <div class="mt-lg-4 mt-sm-4 mt-md-3 col-sm-3 col-md-6 col-lg-12 ">
                                                            <h2 class="card-title mt-2 ">'.$personatge['nom'].'</h2>
                                                        </div>
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