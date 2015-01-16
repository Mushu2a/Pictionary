<?php

if (isset($_POST) && isset($_POST["validForm"])) {

	require_once 'img_profil.php';

	// récupérer les éléments du formulaire
	$email = stripslashes($_POST['email']);
	$password = stripslashes($_POST['password']);
	$nom = stripslashes($_POST['nom']);
	$prenom = stripslashes($_POST['prenom']);
	$tel = stripslashes($_POST['tel']);
	$birthdate = stripslashes($_POST['birthdate']);
	$age = $_POST['age'];

	if (array_key_exists('sexe',$_POST)) {
		$sexe = ucfirst(stripslashes($_POST['sexe']));
	}

	$website = stripslashes($_POST['website']);
	$ville = stripslashes($_POST['ville']);
	$taille = str_replace('.', '', stripslashes($_POST['taille']));
	$couleur = substr(stripslashes($_POST['couleur']), 1);
	$profil = stripslashes($_POST['profil']);
	//$profilepic = stripslashes($_POST['profilepic']);

	if (empty($profil)) {
		// Si l'utilisateur n'a pas choisie d'image, on lui en créer une par défaut
		$profil = creerImage($prenom);
	}

	try {
		// Connect to server and select database.
		$dbh = new PDO('mysql:host=localhost;dbname=tpWeb', 'test', 'test', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

		// Si l'email est déjà existant
		$sql = $dbh->query("SELECT * FROM `users` WHERE `email` = '".$email."'");
		if ($sql->fetchColumn() >= 1) {
			header("Location: ../inscription.php?erreur&email=".$email."&nom=".$nom."&prenom=".$prenom."&tel=".$tel."&date=".$birthdate."&age=".$age."");
			// rediriger l'utilisateur ici, avec tous les paramètres du formulaire plus le message d'erreur
			// utiliser à bon escient la méthode htmlspecialchars http://www.php.net/manual/fr/function.htmlspecialchars.php
			// et/ou la méthode urlencode http://php.net/manual/fr/function.urlencode.php
		}
		else {
			// Tenter d'inscrire l'utilisateur dans la base
			$sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "
			. "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profil)");
			$sql->bindValue("email", $email);
			$sql->bindValue("password", $password);
			$sql->bindValue("nom", $nom);
			$sql->bindValue("prenom", $prenom);
			$sql->bindValue("tel", $tel);
			$sql->bindValue("website", $website);
			$sql->bindValue("sexe", $sexe);
			$sql->bindValue("birthdate", $birthdate);
			$sql->bindValue("ville", $ville);
			$sql->bindValue("taille", $taille);
			$sql->bindValue("couleur", $couleur);
			$sql->bindValue("profil", $profil);
			// de même, lier la valeur pour le mot de passe
			// lier la valeur pour le nom, attention le nom peut être nul, il faut alors lier avec NULL, ou DEFAULT
			// idem pour le prenom, tel, website, birthdate, ville, taille, profilepic
			// n.b., notez: birthdate est au bon format ici, ce serait pas le cas pour un SGBD Oracle par exemple
			// idem pour la couleur, attention au format ici (7 caractères, 6 caractères attendus seulement)
			// idem pour le prenom, tel, website
			// idem pour le sexe, attention il faut être sûr que c'est bien 'H', 'F', ou ''

			// on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
			if (!$sql->execute()) {
				echo "PDO::errorInfo():<br/>";
				$err = $sql->errorInfo();
				print_r($err);
			} else {

				$requete = "SELECT `user`.`id`, `user`.`email`, `user`.`nom`, `user`.`prenom`, `user`.`tel`, `user`.`birthdate`, `user`.`couleur`, `user`.`profilepic` FROM `users` AS user WHERE `user`.`email`= '".$email."'";
				$sql = $dbh->query($requete);
				if ($sql->fetchColumn() < 1) {
					header("Location: ../inscription.php?erreur=".urlencode("un problème est survenu"));
				}
				else {

					// ici démarrer une session
					session_start();

					try {

						$sql = $dbh->query($requete);
						// on récupère la ligne qui nous intéresse avec $sql->fetch(),
						while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
							$_SESSION["id"] = $data["id"];
							$_SESSION["email"] = $data["email"];
							$_SESSION["password"] = $password;
							$_SESSION["nom"] = $data["nom"];
							$_SESSION["prenom"] = $data["prenom"];
							$_SESSION["tel"] = $data["tel"];
							$_SESSION["birthdate"] = $data["birthdate"];
							$_SESSION["couleur"] = "#".$data["couleur"];
							$_SESSION["profilepic"] = $data["profilepic"];
						}

					}
					catch(Exception $e) {
						trigger_error($e->getMessage(), E_USER_ERROR);
					}
				}

				// ici,  rediriger vers la page main.php
				header("Location: ../main.php");
			}
			$dbh = null;
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		$dbh = null;
		die();
	}
} else {
	header("Location: ../index.php?erreur");
}

?>