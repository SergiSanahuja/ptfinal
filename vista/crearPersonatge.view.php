<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fondos/favicon.ico" type="image/x-icon">
    <title>Crear Personatge</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/crearPersonatge.css">
    <!-- CSS -->
    <!-- Bootstrap JS and jQuery -->
    <script type="module" src="../personatge/personatge.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>

    

    <div class="character-container">
        <div class="row">
            <div class="col">
                <h1>Crear personatge</h1>
            </div>
            <div>
                <a href="../index.php" class="mr-3" id="cross" style=" font-size:1.6rem;">&times;</a>
            </div>
        </div>
  
      
<!-- Formulari per crear el personatge -->
        <form id="login-form" action="../controlador/crearPersonatge.controller.php" method="post" enctype="multipart/form-data">
            <div class="container">

                <div class="row H-70">
                    <div class="col-sm col" id="imgPerfil">                        
                        <?php  
                          if(isset($_SESSION['errorPersonatge'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['errorPersonatge'] . '</div>';
                          
                          }
                        
                        ?>
                    
                        <div id="drop_zone" style="width: 200px; height: 200px; border: 2px solid black;">
                            Arrosegua la imatge aquí
                        </div>

                          <input type="file" class="form-control mt-2 mb-2 imgPerfil" accept="image/jpeg, image/png" id="inputFile" aria-label="Introduir una imatge" name="imgPerfil[]">
                          <input type="text" class="form-control mt-2 mb-2 imgPerfil" id="nomImgPerfil" aria-label="nom de la imatge" name="nomImgPerfil" hidden> 
                        

                    </div>

                    <div class="col-sm pt-3 pb-3 datos">
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <label for="nombre" class="h2 mb-0 mr-2">Nom:</label>
                                <input type="text" name="nombre" id="nombre" maxlength="20" placeholder="Nombre">

                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col d-flex justify-content-center">
                                <select name="raza" id="raza" aria-label="selecciona una raça">
                                    <option value="Raza" default>Raza</option>
                                    <option value="Humà">Humà</option>
                                    <option value="Elf">Elf</option>
                                    <option value="Nan">Nan</option>
                                    <option value="Orc">Orc</option>
                                </select>
                            </div>
                            <div class="col d-flex justify-content-center">
                                <select name="clase" id="clase" aria-label="selecciona una clase">
                                    <option value="Class">Clase</option>
                                    <option value="Guerrer">Guerrer</option>
                                    <option value="Mag">Mag</option>
                                    <option value="Arquer">Arquer</option>
                                    <option value="Assassí">Assassí</option>
                                </select>
                            </div>
                        </div>


                        <div class="row bg-secondary justify-content-center pt-1 mb-4">
                           
                            <div class="col-sm-12 col-xl-6 col-12 d-flex justify-content-center" >
                                <label for="vida" class="h2 mb-0">Vida:</label>
                                <input type="number" value="<?php echo isset($_POST['vida']) ? $_POST['vida'] : 5 ?>" name="vida" id="vida" min=0 max=9999 class="bg-secondary" aria-label="Vida" style="border: none; color:white;">
                            </div>
                            
                            
                            <div class="col-sm-12 col-xl-6 col-12 d-flex justify-content-center" >
                                <label for="iniciativa" class="h3 mb-0">Iniciativa:</label>                          
                                <input type="number" value="<?php echo isset($_POST['iniciativa']) ? $_POST['iniciativa'] : 5 ?>" name="iniciativa" id="iniciativa" min=0 max=20 class="bg-secondary" aria-label="Iniciativa" style="border: none; color:white;">
                                
                            </div>
                            
                        </div>
                        <div class="stats">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Fuerza"> Força:</label>
                                    </div>
                                    
                                    <div class="row justify-content-center">

                                        <div >
                                          <input type="number" value="<?php echo isset($_POST['Fuerza']) ? $_POST['Fuerza'] : 5 ?>" name="Fuerza" id="Fuerza" min=0 max=20 aria-label="Força" style="border: none; color:white;">
                                        </div>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Destreza">Habilitat:</label>
                                    </div>
                        
                                    <div class="row justify-content-center">
                                        <div>
                                            <input type="number" value="<?php echo isset($_POST['Destreza']) ? $_POST['Destreza'] : 5 ?>" name="Destreza"  id="Destreza" min=0 max=20 aria-label="Habilitat" style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Constitucion">Constitució:</label>
                                    </div>
                                
                                    <div class="row justify-content-center">
                                        <div >
                                            <input type="number" value="<?php echo isset($_POST['Constitucion']) ? $_POST['Constitucion'] : 5 ?>" name="Constitucion" id="Constitucion" min=0 max=20 aria-label="Constitucio" style="border: none; color:white;">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-5">

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Inteligencia">Intel·ligència:</label>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div >
                                            <input type="number" value="<?php echo isset($_POST['Inteligencia']) ? $_POST['Inteligencia'] : 5 ?>" name="Inteligencia" id="Inteligencia" min=0 max=20 aria-label="Intel·ligencia" style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="row justify-content-center">
                                        <label for="Sabiduria">Saviesa:</label>
                                    </div>
                              
                                    <div class="row justify-content-center">
                                        <div >
                                            <input type="number" value="<?php echo isset($_POST['Sabiduria']) ? $_POST['Sabiduria'] : 5 ?>" name="Sabiduria" id="Sabiduria" min=0 max=20 aria-label="Saviesa" style="border: none; color:white;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col ">
                                    <div class="row justify-content-center">
                                        <label for="Carisma">Carisma:</label>
                                    </div>
                                  
                                    <div class="row justify-content-center">
                                        <div >
                                            <input type="number" value="<?php echo isset($_POST['Carisma']) ? $_POST['Carisma'] : 5 ?>" name="Carisma" id="Carisma" min=0 max=20 aria-label="Carisma" style="border: none; color:white;">
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

</body>

</html>