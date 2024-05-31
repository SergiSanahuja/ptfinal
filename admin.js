	// Connexió
    let connexio;

    function init() {

         // Nom del jugador
         let nomJugador = document.getElementById("name").textContent;
         let Codi = $('#Codi').text();
       
         // Local o remot
        //Canviar el mapa
        // $('#mapa').on('change', function() {
        //     let mapa = document.getElementById("mapa").value;
            
        //     $('#fondo').css('background-image', 'url("../img/mapa/' + mapa + '.webp")');
        //     $('#fondo').css('background-size', 'cover');

            
        //     connexio.send(JSON.stringify({mapa: mapa, accio: "CanviMapa"}));

            

        // });

        //Funció per a canviar el mapa

        $('.mapa').on('click', function() {
            let mapa = this.id
            
            $('#fondo').css('background-image', 'url("../img/mapa/' + mapa + '.webp")');
            $('#fondo').css('background-size', 'cover');
            
            connexio.send(JSON.stringify({mapa: mapa, accio: "CanviMapa"}));

        });

        


        $(".openModalAddObject").on('click', function() {

            if($("#expulsarJugador").prop('disabled') == false){
                $('#expulsarJugador').prop('disabled', true);
                $('#updateCharacter').prop('disabled', true);
            }else{
                $('#expulsarJugador').prop('disabled', false);
                $('#updateCharacter').prop('disabled', false);
            }
            // $('.openModalAddObject').prop('disabled', true);
        });

        $(".closeUseObjectModal").on('click', function() {

         
            $('#expulsarJugador').prop('disabled', false);
            $('#updateCharacter').prop('disabled', false);
            $('.openModalAddObject').prop('disabled', false);
    
            // $('.openModalAddObject').prop('disabled', true);
        });
     


        //Funcio per afegir un objecte a un personatge
        $('#addObject').on('click', function() {

            $('#expulsarJugador').prop('disabled', false);
            $('#updateCharacter').prop('disabled', false);
            $('.openModalAddObject').prop('disabled', false);


            let id = $('#IdPersonaje').text();
            let objecte = $('#objectName').val();
            $('#objectName').empty();
            let quantitat = $('#quantity').val();
            $('#quantity').val(1);
            let categoria = $('#objectType').val();
            let descripcio = $('#objectDescription').val();
            $('#objectDescription').empty();
            
            $("#addObjectModal").modal('hide');
            
            
            if (quantitat < 1 || quantitat > 9999) {
                alert('Has de posar un número entre el 1 i el 9999');
                return;
            }

            
            

            // let text ='Estas segur que vols afegir aquest objecte a aquest jugador?'       

            connexio.send(JSON.stringify({id: id, objecte: objecte,quantitat: quantitat,descripcio:descripcio ,categoria: categoria, accio: "addObject"}));
            
       
        });
       
        $(".closeAddObjectModal").on('click', function() {

            $('#expulsarJugador').prop('disabled', false);
            $('#updateCharacter').prop('disabled', false);
            $('.openModalAddObject').prop('disabled', false);

        });



        /**
         * Mostrar/ocultar modal
         */
        $('.close').on('click', function() {
            $('.openModalAddObject').prop('disabled', false);
            $('#expulsarJugador').prop('disabled', false);
            $('#updateCharacter').prop('disabled', false);
            $('#modal').css('display', 'none');
        }
        );
        // $('.modal').on('click', function() {
        //     $('#modal').css('display', 'none');
        // });


        /**
         * Mostrar/ocultar xat
         */
        $('#ChatHidden').on('click', function() {
            $('#message').toggle();
            $('#XatGlobal').toggle();

        }
        );


        /**
         * Expulsar jugador
         */
        $('#expulsarJugador').on('click', function() {
            let id = $('#id').text();
            let text ='Estas segur que vols expulsar aquest jugador?'

            confirm( text) ? connexio.send(JSON.stringify({id: id, accio: "desconectarJugador"})) : null;
        });
          
        /**
         * Actualitzar personatge
         * 
         */
        $('#updateCharacter').on('click', function() {
            let id = $('#id').text();

            let nivel = $('#nivel').val();
            let Vida = $('#Vida').text();
            let Iniciativa = $('#Iniciativa').text();
            let Fuerza = $('#Fuerza').val();
            let Destreza = $('#Destreza').val();
            let Constitucion = $('#Constitucion').val();
            let Inteligencia = $('#Inteligencia').val();
            let Sabiduria = $('#Sabiduria').val();
            let Carisma = $('#Carisma').val();
            let text ='Estas segur que vols actualitzar aquest jugador?'

            if (nivel < 1 || nivel > 99) {
                alert('El nivel ha de ser un número entre 1 i 99');
                return;
            }

            if (Fuerza < 1 || Fuerza > 99) {
                alert('La fuerza ha de ser un número entre 1 i 99');
                return;
            }

            if (Destreza < 1 || Destreza > 99) {
                alert('La destreza ha de ser un número entre 1 i 99');
                return;
            }


            if (Constitucion < 1 || Constitucion > 99) {
                alert('La constitucion ha de ser un número entre 1 i 99');
                return;
            }

            if (Inteligencia < 1 || Inteligencia > 99) {
                alert('La inteligencia ha de ser un número entre 1 i 99');
                return;
            }

            if (Sabiduria < 1 || Sabiduria > 99) {
                alert('La sabiduria ha de ser un número entre 1 i 99');
                return;
            }   

            if (Carisma < 1 || Carisma > 99) {
                alert('El carisma ha de ser un número entre 1 i 99');
                return;
            }

            confirm( text) ? connexio.send(JSON.stringify({id: id, nivel: nivel, Vida: Vida, Iniciativa: Iniciativa, Fuerza: Fuerza, Destreza: Destreza, Constitucion: Constitucion, Inteligencia: Inteligencia, Sabiduria: Sabiduria, Carisma: Carisma, accio: "updateCharacter"})) : null;
       
        });

        // Canviar vida

        $('#augmentarVida').on('click', function() {

            let id = $('#id').text();
            let vida = $('#vidaInput').val();

            if (vida > 9999 || vida < 1) {
                alert('Has de posar un número entre el 1 i el 9999');
                return;
            }


            connexio.send(JSON.stringify({id: id, vida: vida, accio: "canviarVida"}));
        });

        $('#disminuirVida').on('click', function() {

            let id = $('#id').text();
            let vida = $('#vidaInput').val();

            if (vida > 9999 || vida < 1) {
                alert('Has de posar un número entre el 1 i el 9999');
                return;
            }

            connexio.send(JSON.stringify({id: id, vida: -vida, accio: "canviarVida"}));
        });


        //Funcio per a eliminar la catitat d'objectes que ha sigut utilitzada
        $("#useObject").on('click', function() {

            let cantitat = parseInt($("#QuantityObjectsUseing").val())
            let nom_Objeto = $('#objectNameUse').text();
            let id = $('#IdPersonaje').text();

            if (cantitat < 1 || cantitat > 9999) {
                alert('Has de posar un número entre el 1 i el 9999');
                return;
            }

            if (nom_Objeto.length == 0) {
                alert('Has de posar un nom d\'objecte');
                return;
            }

            confirm('Estas segur que vols utilitzar '+ cantitat+' de '+nom_Objeto+'?') ? connexio.send(JSON.stringify({id: id, cantitat: cantitat, nom_Objeto: nom_Objeto, accio: "useObject"})) : null;
      

        });



        //coneixió amb el servidor mjs
        let domini;
        if (window.location.protocol == "file:") domini = "localhost";
        else domini = window.location.hostname;

        // Creació de la connexió
        let url = "ws://" + domini + ":8180";
        connexio = new WebSocket(url);

        // Quan s'obre la connexió, enviar missatge al servidor
        connexio.onopen = () => {
        
            connexio.send(JSON.stringify({nom: nomJugador,admin:true, accio: "nouJugador"}));
            connexio.send(JSON.stringify({codi:Codi, accio:'crearSala'}) );
            // connexio.send(JSON.stringify({accio:'crearSala'}) );
            
            
        }

        

        //Detecta que el servidor enviat un missatge
        connexio.onmessage = e => {

            let data =  JSON.parse(e.data);
            let d = document.getElementById('XatGlobal');


            switch (data.accio) {
                case 'nouJugador':
                    /**
                     * Mostrar missatge de nou jugador
                     */
                    d.innerHTML += "<p>S'ha conectat " + data.nom + "</p>";
                    d.scroll(0,d.scrollHeight);


                    break;

                case 'missatge':
                   /**
                    * Mostrar missatge de xat
                    */
                    d.innerHTML += "<p>"+data.nom+": " + data.msg + "</p>";
                    d.scroll(0,d.scrollHeight);

                    break;

                case 'CanviMapa':
                    $('#fondo').css('background-image', 'url("../img/mapa/' + data.mapa + '.webp")');
                    $('#fondo').css('background-size', 'cover');
                    break;


                case 'infoJugador':

                
                    while (document.getElementById(data.info.id)) {
                        document.getElementById(data.info.id).remove();
                    }

                    while (document.getElementById(data.info.IdPersonaje)) {
                        document.getElementById(data.info.IdPersonaje).remove();
                    }
                    
                

                    //Crear div amb la imatge del jugador
                    let div = document.createElement('div');
                    div.id = data.info.IdPersonaje;
                    div.style.position = 'absolute';
                    div.style.width = '50px';
                    div.style.height = '50px';
                    div.style.borderRadius = '50%';
                    div.style.textAlign = 'center';
                    div.style.backgroundImage = 'url("../img/avatar/' + data.info.Img + '")';
                    div.style.backgroundSize = 'cover';
                    div.draggable = true;

                    //Crear taula amb la informació del jugador
                    let table = document.getElementById('Users');   
                    let row = document.createElement('tr');
                    let cell = document.createElement('td');
                    cell.id = data.info.id;
                    cell.textContent = data.info.NomPersonatge;
                
                    //Quan es fa click al div, mostrar la informació del jugador
                    cell.addEventListener('click', function() {

                        connexio.send(JSON.stringify({id: data.info.IdPersonaje, accio: "afegirInfo"}));
                                            
                        
                    });
                  
                    row.appendChild(cell);
                    table.appendChild(row);
                
                    //Moure el div amb el ratolí
                    div.onmousedown = function(event) {

                        //preparar para moure, fer-ho absolut i posar-lo per sobre de tot
                        // div.style.position = 'absolute';    
                        div.style.zIndex = 1000;

                        //treure qualsevol pare actual i afegir-lo a body
                        document.body.append(div);

                        //centrar el div sota el ratolí
                        function moveAt(pageX, pageY) {
                            div.style.left = pageX - div.offsetWidth / 2 + 'px';
                            div.style.top = pageY - div.offsetHeight / 2 + 'px';
                        }

                        //moure el div a la posicio absoluta sote el ratolí
                        moveAt(event.pageX, event.pageY);

                        function onMouseMove(event) {
                            moveAt(event.pageX, event.pageY);
                        }

                        $('#fondo').on('mouseleave', function() {
                            document.removeEventListener('mousemove', onMouseMove);
                            div.onmouseup = null;
                        
                        });

                        //moure el div a la posicio absoluta sote el ratolí
                        document.addEventListener('mousemove', onMouseMove);

                        div.onmouseup = function() {
                            document.removeEventListener('mousemove', onMouseMove);

                            // if (event.pageX > fondo.offsetLeft && event.pageX < fondo.offsetLeft + fondo.offsetWidth && event.pageY > fondo.offsetTop && event.pageY < fondo.offsetTop + fondo.offsetHeight) {
                            //     connexio.send(JSON.stringify({id: data.info.IdPersonaje, posX: event.pageX - fondo.offsetLeft, posY: event.pageY - fondo.offsetTop, accio: "moureJugador"}));
                            // }

                            div.onmouseup = null;
                        }
                    }

                    div.ondragstart = function() {
                        return false;
                    }


                    div.textContent = data.info.NomPersonatge;
            
                    document.getElementById('fondo').appendChild(div);        
                


                    
                    break;

                case 'canviarVida':
                    /**
                     * Actualitzar la vida del jugador
                     */
                    $('#Vida').text(data.info);
                    $('#vidaModal').modal('hide');

                    break;

                case 'addObject':

                    //Aquesta part del codi es per a quan el GM afegix un objecte a un jugador, es vegi reflectit en la taula de la informació del jugador sense haver de recargar la fitxa

                    if($('.'+data.nom_Objeto).length > 0){
                        $('.'+data.nom_Objeto).text(data.nom_Objeto+ " - "+ data.quantitat);
                    }else{
                        let div = document.createElement('div');
                        div.textContent = data.nom_Objeto+' - '+data.quantitat;
                        div.className = 'object '+data.nom_Objeto;
                        div.tabIndex = 0;

                        div.addEventListener('click', function() {
                            $("#useObjectModal").modal('show');
                            $('#objectNameUse').text(data.nom_Objeto);
                            $('#quantityUse').text(data.quantitat);
                            $('#objectDescriptionUse').text(data.descripcio);
                        });

                        
                        $('#objetos').append(div);
                    }




                case 'useObject':

                    //Aquesta part del codi es per a quan el jugador utilitza un objecte, es vegi reflectit en la taula de la informació del jugador sense haver de recargar la fitxa

                    if(data.info > 0){
                        
                        $('.'+data.clase).text(data.clase+ " - "+ data.info);
                    }else{
                        $('.'+data.clase).remove();
                    }

                        $('.openModalAddObject').prop('disabled', false);
                        $('#expulsarJugador').prop('disabled', false);
                        $('#updateCharacter').prop('disabled', false);
                        $('#useObjectModal').modal('hide');

                        break;

                
                case 'eliminarObjecte':

                    $('.'+data.nom_Objeto).remove();
                 
                    break;                   

                case 'desconectarJugador':
                    
                    while (document.getElementById(data.id)) {
                        document.getElementById(data.id).remove();
                    }

                    while (document.getElementById(data.idPersonaje)) {
                        document.getElementById(data.idPersonaje).remove();
                    }
                   
                    $('#modal').css('display', 'none');

                   break;


                case 'moureJugador':

                    /**
                     * TODO: Moure el jugador
                     */

                    let jugador = document.getElementById(data.id);
                    jugador.style.left = data.x + 'px';
                    jugador.style.top = data.y + 'px';
                    break;


                case 'afegirInfo':

                    /**
                     * Mostrar la informació del jugador actualitzada cada cop que es fa click al nom del jugador a la taula
                     */

                    if (data.info.id == data.info.id) {
                        $('#modal').css('display', 'block');
                        $('#modal').show();
                        
                        $('#NomPersonatge').text(data.info.NomPersonatge);

                        $('#id').text(data.info.id);
                        $('#IdPersonaje').text(data.info.IdPersonaje);
                        $('#raza').text(data.info.raza);
                        $('#clase').text(data.info.clase);
                        $('#nivel').val(data.info.nivel);
                        $('#Vida').text(data.info.Vida);
                        $('#Iniciativa').text(data.info.Iniciativa);
                        $('#Fuerza').val(data.info.Fuerza);
                        $('#Destreza').val(data.info.Destreza);
                        $('#Constitucion').val(data.info.Constitucion);
                        $('#Inteligencia').val(data.info.Inteligencia);
                        $('#Sabiduria').val(data.info.Sabiduria);
                        $('#Carisma').val(data.info.Carisma);
                        $('#Img').attr('src', '../img/avatar/' + data.info.Img);

                      
                        // Per a cada arma posar un event listener per a eliminar-la
                        $('#armes').empty();
                        data.info.armes.forEach(arme => {
                            let div = document.createElement('div');
                            div.textContent = arme.nom_Objeto;
                            div.className = arme.nom_Objeto;
                            
                            div.tabIndex = 0;
                        
                            div.addEventListener('click', function() {
                                // Aquí puedes añadir el código para eliminar la arma
                                // Por ejemplo, puedes hacer una petición AJAX a tu servidor para eliminar la arma de la base de datos
                                connexio.send(JSON.stringify({id: data.info.IdPersonaje,nom_Objeto: arme.nom_Objeto,categoria: "arma", accio: "eliminarObjecte"}));
                            });
                        
                            $('#armes').append(div);
                        });


                        $('#armadures').empty();
                        data.info.armadures.forEach(armure => {
                            let div = document.createElement('div');
                            div.textContent = armure.nom_Objeto;
                            div.className = armure.nom_Objeto;
                            
                            div.tabIndex = 0;
                        
                            div.addEventListener('click', function() {
                                // Aquí puedes añadir el código para eliminar la armadura
                                // Por ejemplo, puedes hacer una petición AJAX a tu servidor para eliminar la armadura de la base de datos
                                connexio.send(JSON.stringify({id: data.info.IdPersonaje,nom_Objeto: armure.nom_Objeto,categoria: "armadura", accio: "eliminarObjecte"}));
                            });
                        
                            $('#armadures').append(div);
                        }
                        );

                        $('#objetos').empty();
                        data.info.objetos.forEach(objeto => {
                           let div = document.createElement('div');
                            
                             div.textContent = objeto.nom_Objeto+' - '+objeto.cantidad;
                             div.className = 'object '+objeto.nom_Objeto;
                             
                             div.tabIndex = 0;

                             div.addEventListener('click', function() {
                                $("#useObjectModal").modal('show');
                                $('#objectNameUse').text(objeto.nom_Objeto);
                                $('#quantityUse').text(objeto.cantidad);
                                $('#objectDescriptionUse').text(objeto.descripcion);

                                if($("#expulsarJugador").prop('disabled') == false){
                                    $('#expulsarJugador').prop('disabled', true);
                                    $('#updateCharacter').prop('disabled', true);
                                    $('.openModalAddObject').prop('disabled', true);
                                }else{
                                    $('#expulsarJugador').prop('disabled', false);
                                    $('#updateCharacter').prop('disabled', false);
                                    $('.openModalAddObject').prop('disabled', false);
                                }


                             });


                            $('#objetos').append(div);
                        });


                    }
                    break;
         

                default:
                
                break;
            }

        }
        
        // Quan es produeix un error, mostrar-lo per consola
        connexio.onerror = error => {
            alert("Error en la connexió: " + error);
        }

        
    }

    // Enviar missatge
    function enviar(ev) {
        let missatge = document.getElementById("missatge");
        connexio.send(JSON.stringify({msg: missatge.value.replace(/\r\n|\r|\n/g,"<br>"), accio: "missatge"}));
        missatge.value = "";
        missatge.focus();
        if (ev) ev.preventDefault();
    }
    
    function enter(ev) {
        let key = window.event.keyCode;

        if (key === 13 && !ev.shiftKey) {
            enviar();
            ev.preventDefault();
            return false;
        }
        else {
            return true;
        }
    }
    
    

    window.onload = init;