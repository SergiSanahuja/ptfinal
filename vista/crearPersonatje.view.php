<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/crearPersonatje.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script type="module" src="../Personatje/personatje.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>


    <div class="character-container">
        <div class="row">
            <div class="col">
                <h1>Crear Personatje</h1>
            </div>
            <div>
                <a href="index.controler.php" class="mr-3" id="cross" style=" font-size:1.6rem;">&times;</a>
            </div>
        </div>
  
      

        <form id="login-form" action="../controlador/crearPersonatje.controller.php" method="post" enctype="multipart/form-data">
            <div class="container">

                <div class="row H-70">
                    <div class="col-sm col" id="imgPerfil">
                        
                        <?php  
                            
                          if(isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                          }
                           
                        
                        ?>
                    
                        <div id="drop_zone" style="width: 200px; height: 200px; border: 1px solid black;">
                            Arrastra una imagen aquí
                        </div>

                          <input type="file" class="form-control mt-2 mb-2 imgPerfil" accept="image/jpeg, image/png" id="inputFile" name="imgPerfil[]">
                          <input type="text" class="form-control mt-2 mb-2 imgPerfil" id="nomImgPerfil" name="nomImgPerfil" hidden> 
                        

                    </div>

                    <div class="col-sm pt-3 pb-3 datos">
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre">

                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col d-flex justify-content-center">
                                <select name="raza" id="raza">
                                    <option value="Raza" default>Raza</option>
                                    <option value="Humano">Humano</option>
                                    <option value="Elfo">Elfo</option>
                                    <option value="Enano">Enano</option>
                                    <option value="Orco">Orco</option>
                                </select>
                            </div>
                            <div class="col d-flex justify-content-center">
                                <select name="clase" id="clase">
                                    <option value="Class">Clase</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Mago">Mago</option>
                                    <option value="Arquero">Arquero</option>
                                    <option value="Asesino">Asesino</option>
                                </select>
                            </div>
                        </div>


                        <div class="stats">
                            <div class="row bg-secondary pt-1 mb-4">
                                <div class="col-6 col-md-3 align-content-center">
                                    <label for="vida">Vida:</label>
                                </div>
                                <div class="col-6  col-md-3 align-content-center" id="vida">
                                    <input type="number" value="<?php echo isset($_POST['vida']) ? $_POST['vida'] : 5 ?>" name="vida" min=0 max=20 class="bg-secondary" style="border: none; color:white;">
                                </div>
                               
                                <div class="col-6 col-md-3" >
                                    <label for="iniciativa">Iniciativa:</label>
                                </div>
                               
                                <div class="col-6 col-md-3"  id="iniciativa">
                                    <input type="number" value="<?php echo isset($_POST['iniciativa']) ? $_POST['iniciativa'] : 5 ?>" name="iniciativa" min=0 max=20 class="bg-secondary" style="border: none; color:white;">
                                    
                                </div>

                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Fuerza"> Fuerza:</label>
                                    </div>
                                    
                                    <div class="row justify-content-center">

                                        <div id="Fuerza">
                                          <input type="number" value="<?php echo isset($_POST['Fuerza']) ? $_POST['Fuerza'] : 5 ?>" name="Fuerza" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Destreza">Destreza:</label>
                                    </div>
                        
                                    <div class="row justify-content-center">
                                        <div id="Destreza">
                                            <input type="number" value="<?php echo isset($_POST['Destreza']) ? $_POST['Destreza'] : 5 ?>" name="Destreza" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Constitucion">Constitucion:</label>
                                    </div>
                                
                                    <div class="row justify-content-center">
                                        <div id="Constitucion">
                                            <input type="number" value="<?php echo isset($_POST['Constitucion']) ? $_POST['Constitucion'] : 5 ?>" name="Constitucion" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-5">

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Inteligencia">Inteligencia:</label>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div id="Inteligencia">
                                            <input type="number" value="<?php echo isset($_POST['Inteligencia']) ? $_POST['Inteligencia'] : 5 ?>" name="Inteligencia" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Sabiduria">Sabiduria:</label>
                                    </div>
                              
                                    <div class="row justify-content-center">
                                        <div id="Sabiduria">
                                            <input type="number" value="<?php echo isset($_POST['Sabiduria']) ? $_POST['Sabiduria'] : 5 ?>" name="Sabiduria" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col ">
                                    <div class="row justify-content-center">
                                        <label for="Carisma">Carisma:</label>
                                    </div>
                                  
                                    <div class="row justify-content-center">
                                        <div id="Carisma">
                                            <input type="number" value="<?php echo isset($_POST['Carisma']) ? $_POST['Carisma'] : 5 ?>" name="Carisma" min=0 max=20 style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row d-flex justify-content-center">
                            <button type="submit" name="submit">Crear</button>

                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

    </div>

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