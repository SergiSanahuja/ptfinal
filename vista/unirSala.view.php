<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <script defer src="../Xat/client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
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
        <a class="navbar-brand" href="index.controler.php">FinalD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            session_start();

            if(isset($_SESSION['user'])){
                echo '<div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav
                ml-auto">
                <li class="nav-item">
                    <div id="name" class="nav-link" ">'.$_SESSION['username'].'</div>
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
                
                
            </div>
            <div id="fondo" class="col-md-9  bg-danger col-sm-7">                
                <div class="bg-info">
                    
                        <div class="row mt-2">
                            <div class="col">
                                <h1>Sala</h1>
                                
                            </div>
                           

                        </div>
                    </div>
                
            </div>
            
        </div>
    </div>
   

        


</body>
</html>