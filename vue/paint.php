<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Paint - Pictionnary</title>

	<link rel="icon" href="image/logo.ico"/>
	<link rel="stylesheet" media="screen" href="css/style.css"/>
	<script>
		// les quatre tailles de pinceau possible.
		var sizes=[8,20,44,90];
		// la taille et la couleur du pinceau
		var size, color;
		// la dernière position du stylo
		var x0, y0;
		// le tableau de commandes de dessin à envoyer au serveur lors de la validation du dessin
		var drawingCommands = [];

		var setColor = function() {
			// on récupère la valeur du champs couleur
			color = document.getElementById('couleur').value;
			console.log("couleur:" + color);
		}

		var setSize = function() {
			// ici, récupèrez la taille dans le tableau de tailles, en fonction de la valeur choisie dans le champs taille.
			size = document.getElementById('size').value;
			console.log("size:" + size);
		}

		window.onload = function() {
			var canvas = document.getElementById('paint');
			canvas.width = 400;
			canvas.height= 400;
			var context = canvas.getContext('2d');

			setSize();
			setColor();
			document.getElementById('size').onchange = setSize;
			document.getElementById('couleur').onchange = setColor;

			var isDrawing = false;

			var startDrawing = function(e) {
				console.log("start");
				// crér un nouvel objet qui représente une commande de type "start", avec la position, la couleur
				var command = {};
				command.command="start";
				command.x=e.x;

				//c'est équivalent à:
				//command = {"command":"start", "x": e.x, .};

				// Ce genre d'objet Javascript simple est nommé JSON. Pour apprendre ce qu'est le JSON, c.f. http://blog.xebia.fr/2008/05/29/introduction-a-json/  

				// on l'ajoute à la liste des commandes
				drawingCommands.push(command);

				// ici, dessinez un cercle de la bonne couleur, de la bonne taille, et au bon endroit.
		
				// Coordonnées de la souris :
				cursorX = (e.x0 - this.offsetLeft);
				cursorY = (e.y0 - this.offsetTop);

				isDrawing = true;
			}

			var stopDrawing = function(e) {
				console.log("stop");
				isDrawing = false;
			}

			var draw = function(e) {
				if(isDrawing) {
					// Set Coordonnées de la souris :
					cursorX = (e.x0 - this.offsetLeft) - 10; // 10 = décalage du curseur
					cursorY = (e.y0 - this.offsetTop) - 10;
					
					// Dessine une ligne :
					drawLine();
					// ici, créer un nouvel objet qui représente une commande de type "draw", avec la position, et l'ajouter à la liste des commandes.
					// ici, dessinez un cercle de la bonne couleur, de la bonne taille, et au bon endroit. 
				}
			}

			// Fonction qui dessine une ligne
			var drawLine = function(e) {
				// Si c'est le début, j'initialise
				if (!isDrawing) {
					// Je place mon curseur pour la première fois
					context.beginPath();
					context.moveTo(x0, y0);
					started = true;
				} 
				// Sinon je dessine
				else {
					context.lineTo(x0, y0);
					context.strokeStyle = color;
					context.lineWidth = size;
					context.stroke();
				}
			}

			canvas.onmousedown = startDrawing;
			canvas.onmouseout = stopDrawing;
			canvas.onmouseup = stopDrawing;
			canvas.onmousemove = draw;

			document.getElementById('restart').onclick = function() {
				console.log("clear");
				context.clearRect(0,0, canvas.width(), canvas.height());
				// ici ajouter à la liste des commandes une nouvelle commande de type "clear"
				// ici, effacer le context, grace à la méthode clearRect.
			};

			document.getElementById('validate').onclick = function() {
				// la prochaine ligne transforme la liste de commandes en une chaîne de caractères, et l'ajoute en valeur au champs "drawingCommands" pour l'envoyer au serveur.
				document.getElementById('drawingCommands').value = JSON.stringify(drawingCommands);
				// ici, exportez le contenu du canvas dans un data url, et ajoutez le en valeur au champs "picture" pour l'envoyer au serveur.
			};

			document.getElementById('enregistrer').onclick = function() {
				var canvas_tmp = document.getElementById("paint");
				window.location = canvas_tmp.toDataURL("image/png");
			};
		};
	</script>
</head>
<body>

<canvas id="paint"></canvas>
  
<form name="tools">
	<input type="range" id="size" name="size" min="0" max="4" step="1" value="2" onchange="rangevalue.value=value"/>
	<output id="rangevalue">2</output>

	<input type="color" id="couleur" value="<?php echo $_SESSION['couleur']; ?>" onchange="javascript:document.getElementById('couleur2').value = document.getElementById('couleur').value;"/>
	<input type="hidden" id="couleur2" name="couleur" value="<?php echo $_SESSION['couleur']; ?>"/><br>

	<input type="button" id="restart" value="Recommencer"/>
	<input type="hidden" id="drawingCommands" name="drawingCommands"/>
	<!-- à quoi servent ces champs hidden ? -->
	<input type="hidden" id="picture" name="picture"/>
	<input type="submit" id="validate" value="Valider"/>
	<input type="submit" id="enregistrer" value="Enregistrer"/>
</form>  
  
</body>
</html>