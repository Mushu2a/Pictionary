$(document).ready(function() {

	// Variables :
	var isDrawing = false;
	var started = false;
	var size = [8,20,44,90];
	var color;
	var canvas = $("#canvas");
	var cursorX, cursorY;
	var drawingCommands = [];
	var drawingCommandsId = document.getElementById('drawingCommands').value;
	var context = canvas[0].getContext('2d');
	
	// Trait arrondi
	context.lineJoin = 'round';
	context.lineCap = 'round';

	
	// Click souris enfoncé dans la canvas, je dessine
	canvas.mousedown(function(e) {
		isDrawing = true;
		
		// Coordonnées de la souris :
		cursorX = (e.pageX - this.offsetLeft);
		cursorY = (e.pageY - this.offsetTop);

		drawingCommands.push(cursorX, cursorY);
	});
	
	// Click souris relaché, stop du dessin
	canvas.mouseup(function() {
		isDrawing = false;
		started = false;
	});
	
	// Mouvement de la souris dans le canvas
	canvas.mousemove(function(e) {
		// Si je suis en train de dessiner (click souris enfoncé)
		if (isDrawing) {
			// Set Coordonnées de la souris
			cursorX = (e.pageX - this.offsetLeft) - 150;
			cursorY = (e.pageY - this.offsetTop) - 135;
			
			// Dessine une ligne
			drawLine();
		}
	});
	
	// Fonction qui dessine une ligne
	function drawLine() {
		// Si c'est le début, j'initialise
		if (!started) {
			// Je place mon curseur pour la première fois
			context.beginPath();
			context.moveTo(cursorX, cursorY);
			started = true;
		} 
		// Sinon je dessine
		else {
			context.lineTo(cursorX, cursorY);
			context.strokeStyle = document.getElementById('couleur').value;
			context.lineWidth = document.getElementById('size').value;
			context.stroke();
		}
	}

	document.getElementById('validate').onclick = function() {
		// la prochaine ligne transforme la liste de commandes en une chaîne de caractères, et l'ajoute en valeur au champs "drawingCommands" pour l'envoyer au serveur.
		document.getElementById('drawingCommands').value = drawingCommands;
		// ici, exportez le contenu du canvas dans un data url, et ajoutez le en valeur au champs "picture" pour l'envoyer au serveur.
		var canvasData = document.getElementById("canvas");
		document.getElementById('picture').value = canvasData.toDataURL("image/png");
	};

	document.getElementById('restart').onclick = function() {
		context.clearRect(0,0, canvas.width(), canvas.height());
		document.getElementById('size').value = "56";
		drawingCommandsId == [];
	};

	document.getElementById('enregistrer').onclick = function() {
		var canvasData = document.getElementById("canvas");
		window.open(canvasData.toDataURL("image/png"));
	};
	
});