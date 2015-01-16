<canvas id="canvas" width="800" height="500"></canvas>

<form action="php/req_paint.php" method="POST" name="tools">
	<input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
	<label for="size">Largeur du pinceau :</label>
	<input type="range" id="size" min="8" max="90" step="16" value="40" onchange="rangevalue.value=value"/>
	<output id="rangevalue">40</output> pixels

	<input type="color" id="couleur" value="<?php echo $_SESSION['couleur']; ?>" onchange="javascript:document.getElementById('couleur2').value = document.getElementById('couleur').value;"/>
	<input type="hidden" id="couleur2" value="<?php echo $_SESSION['couleur']; ?>"/><br>
	<input type="hidden" id="drawingCommands" name="drawingCommands"/>
	<input type="hidden" id="picture" name="picture"/>
	<!-- à quoi servent ces champs hidden ?
	Permet de cacher les inputs et de pouvoir transmettre des données cacher 
	en leur passant des paramètres que l'on ne veux pas forcement afficher à l'utilisateur -->
	<input type="button" id="restart" value="Recommencer"/>
	<input type="button" id="enregistrer" value="Enregistrer"/>
	<input type="submit" id="validate" name="paintingForm" value="Valider"/>

	<!--<input type="button" id="undo" value="Undo">
	<input type="button" id="redo" value="Redo">-->
</form>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/paint.js"></script>