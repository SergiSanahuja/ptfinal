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
					
				case 'afegirInfo':
					// Enviar missatge a tots de la sala
					if (client.sala && salas[client.sala]) {
						salas[client.sala].forEach((clients) => {
							if (clients.character) {
								if(missatge.id == clients.character.IdPersonaje) {
									client.send(JSON.stringify({info: clients.character, accio: "afegirInfo"}));
								}
							}
						});
					}
					
					break;	

				
				case 'crearSala':
					//codi de la sala
					missatge.codi = missatge.codi.trim();
					missatge.codi = missatge.codi.replace(/[^a-zA-Z0-9]/g, '');
					
					if (!salas[missatge.codi]) {
						salas[missatge.codi] = [];
					}

					//guardar la sala al client
					client.sala = missatge.codi;
					salas[missatge.codi].push(client);

					try {


						if (!client.admin) {

							missatge.pesontage = missatge.pesontage.trim();
							missatge.pesontage = missatge.pesontage.replace(/[^a-zA-Z0-9]/g, '');

							//buscar la informació del personatge
							const [rows, fields] = await con.execute("SELECT u.id,p.id as IdPersonaje,u.nom,p.nom as NomPersonatge,p.raza,p.clase,p.nivel,p.Vida,p.Iniciativa,p.Fuerza,p.Destreza,p.Constitucion,p.Inteligencia,p.Sabiduria,p.Carisma,p.Img FROM usuaris u INNER JOIN personatges p ON p.id_Usuari = u.id WHERE p.id = ?", [missatge.pesontage]);
							
							const infoClient = rows[0];

							
							//buscar l'inventari del personatge
							const [rows2, fields2] = await con.execute("SELECT nom_Objeto, descripcion, cantidad FROM inventario WHERE id_Personaje = ? AND categoria='arma'", [missatge.pesontage]);
							infoClient.armes = rows2;

							const [rows3, fields3] = await con.execute("SELECT nom_Objeto, descripcion, cantidad FROM inventario WHERE id_Personaje = ? AND categoria='armadura'", [missatge.pesontage]);
							infoClient.armadures = rows3;

							const [rows4, fields4] = await con.execute("SELECT nom_Objeto, descripcion, cantidad FROM inventario WHERE id_Personaje = ? AND categoria='pocio'", [missatge.pesontage]);
							infoClient.objetos = rows4;


							console.log(infoClient);

							//guardar tota la informació del personatge al client propietari
							client.character = infoClient;

							// client.id = infoClient.id;

							if (client.sala && salas[client.sala]) {
								
								
								salas[client.sala].forEach((clients) => {

									let lastClient = salas[client.sala][salas[client.sala].length - 1];

									if ( clients == lastClient) {
										for (let i = 0; i < salas[client.sala].length; i++) {
											
											if (salas[client.sala][i].character )  {
												clients.send(JSON.stringify({info: salas[client.sala][i].character, accio: "infoJugador"}));
											}
										}

									}else{
										clients.send(JSON.stringify({info: infoClient, accio: "infoJugador"}));
									}
									
									// clients.send(JSON.stringify({info: infoClient, accio: "infoJugador"}));													
									
								});
							}
							
						} 


					} catch (err) {
							console.log(err);		
					}	
					

					
					break;
								   
                case 'missatge':
					// Enviar missatge a tothom de la sala

					//lista de comandos
					if(missatge.msg.startsWith("/")) {

						var comando = missatge.msg.substring(1);
						var msgBot
						
						switch(comando){
							case 'saludo':
								msgBot = "Hola, soy el bot de la sala";
								break;

							case 'd4':
								msgBot = Math.floor(Math.random() * 4) + 1;
								break;
							case 'd6':
								msgBot = Math.floor(Math.random() * 6) + 1;
								break;
							
							case 'd8':
								msgBot = Math.floor(Math.random() * 8) + 1;
								break;

							case 'd10':	
								msgBot = Math.floor(Math.random() * 10) + 1;
								break;
							
							case 'd12':
								msgBot = Math.floor(Math.random() * 12) + 1;
								break;

							case 'd20':
								msgBot = Math.floor(Math.random() * 20) + 1;
								break;
							
							case 'd4 h':
								msgBot = "Tirada de un número entre 1 y 4";
								break;

							case 'd6 h':
								msgBot = "Tirada de un número entre 1 y 6";
								break;

							case 'd8 h':
								msgBot = "Tirada de un número entre 1 y 8";
								break;

							case 'd10 h':
								msgBot = "Tirada de un número entre 1 y 10";
								break;

							case 'd12 h':
								msgBot = "Tirada de un número entre 1 y 12";
								break;

							case 'd20 h':
								msgBot = "Tirada de un número entre 1 y 20";
								break;
								
							case 'help':
								msgBot = "Llista de comandes: /saludo, /help, /d4, /d6, /d8, /d10, /d12, /d20 (si tens algun dubte per cualsevol comanda, afegeix 'h' al final per obtenir més informació (Ex: /d4 h))";
								break
							default:
								msgBot = "Comande no reconeguda, escriu /help per veure la llista de comandes disponibles";
								break;
						}
					}

					if (client.sala && salas[client.sala]) {
						salas[client.sala].forEach((clients) => {
					
							clients.send(JSON.stringify({nom: client.nomJugador, msg: missatge.msg, accio: "missatge"}));

							if(msgBot){
								clients.send(JSON.stringify({nom: "Bot", msg: msgBot, accio: "missatge"}));
							}
							
						});

						msgBot = null;
					}
					break;

						
				
				case 'CanviMapa':
					//canviar el mapa a tots els clients de la sala
					if(client.sala && salas[client.sala]) {
						salas[client.sala].forEach((clients) => {
							clients.send(JSON.stringify({mapa: missatge.mapa, accio: "CanviMapa"}));
						});
					}

					// broadcast(JSON.stringify({mapa: missatge.mapa, accio: "CanviMapa"}), client);
					break;

				case 'addObject':
					try {
					
						if (client.sala && salas[client.sala]) {
							
							if (client.sala && salas[client.sala]) {
								const [rows, fields] =	await con.execute("SELECT * FROM inventario WHERE id_Personaje = ? AND nom_Objeto = ?", [missatge.id, missatge.objecte], function(err, result) {
									if (err) {
										throw err;
									}
								});

								//Comprovar si l'objecte ja existeix en l'inventari
								let inventario = rows;
							
								if (inventario.length > 0) {
									// El objeto ya existe en el inventario, actualizar la cantidad
									con.execute("UPDATE inventario SET cantidad = cantidad + ? WHERE id_Personaje = ? AND nom_Objeto = ?", [missatge.quantitat, missatge.id, missatge.objecte], function(err) {
										if (err) {
											throw err;
										}
									});
								} else {
									// El objeto no existe en el inventario, insertarlo
									con.execute("INSERT INTO inventario (id_Personaje, nom_Objeto, descripcion, cantidad, categoria) VALUES (?, ?, ?, ?, ?)", [missatge.id, missatge.objecte, missatge.descripcio, missatge.quantitat, missatge.categoria], function(err) {
										if (err) {
											throw err;
										}
									});
								}
							
								// con.execute("INSERT INTO inventario (id_Personaje, nom_Objeto, descripcion, cantidad,categoria) VALUES (?, ?, ?, ?, ?)", [missatge.id, missatge.objecte, missatge.descripcio, missatge.quantitat,missatge.categoria], function(err) {	
								// 	if (err) {	
								// 		console.error(err.message);
								// 	}
								// });

								let quantitat = missatge.quantitat;

								salas[client.sala].forEach((clients) => {
									if (clients.character && clients.character.IdPersonaje == missatge.id) {
										if (missatge.categoria == "arma") {
											clients.character.armes.push({nom_Objeto: missatge.objecte, descripcion: missatge.descripcio, cantidad: missatge.quantitat});
										}else if (missatge.categoria == "armadura") {
											clients.character.armadures.push({nom_Objeto: missatge.objecte, descripcion: missatge.descripcio, cantidad: missatge.quantitat});
										}else if (missatge.categoria == "pocio") {

											// Comprovar si l'objecte ja existeix en l'inventari
											let afegeix = true;

											if (clients.character.objetos.length > 0) {
												clients.character.objetos.forEach((objeto) => {

													//Si l'objecte ja existeix, actualitzar la quantitat de l'objecte

													if (objeto.nom_Objeto == missatge.objecte) {
														
														objeto.cantidad =  parseInt(objeto.cantidad) + parseInt(missatge.quantitat);
														quantitat = objeto.cantidad;
														afegeix = false;

													}
												});
											}

											if (afegeix) {

												clients.character.objetos.push({nom_Objeto: missatge.objecte, descripcion: missatge.descripcio, cantidad: missatge.quantitat});
											}

											
										}
										
										for (let i = 0; i < salas[client.sala].length; i++) {
											salas[client.sala][i].send(JSON.stringify({nom_Objeto:missatge.objecte,descripcio: missatge.descripcio, quantitat: quantitat, accio: "addObject"}));
										}	
										// for (let i = 0; i < salas[client.sala].length; i++) {
										// 	salas[client.sala][i].send(JSON.stringify({info: clients.character, accio: "infoJugador"}));
										// }	
										
									}}


								);
								

							
							}

							
						}
					} catch (err) {
						console.log(err);
					}

					break;

				case 'useObject':
					try{

						//agafo la quantitat de l'objecte
						const [rows, fields] = await con.execute("SELECT cantidad FROM inventario WHERE id_Personaje = ? AND nom_Objeto = ? AND categoria = ?", [missatge.id, missatge.nom_Objeto,"pocio"], function(err, rows) {
								if (err) {
									throw err;
								}
							});

						let cantidad = rows[0].cantidad;

						cantidad = parseInt(cantidad) - parseInt(missatge.cantitat);

						if (cantidad > 0) {
							con.execute("UPDATE inventario SET cantidad = ? WHERE id_Personaje = ? AND nom_Objeto = ? AND categoria = 'pocio'", [cantidad , missatge.id, missatge.nom_Objeto], function(err) {
								if (err) {
									throw err;
								}
							});

						}else{
						
							con.execute("DELETE FROM inventario WHERE id_Personaje = ? AND nom_Objeto = ? AND categoria = 'pocio'", [missatge.id, missatge.nom_Objeto], function(err) {
								if (err) {
									throw err;
								}
							});

						};


						
						if (client.sala && salas[client.sala]) {
							salas[client.sala].forEach((clients) => {


								if (clients.character && clients.character.IdPersonaje == missatge.id) {
									clients.character.objetos.forEach((objeto) => {
										if (objeto.nom_Objeto == missatge.nom_Objeto) {
											objeto.cantidad -= missatge.cantitat;
											
											 
										}
										if (objeto.cantidad <= 0) {
											clients.character.objetos.splice(clients.character.objetos.indexOf(objeto), 1);
										}
									});
								}
								for (let i = 0; i < salas[client.sala].length; i++) {
									salas[client.sala][i].send(JSON.stringify({info: cantidad ,clase: missatge.nom_Objeto, accio: "useObject"}));
								}	
							});
						}

					}catch(err){
						console.log(err);
					}
					break;


				case 'desconectarJugador':
					// Enviar missatge a tots de la sala
						if (client.sala && salas[client.sala]) {
							salas[client.sala].forEach((clients) => {
								if (clients.character && clients.character.id == missatge.id) {
									clients.send(JSON.stringify({id: missatge.id, idPersonaje: clients.character.IdPersonaje, accio: "TancarConexio"}));
								}
							});
						}
					break;
					
				case 'updateCharacter':

					try {
						// Enviar missatge a tots de la sala
						

						if (client.sala && salas[client.sala]) {
							salas[client.sala].forEach((clients) => {
								if (clients.character && clients.character.id == missatge.id) {
									clients.character.nivel = missatge.nivel;
									clients.character.Vida = missatge.Vida;
									clients.character.Iniciativa = missatge.Iniciativa;
									clients.character.Fuerza = missatge.Fuerza;
									clients.character.Destreza = missatge.Destreza;
									clients.character.Constitucion = missatge.Constitucion;
									clients.character.Inteligencia = missatge.Inteligencia;
									clients.character.Sabiduria = missatge.Sabiduria;
									clients.character.Carisma = missatge.Carisma;
									
									con.execute("UPDATE personatges SET nivel = ?, Vida = ?, Iniciativa = ?, Fuerza = ?, Destreza = ?, Constitucion = ?, Inteligencia = ?, Sabiduria = ?, Carisma = ? WHERE id = ?", [missatge.nivel, missatge.Vida, missatge.Iniciativa, missatge.Fuerza, missatge.Destreza, missatge.Constitucion, missatge.Inteligencia, missatge.Sabiduria, missatge.Carisma, clients.character.IdPersonaje], function(err) {
										if (err) {
										  console.error(err.message);
										}
									  });

									for (let i = 0; i < salas[client.sala].length; i++) {
										salas[client.sala][i].send(JSON.stringify({info: clients.character, accio: "infoJugador"}));
									}			

								}


							});
						}
					} catch (err) {
						console.log(err);
					}


					
					break;

					case 'moureJugador':
						// Enviar missatge a tots de la sala
						if (client.sala && salas[client.sala]) {
							salas[client.sala].forEach((clients) => {
								clients.send(JSON.stringify({id: missatge.id, posX: missatge.posX, posY: missatge.posY, accio: "moureJugador"}));
							}
							);
						}
						break;

        
            	default:
                break;
        }

		//Funció per tancar la sala quan l'admin es desconnecta 
		client.on('close', () => {
			if(client.admin) {

				admin = null;
				if(client.sala && salas[client.sala]) {
					salas[client.sala].forEach((clients) => {
						clients.send(JSON.stringify({ accio: "TancarSala"}));
					});
				}

				salas[client.sala] = [];

				

			}else{

				if(client.sala && salas[client.sala]) {

					salas[client.sala] = salas[client.sala].filter((clients) => {
						return clients !== client;
					});


					salas[client.sala].forEach((clients) => {

						clients.send(JSON.stringify({id: client.character.id, idPersonaje:client.character.IdPersonaje,accio: "desconectarJugador"}));
						
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
import { fork } from 'child_process';

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
