<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Inscription - Pictionary</title>

		<link rel="icon" href="image/logo.ico" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body onload="setTimeout(cacherNotification,5000);">
		<?php
			// Détection de l'os et du navigateur
			require_once 'php/user_agent.php';
			$details = getOS()."_".getBrowser();

			// Si présence de l'erreur affichage notification
			if (isset($_GET["erreur"])) {
				?> <span id="notification">ERREUR INSCRIPTION -> <small>email déjà identique dans la base</small> <a href="#" id="close" onclick="cacherNotification(); return false;">X</a></span> <?php
			}

			if (isset($_GET["email"]) || isset($_GET["nom"]) || isset($_GET["prenom"]) || isset($_GET["tel"]) || isset($_GET["date"]) || isset($_GET["age"])) {
				$email = $_GET["email"];
				$nom = $_GET["nom"];
				$prenom = $_GET["prenom"];
				$tel = $_GET["tel"];
				$date = $_GET["date"];
				$age = $_GET["age"];
			}
		?>
		<noscript id="notification2">
			Désolé, une erreur est survenue. Veuillez essayer d'actualiser la page.\n
			JavaScript est désactivé sur votre navigateur.<br>
			Vous ne pourrez pas vous inscrire sans cela, merci d'activer JavaScript dans votre navigateur.<br>
			Cliquez <a href="<?php echo $details ?>.pdf">ici</a> pour savoir comment faire.
		</noscript>

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
		<h1>Inscrivez-vous</h1>
		<h2>Les champs obligatoires sont indiqués par *</h2>
		<form action="php/req_inscription.php" method="POST" name="inscription" id="inscription">
		<!-- c'est quoi les attributs action et method ? method défini la requete envoyé au serveur et l'action redirige vers le fichier ou le traitement du formulaire se fera -->
		<!-- qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ? Les requêtes REST en PHP (GET, POST, PUT, DELETE) -->
			<div id="menugauche">
				<div id="bloc_gauche">
					<li>
						<input type="email" name="email" id="email" pattern="[a-zA-Z0-9À-ŷ.!#$%&’*+/=?^_`{|}~-]+\@[a-zA-Z0-9]{4,}\.[a-zA-Z0-9]{2,4}" placeholder="Email" onkeyup="activeSubmit()" autofocus required/>
						<label for="email">E-mail* ____________________________</label>
						<!-- quelle est la différence entre les attributs name et id ? _id_ est lu par le navigateur, _name_ par PHP lors de la validation du formulaire. -->
						<!-- c'est lequel qui doit être égal à l'attribut for du label ? l'id de l'input -->
					</li>
					<li>
						<input type="text" name="nom" id="nom" placeholder="Nom" value="<?php if (isset($_GET["erreur"])) { echo $nom; } ?>" onkeyup="activeSubmit()" required/>
						<label for="nom">Nom* _______________________________</label>
					</li>
					<li>
						<input type="text" name="prenom" id="prenom" placeholder="Prenom" value="<?php if (isset($_GET["erreur"])) { echo $prenom; } ?>" onkeyup="activeSubmit()" required/>
						<label for="prenom">Prénom* ____________________________</label>
					</li>
					<li>	
						<input type="tel" name="tel" id="tel" pattern="(?:06|07|\(?\+336\)?|\(?\+337\)?)[0-9]{8}" title="Seulement un numéro français" list="dataTel" placeholder="Numéro" value="<?php if (isset($_GET["erreur"])) { echo $tel; } ?>" onkeyup="activeSubmit()" required>
						<datalist id="dataTel">
							<option value="0623456789">0623456789</option>
						</datalist>
						<label for="tel">Tel* _______________________________</label>
					</li>
					<li>
						<input type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" title="Ex: JJ/MM/AAAA" value="<?php if (isset($_GET["erreur"])) { echo $date; } ?>" onchange="compteAge()" onkeyup="activeSubmit()" onfocusout="validateAge()" required/>
						<input type="number" name="age" id="age" placeholder="Age" value="<?php if (isset($_GET["erreur"])) { echo $age; } ?>" readonly/>
						<label for="birthdate">Date de naissance* ________</label>
						<!-- à quoi sert l'attribut disabled ? Empêcher la saisie -->
					</li>
					<li>						
						<input type="password" name="password" id="mdp1" pattern="[a-zA-Z0-9\s]{6}" maxlength="8" title="Le mot de passe doit être de 6 à 8 caractères alphanumériques !" placeholder="6 à 8 caractères" onkeyup="validateMdp2();activeSubmit();" required/>
						<label for="mdp1">Mot de passe* ______________________</label>
						<!-- Pattern alphanumériques avec les espaces compris (\s) -->
						<!-- quels sont les deux scénarios où l'attribut title sera affiché ? Ici que si le mot de passe et plus petit -->
						<!-- encore une fois, quelle est la différence entre name et id pour un input ? -->
					</li>
					<li>						
						<input type="password" id="mdp2" maxlength="8" placeholder="Confirmation" onkeyup="validateMdp2();activeSubmit();" required/>
						<label for="mdp2">Confirmez mot de passe* ____________</label>
						<!-- pourquoi est-ce qu'on a pas mis un attribut name ici ? Car le vérification se fait coté client et non coté serveur, aucun besoin de la traiter en PHP -->
						<!-- quel scénario justifie qu'on ait ajouté l'écouter validateMdp2() à l'évènement onkeyup de l'input mdp1 ? Comme ça lorsque l'utilisateur fini de comfirmer sont mot de passe le message d'erreur s'affiche -->
					<li>
				</div>
				<div id="bloc_gauche">
					<input type="submit" id="validForm" name="validForm" value="Soumettre Formulaire" disabled="disabled"/>
				</div>
			</div>
			<div id="menudroite">
				<div id="bloc_droite">
					<li>
						<input type="text" name="ville" id="ville" placeholder="Ville"/>
						<label for="ville">Ville _______________</label>
					</li>
					<li>
						<input type="url" name="website" id="website" placeholder="Site internet"/>
						<label for="website">Website _____________</label>
					</li>
					<li>
						<input type="range" name="taille" min="0.50" max="2.55" step="0.05" value="1.55" onchange="rangevalue.value=value"/>
						<output id="rangevalue">1.25</output> Mètres
						<label for="taille">Taille ______________</label>
					</li><br><br>
					<li>
						<input type="radio" id="sexe" name="sexe" value="homme" onchange="activeSubmit()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" id="sexe" name="sexe" value="femme" onchange="activeSubmit()">Homme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Femme
						<label for="sexe">Sexe ________________</label>
					</li>
					<li>
						<input type="color" id="couleur" value="#00000" onchange="javascript:document.getElementById('couleur2').value = document.getElementById('couleur').value;"/>
						<label for="couleur">Couleur préférer ____</label>
					</li>
					<li>
						<input type="hidden" id="couleur2" name="couleur" value="#00000"/>
					</li>
					<li>
						<input type="file" id="profil" multiple/><br>
						<label for="profil">Photo de profil _______</label>
						<input type="hidden" name="profil" id="img"/>
						<div id="image"></div>
					</li>
					<!--<li>
						<label for="profilepic">Photo de profil :</label>
						<input type="file" id="profilepic" onchange="loadProfilePic(this)"/>
						<!-- l'input profilepic va contenir le chemin vers l'image sur l'ordinateur du client -->
						<!-- on ne veut pas envoyer cette info avec le formulaire, donc il n'y a pas d'attribut name -->
						<!--<input type="hidden" name="profilepic" id="profilepic"/>
						<!-- l'input profilepic va contenir l'image redimensionnée sous forme d'une data url -->
						<!-- c'est cet input qui sera envoyé avec le formulaire, sous le nom profilepic -->
						<!--<canvas id="preview" width="0" height="0"></canvas>
						<!-- le canvas (nouveauté html5), c'est ici qu'on affichera une visualisation de l'image. -->
						<!-- on pourrait afficher l'image dans un élément img, mais le canvas va nous permettre également
						de la redimensionner, et de l'enregistrer sous forme d'une data url
					</li>-->
				</div>
			</div>
		</form>
		<footer>
			<p>créé par <a href="http://lastennetloic.fr" target="_blank">Lastennet Loïc</a></p>
		</footer>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>