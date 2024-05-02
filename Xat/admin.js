	// Connexió
    let connexio;

    function init() {

         // Nom del jugador
         let nomJugador = document.getElementById("name").textContent;
         let Codi = $('#Codi').text();
       
         // Local o remot
        //Canviar el mapa
        $('#mapa').on('change', function() {
            let mapa = document.getElementById("mapa").value;
            
            $('#fondo').css('background-image', 'url("../img/mapa/' + mapa + '.webp")');
            $('#fondo').css('background-size', 'cover');
            
            connexio.send(JSON.stringify({mapa: mapa, accio: "CanviMapa"}));

            

        });

       


        /**
         * Mostrar/ocultar modal
         */
        $('.close').on('click', function() {
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

            

            let nivel = $('#nivel').text();
            let Vida = $('#Vida').text();
            let Iniciativa = $('#Iniciativa').text();
            let Fuerza = $('#Fuerza').val();
            let Destreza = $('#Destreza').val();
            let Constitucion = $('#Constitucion').val();
            let Inteligencia = $('#Inteligencia').val();
            let Sabiduria = $('#Sabiduria').val();
            let Carisma = $('#Carisma').val();
            let text ='Estas segur que vols actualitzar aquest jugador?'

            confirm( text) ? connexio.send(JSON.stringify({id: id, nivel: nivel, Vida: Vida, Iniciativa: Iniciativa, Fuerza: Fuerza, Destreza: Destreza, Constitucion: Constitucion, Inteligencia: Inteligencia, Sabiduria: Sabiduria, Carisma: Carisma, accio: "updateCharacter"})) : null;
       
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
                        
                        if (data.info.id == data.info.id) {
                            $('#modal').css('display', 'block');
                            $('#modal').show();
                            
                            $('#NomPersonatge').text(data.info.NomPersonatge);

                            $('#id').text(data.info.id);
                            $('#raza').text(data.info.raza);
                            $('#clase').text(data.info.clase);
                            $('#nivel').text(data.info.nivel);
                            $('#Vida').text(data.info.Vida);
                            $('#Iniciativa').text(data.info.Iniciativa);
                            $('#Fuerza').val(data.info.Fuerza);
                            $('#Destreza').val(data.info.Destreza);
                            $('#Constitucion').val(data.info.Constitucion);
                            $('#Inteligencia').val(data.info.Inteligencia);
                            $('#Sabiduria').val(data.info.Sabiduria);
                            $('#Carisma').val(data.info.Carisma);
                            $('#Img').attr('src', '../img/avatar/' + data.info.Img);


                        }
                    
                        
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

                case 'desconectarJugador':
                    
                    while (document.getElementById(data.id)) {
                        document.getElementById(data.id).remove();
                    }

                    while (document.getElementById(data.idPersonaje)) {
                        document.getElementById(data.idPersonaje).remove();
                    }
                   
                   break;


                case 'moureJugador':
                    let jugador = document.getElementById(data.id);
                    jugador.style.left = data.x + 'px';
                    jugador.style.top = data.y + 'px';
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