<?php
session_start();

require_once '../php/config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil - Pictionary</title>

		<link rel="icon" href="image/logo.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body onload="setTimeout(cacherNotification,5000);">
		<?php
			if (isset($_GET["erreur"])) {
				?> <span id="notification">ERREUR MODIFICATION -> <small>La modification à échourer, un champ n'est pas bon</small> <a href="#" id="close" onclick="cacherNotification(); return false;">X</a></span> <?php
			}
		?>
		<header>
			<h2 id="logo">
				<img width="100" height="100" src="../image/logo.png" alt="Pictionary logo" />
			</h2>
		</header>
		<div>
			<ul id="lien">
				<li><a href="../main.php"><b>►</b> Accueil</a></li>
				<li><a href="profil.php"><b>►</b> Profil</a></li>
				<li><a href="../../?deconnexion" ><b>◄</b> Déconnexion</a></li>
			</ul>
		</div>
		<?php if (isset($_SESSION["email"]) && isset($_SESSION["password"])) { ?>
			<h1>Modification du profil</h1>
			<form action="req_profil.php" method="POST" name="inscription" id="inscription">
				<div id="menugauche">
					<div id="bloc_gauche">
						<input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
						<li>
							<input type="email" name="email" id="email" pattern="[a-zA-Z0-9À-ŷ.!#$%&’*+/=?^_`{|}~-]+\@[a-zA-Z0-9]{4,}\.[a-zA-Z0-9]{2,4}" placeholder="Email" value="<?php echo $_SESSION["email"]; ?>" autofocus/>
							<label for="email">E-mail</label>
						</li>
						<li>
							<input type="text" name="nom" id="nom" placeholder="Nom" value="<?php echo $_SESSION["nom"]; ?>"/>
							<label for="nom">Nom</label>
						</li>
						<li>
							<input type="text" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo $_SESSION["prenom"]; ?>"/>
							<label for="prenom">Prénom</label>
						</li>
						<li>	
							<input type="tel" name="tel" id="tel" pattern="(?:06|07|\(?\+336\)?|\(?\+337\)?)[0-9]{8}" title="Seulement un numéro français" list="dataTel" placeholder="Numéro" value="<?php echo $_SESSION["tel"]; ?>"/>
							<datalist id="dataTel">
								<option value="0623456789">0623456789</option>
							</datalist>
							<label for="tel">Tel</label>
						</li>
					</div>
					<div id="bloc_gauche">
						<input type="submit" id="modifForm" name="modifForm" value="Modifier valeur"/>
					</div>
				</div>
				<div id="menudroite">
					<div id="bloc_droite">
						<li>
							<input type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" title="Ex: JJ/MM/AAAA" onchange="compteAge()" onfocusout="validateAge()"/>
							<input type="number" name="age" id="age" placeholder="Age" title="La date de naissance doit être renseigner" required/>
							<label for="birthdate">Date de naissance</label>
						</li>
						<li>						
							<input type="password" name="mdp1" id="mdp1" pattern="[a-zA-Z0-9\s]{6}" maxlength="8" title="Le mot de passe doit être de 6 à 8 caractères alphanumériques !" placeholder="6 à 8 caractères" value="<?php echo $_SESSION["password"]; ?>" onkeyup="validateMdp2()" required/>
							<label for="mdp1">Mot de passe</label>
						</li>
						<li>						
							<input type="password" id="mdp2" maxlength="8" placeholder="Confirmation" value="<?php echo $_SESSION["password"]; ?>" onkeyup="validateMdp2()" required/>
							<label for="mdp2">Confirmez mot de passe</label>
						<li>
						<li>
							<input type="file" id="profil" multiple/><br>
							<label for="profil">Photo de profil</label>
							<input type="hidden" name="profil" id="img" value="<?php echo $_SESSION["profilepic"]; ?>"/>
							<div id="image"></div>
						</li>
					</div>
				</div>
			</form>
		<?php } else {
			header("Location: ../index.php");
		} ?>
		<footer>
			<p>créé par <a href="http://lastennetloic.fr" target="_blank">Lastennet Loïc</a></p>
		</footer>
		<script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>