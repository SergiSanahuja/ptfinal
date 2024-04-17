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
   
        // Nom del jugador
        let nomJugador = document.getElementById("name").textContent;
        let Codi = $('#Codi').text();

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
            connexio.send(JSON.stringify({codi:Codi,  accio: "crearSala"}));

           

            
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

                        
                    let canvas = document.getElementById('fondo');
                    let ctx = canvas.getContext('2d');
                
                    let img = new Image();
                    img.src = '../img/avatar/' + data.info.Img ;
                
                    img.onload = function() {
                        ctx.beginPath();
                        ctx.arc(100, 100, 50, 0, Math.PI * 2, true);
                        ctx.closePath();
                        ctx.clip();
                
                        ctx.drawImage(img, 50, 50, 100, 100);
                    };

                
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