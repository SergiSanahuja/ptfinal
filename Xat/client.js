	// Connexió
    let connexio;

    function init() {
        // Local o remot

        let nomJugador = document.getElementById("name").textContent;

        let domini;
        if (window.location.protocol == "file:") domini = "localhost";
        else domini = window.location.hostname;

        // Creació de la connexió
        let url = "ws://" + domini + ":8180";
        connexio = new WebSocket(url);

        // Quan s'obre la connexió, enviar missatge al servidor
        connexio.onopen = () => {
            connexio.send(JSON.stringify({nom: nomJugador, accio: "nouJugador"}));
            
        }

        

        // Quan arriba un missatge, mostrar-lo per consola
        connexio.onmessage = e => {
            let d = document.getElementById('XatGlobal');
            d.innerHTML += "<p>" + e.data + "</p>";
            d.scroll(0,d.scrollHeight);
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