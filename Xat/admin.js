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

        $('.modal').on('click', function() {
            $('#modal').css('display', 'none');
        });


        $('#ChatHidden').on('click', function() {
            $('#message').toggle();
            $('#XatGlobal').toggle();
        }
        );


        $('#expulsarJugador').on('click', function() {
            let id = $('#id').text();
            let text ='Estas segur que vols expulsar aquest jugador?'

            confirm( text) ? connexio.send(JSON.stringify({id: id, accio: "desconectarJugador"})) : null;
        });


        

        document.getElementById('closeRoom').addEventListener('change', function() {
            fetch('../controlador/unirSala.controller.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'closeRoom': this.checked ? '1' : '0', 'codi':Codi,
                }),
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch((error) => {
              console.error('Error:', error);
            });
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

        

        // Quan arriba un missatge, mostrar-lo per consola
        connexio.onmessage = e => {

            let data =  JSON.parse(e.data);
            let d = document.getElementById('XatGlobal');


            switch (data.accio) {
                case 'nouJugador':
                    d.innerHTML += "<p>S'ha conectat " + data.nom + "</p>";
                    d.scroll(0,d.scrollHeight);


                    break;

                case 'missatge':
                   
                    d.innerHTML += "<p>"+data.nom+": " + data.msg + "</p>";
                    d.scroll(0,d.scrollHeight);

                    break;

                case 'CanviMapa':
                    $('#fondo').css('background-image', 'url("../img/mapa/' + data.mapa + '.webp")');
                    $('#fondo').css('background-size', 'cover');
                    break;


                case 'infoJugador':

                    let div = document.createElement('div');
                    div.id = data.info.id;
                    div.style.width = '50px';
                    div.style.height = '50px';
                    div.style.borderRadius = '50%';
                    div.style.textAlign = 'center';
                    div.style.backgroundImage = 'url("../img/avatar/' + data.info.Img + '")';
                    div.style.backgroundSize = 'cover';
                    div.draggable = true;

                    let table = document.getElementById('Users');   
                    let row = document.createElement('tr');
                    let cell = document.createElement('td');
                    cell.id = data.info.id;
                    cell.textContent = data.info.NomPersonatge;
                
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
                            $('#Fuerza').text(data.info.Fuerza);
                            $('#Destreza').text(data.info.Destreza);
                            $('#Constitucion').text(data.info.Constitucion);
                            $('#Inteligencia').text(data.info.Inteligencia);
                            $('#Sabiduria').text(data.info.Sabiduria);
                            $('#Carisma').text(data.info.Carisma);
                            $('#Img').attr('src', '../img/avatar/' + data.info.Img);


                        }
                    
                        
                    });
                  
                    row.appendChild(cell);
                    table.appendChild(row);
                
                    div.onmousedown = function(event) {

                        //preparar para moure, fer-ho absolut i posar-lo per sobre de tot
                        div.style.position = 'absolute';    
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

                        //moure el div a la posicio absoluta sote el ratolí
                        document.addEventListener('mousemove', onMouseMove);

                        div.onmouseup = function() {
                            document.removeEventListener('mousemove', onMouseMove);
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