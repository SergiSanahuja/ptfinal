	// Connexió
    let connexio;
    

    function init() {
        // Local o remot
        //Canviar el mapa
        $('#mapa').on('change', function() {
            let mapa = document.getElementById("mapa").value;
            
            $('#fondo').css('background-image', 'url("../img/mapa/' + mapa + '.webp")');
            $('#fondo').css('background-size', 'cover');
            
            connexio.send(JSON.stringify({mapa: mapa, accio: "CanviMapa"}));

        });

      


        $('.close').on('click', function() {
            $('#modal').css('display', 'none');
        }
        );
       

   
        // Nom del jugador
        let nomJugador = document.getElementById("name").textContent;
        let Codi = $('#Codi').text();
        let idJugador = $('#id').text();
        let idPersonatge = $('#idPersonatge').text();

        //coneixió amb el servidor mjs
        let domini;
        if (window.location.protocol == "file:") domini = "localhost";
        else domini = window.location.hostname;

        // Creació de la connexió
        let url = "ws://" + domini + ":8180";
        connexio = new WebSocket(url);

        // Quan s'obre la connexió, enviar missatge al servidor
        connexio.onopen = () => {

            connexio.send(JSON.stringify({nom: nomJugador,admin:false ,accio: "nouJugador"}));
            connexio.send(JSON.stringify({codi:Codi, pesontage: idPersonatge ,accio: "crearSala"}));
          

           

            
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

                case 'introduirCodi':
                   
                    modal.style.display = "block";
                    modal.showModal();
                    
                    break;

                case 'denegarSala':
                    alert("Sala no trobada");
                    window.location.href = "index.controler.php";
                    break;


                case 'TancarSala':
                    alert("Sala tancada");
                    window.location.href = "index.controler.php";
                    break;


                case 'infoJugador':                    

                
                   
                    while (document.getElementById(data.info.id)) {
                        document.getElementById(data.info.id).remove();
                    }
                
                
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
                        // div.style.position = 'absolute';    
                        div.style.zIndex = 1000;

                        //treure qualsevol pare actual i afegir-lo a body
                        document.body.append(div);
                        var fondo = document.getElementById('fondo');

                        //centrar el div sota el ratolí
                        function moveAt(pageX, pageY) {
                            div.style.left = pageX - div.offsetWidth / 2 + 'px';
                            div.style.top = pageY - div.offsetHeight / 2 + 'px';

                                                    // Limitar las coordenadas al fondo


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
                
                case 'TancarConexio':
                    alert("S'ha tancat la connexió");
                    window.location.href = "index.controler.php";
                    break;
                    

                case 'desconectarJugador':
                    
                    
                        
                    while (document.getElementById(data.id)) {
                       
                        document.getElementById(data.id).remove();

                        


                        

                    }

                    if (data.id == idJugador) {
                        alert("Has sigut desconectat de la sala");
                        window.location.href = "index.controler.php";
                    }
                    
                    

                    break;


                case 'moureJugador':

                    let jugador = document.getElementById(data.id);
                    jugador.style.left = data.posX + 'px';
                    jugador.style.top = data.posY + 'px';
                    break;


                default:
                
                break;
            }

        }

        connexio.onclose = () => {
            alert("Connexió tancada");
            window.location.href = "index.controler.php";
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