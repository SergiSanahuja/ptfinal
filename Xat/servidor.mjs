/******************************************************************************
*					SERVIDOR WEB SOCKETS (port 8180)
******************************************************************************/

// Afegir el mòdul 'ws'
import WebSocket, {WebSocketServer} from 'ws';
import mysql from 'mysql2/promise';

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

var con = mysql.createPool({
	host: "localhost",
	user: "root",
	password: "",
	database: "finald"
});




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
	client.on('message',async missatge => {
        missatge = JSON.parse(missatge);

        switch (missatge.accio) {
              	case  'nouJugador':
                    
					  client.nomJugador = missatge.nom;
					  client.admin = missatge.admin;						
									
					break;				
				case 'crearSala':
					missatge.codi = missatge.codi.trim();
					missatge.codi = missatge.codi.replace(/[^a-zA-Z0-9]/g, '');

				
					if (!salas[missatge.codi]) {
						salas[missatge.codi] = [];
					}

					client.sala = missatge.codi;
					salas[missatge.codi].push(client);

					try {

						if (!client.admin) {
							const [rows, fields] = await con.execute("SELECT u.id,u.nom,p.nom as NomPersonatge,p.raza,p.clase,p.nivel,p.Vida,p.Iniciativa,p.Fuerza,p.Destreza,p.Constitucion,p.Inteligencia,p.Sabiduria,p.Carisma,p.Img FROM usuaris u INNER JOIN personatges p ON p.id_Usuari = u.id WHERE u.nom = ?", [client.nomJugador]);
							const infoClient = rows[0];
							
							console.log(infoClient);

							client.id = infoClient.id;

							if (client.sala && salas[client.sala]) {
								salas[client.sala].forEach((clients) => {
									
									clients.send(JSON.stringify({accio: "infoJugador", info: infoClient}));
									
									
								});
							}

						} else {
							
						}


					} catch (err) {
							console.log(err);		
					}	
					

					
					break;
								   
                case 'missatge':
					if (client.sala && salas[client.sala]) {
						salas[client.sala].forEach((clients) => {
							
							clients.send(JSON.stringify({nom: client.nomJugador, msg: missatge.msg, accio: "missatge"}));
							
						});
					}
					break;
					
				
				case 'CanviMapa':

					if(client.sala && salas[client.sala]) {
						salas[client.sala].forEach((clients) => {
							clients.send(JSON.stringify({mapa: missatge.mapa, accio: "CanviMapa"}));
						});
					}

					// broadcast(JSON.stringify({mapa: missatge.mapa, accio: "CanviMapa"}), client);
					break;

        
            default:
                break;
        }


		client.on('close', () => {
			if(client.admin) {
				if(client.salas && salas[client.sala]) {
					salas[client.sala].forEach((clients) => {
						clients.send(JSON.stringify({ accio: "TancarSala"}));
					});
				}
			}else{

				if(client.sala && salas[client.sala]) {
					salas[client.sala].forEach((clients) => {
						clients.send(JSON.stringify({id: client.id, accio: "desconectarJugador"}));
					});
				}
			}
		});

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
