<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Connexion - Pictionary</title>

		<link rel="icon" href="image/logo.ico"/>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php
			// Si présence de l'erreur affichage notification
			if (isset($_GET["erreur"])) {
				?> <span id="notification">ERREUR CONNEXION -> <small>email/mot de passe incorrect</small></span> <?php
			}

			if (isset($_GET["modifier"])) {
				?> <span id="notification3">MODIFICATION REUSSI -> <small>Votre profil à changer, reconnecter vous</small></span> <?php
			}
		?>
		<header>
			<h2 id="logo">
				<img width="100" height="100" src="image/logo.png" alt="Pictionary logo" />
			</h2>
		</header>
		<div>
			<ul id="lien">
				<li><a href="./connexion.php"><b>►</b> Connexion</a></li>
				<li><a href="./inscription.php" ><b>✉</b> Inscription</a></li>
				<li><a href="../index.php" ><b>◄</b> Retour</a></li>
			</ul>
		</div>
		<h1>Connectez-vous</h1>
		<form action="php/req_login.php" method="POST" name="login" id="login">
			<div id="menucentrer">
				<div id="bloc_centrer">
					<li>
						<input type="email" name="email" id="email" pattern="[a-zA-Z0-9À-ŷ.!#$%&’*+/=?^_`{|}~-]+\@[a-zA-Z0-9]{4,}\.[a-zA-Z0-9]{2,4}" placeholder="Email" autofocus required/>
						<label for="email">Identifiant</label>
					</li>
					<li>
						<input type="password" name="password" id="mdp1" pattern="[a-zA-Z0-9\s]{6,8}" maxlength="8" title="Le mot de passe doit être de 6 à 8 caractères alphanumériques !" placeholder="6 à 8 caractères" required/>
						<label for="mdp1">Mot de passe</label>
					</li>
				</div>
				<div id="bloc_centrer">
					<input type="submit" id="login_form" name="login_form" value="Valider"/>
				</div>
			</div>
		</form>
		<footer>
			<p>créé par <a href="http://lastennetloic.fr" target="_blank">Lastennet Loïc</a></p>
		</footer>
	</body>
</html>