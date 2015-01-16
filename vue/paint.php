<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId: '735030746591821',
			status: true,
			cookie: true,
			xfbml: true
		});
	};

	// Démarre le SDK asynchrone
	(function(d){
		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "//connect.facebook.net/fr_FR/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));

	var image = document.getElementById(picture);

	// Post un message sur le mur
	function ui() {
		FB.ui( {
				method: "feed",
				name: "Pictionnary",
				caption: "Je partage mon image avec vous, essayé de deviner ce que c'est",
				description: (
					"Le but du jeu c'est de deviner le dessin créer et partager."
				),
				link: "http://134.59.143.147/WEB/PictionaryV3/",
				picture: image
			}, function(response) {
				if (response && response.post_id) {
					alert('Publier !');
				} else {
					alert('Non publier !');
				}
		});
	}

	var status = FB.getLoginStatus();

	console.log(status);
</script>
<canvas id="canvas" width="800" height="500"></canvas>
<button id="deconnexion" onclick="ui()">UI</button>

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