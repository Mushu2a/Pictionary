<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<div id="fb-root"></div>
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

	function login() {
		FB.login(function(response) {

		console.log(response);

		}, {scope: 'read_stream,publish_stream,publish_actions,read_friendlists'});            
	}

	// Déconnecte l'utilisateur
	function logout() {
		FB.logout(function(response) {
			console.log("Utilisateur deconnecter");
		});
	}

	// Post un message sur le mur
	function ui() {
		FB.ui( {
				method: 'feed',
				name: 'Pictionnary',
				caption: 'Je partage mon image que vous devez deviner',
				description: (
					"Le but du jeu c'est de deviner le dessin créer et partager."
				),
				link: 'http://134.59.143.147/WEB/PictionaryV2/',
				picture: 'https://lastennetloic.fr/images/logo.png'
			}, function(response) {
				if (response && response.post_id) {
					alert('Post publier !');
				} else {
					alert('Post non publier !');
				}
		});
	}

	// Envois un message sur facebook
	function envoisMessage() {
		var msg = document.getElementById('msg').value;
		FB.api('/me/feed', 'post', {message: msg});
		alert('Le message à été poster');
	}

	var status = FB.getLoginStatus();

	console.log(status);
</script>
<div id="connecter" class="fb-login-button" data-max-rows="1" data-show-faces="true"></div><br>
<button id="deconnexion" onclick="logout()">Deconnexion</button>
<button id="deconnexion" onclick="ui()">UI</button>
<input type="text" id="msg">
<input type="submit" id="deconnexion" onclick="envoisMessage()" value="Envois">
</body>
</html>