/******************************************************************************
*					SERVIDOR WEB SOCKETS (port 8180)
******************************************************************************/

// Afegir el mòdul 'ws'
import WebSocket, {WebSocketServer} from 'ws';
let admin = null;
let salas = {}

// Crear servidor WebSockets i escoltar en el port 8180
const wsServer = new WebSocketServer({ port:8180 })
console.log("Servidor WebSocket escoltant en http://localhost:8180");

// Enviar missatge a tothom excepte a 'clientExclos'
//	(si no s'especifica qui és el 'clientExclos', s'envia a tots els clients)
function broadcast(missatge, clientExclos) {
	wsServer.clients.forEach(function each(client) {
		if (client.readyState === WebSocket.OPEN && client !== clientExclos) {
			client.send(missatge);
		}
	});
}

let activeConnections = 0;
// Al rebre un nou client (nova connexió)
wsServer.on('connection', (client, peticio) => {
	// Guardar identificador (IP i Port) del nou client
	

	let id = peticio.socket.remoteAddress + ":" + peticio.socket.remotePort;

    if (admin === null) {
        admin = client;
        client.send(`Benvingut <strong>${id}</strong>. Eres el administrador de la sala.`);
        console.log(`El administrador de la sala es: ${id}`);
    } else {
        client.send(`Benvingut <strong>${id}</strong>`);
    }
	// Enviar salutació al nou client
	//	i avisar a tots els altres que s'ha afegit un nou client
	
	

	// Al rebre un missatge d'aques client
	//	reenviar-lo a tothom (inclòs ell mateix)
	client.on('message', missatge => {
        missatge = JSON.parse(missatge);

        switch (missatge.accio) {
              	case  'nouJugador':
                    
					client.nomJugador = missatge.nom;
					broadcast(JSON.stringify({nom: client.nomJugador, accio: "nouJugador"}));	

					break;
			    case 'crearSala':
					let codigoSala = generarCodigoSala();
					salas[codigoSala] = [client];
					client.send(JSON.stringify({msg:`Has creat la sala ${codigoSala}`,accio: "missatge"}));
					break;

				case 'unirseSala':
					if (salas[missatge.codigoSala]) {
						salas[missatge.codigoSala].push(client);
						client.send(`Te has unido a la sala ${missatge.codigoSala}`);
					} else {
						client.send(`La sala ${missatge.codigoSala} no existe`);
					}
					break;

                case 'missatge':
                    if (missatge.msg.length > 200) { // Limitar a 200 caracteres
                        client.send('El teu missatge és massa llarg. Limita els teus missatges a 200 caràcters.');
                    } else {

                        broadcast(JSON.stringify({msg: `<strong>${client.nomJugador}: </strong>${missatge.msg}`, accio: "missatge"}));
                        // broadcast(`<strong>${client.nomJugador}: </strong>${missatge.msg}`);
                        console.log(`Missatge de ${id} --> ${missatge.msg}`);
                    }

                    break;
				
				case 'CanviMapa':
					broadcast(JSON.stringify({mapa: missatge.mapa, accio: "CanviMapa"}), client);
					break;

        
            default:
                break;
        }

		function generarCodigoSala() {
			return Math.random().toString(36).substring(2, 7);
		}
	});
});



/******************************************************************************
*						SERVIDOR WEB (port 8080)
******************************************************************************/

import { createServer } from 'http';
import { parse } from 'url';
import { existsSync, readFile } from 'fs';

function header(resposta, codi, cType) {
	resposta.setHeader('Access-Control-Allow-Origin', '*');
	resposta.setHeader('Access-Control-Allow-Methods', 'GET');
	if (cType) resposta.writeHead(codi, {'Content-Type': cType});
	else resposta.writeHead(codi);
}

function enviarArxiu(resposta, dades, filename, cType, err) {
	if (err) {
		header(resposta, 400, 'text/html');
		resposta.end("<p style='text-align:center;font-size:1.2rem;font-weight:bold;color:red'>Error al l legir l'arxiu</p>");
		return;
	}

	header(resposta, 200, cType);
	resposta.write(dades);
	resposta.end();
}

function onRequest(peticio, resposta) {
	let cosPeticio = "";

	peticio.on('error', function(err) {
		console.error(err);
	}).on('data', function(dades) {
		cosPeticio += dades;
	}).on('end', function() {
		resposta.on('error', function(err) {
			console.error(err);
		});

		if (peticio.method == 'GET') {
			let q = parse(peticio.url, true);
			let filename = "." + q.pathname;

			if (filename == "./") filename += "index.html";
			if (existsSync(filename)) {
				readFile(filename, function(err, dades) {
					enviarArxiu(resposta, dades, filename, undefined, err);
					});
			}
			else {
				header(resposta, 404, 'text/html');
				resposta.end("<p style='text-align:center;font-size:1.2rem;font-weight:bold;color:red'>404 Not Found</p>");
			}
		}
	});
}

let server = createServer();
server.on('request', onRequest);

server.listen(8080);	
console.log("Servidor escoltant en http://localhost:8080");
