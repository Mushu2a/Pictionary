<?php
session_start();

if (isset($_POST) && isset($_POST["login_form"])) {

	// récupérer les éléments du formulaire
	$email = stripslashes($_POST['email']);
	$password = stripslashes($_POST['password']);

	// Si le bouton valider connexion
	try {
			// On selectionne l'utilisateur avec les informations de connexion
			$dbh = new PDO('mysql:host=localhost;dbname=tpWeb', 'test', 'test', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$requete = "SELECT `user`.`id`, `user`.`email`, `user`.`nom`, `user`.`prenom`, `user`.`tel`, `user`.`birthdate`, `user`.`couleur`, `user`.`profilepic` FROM `users` AS user WHERE `user`.`email`= '".$email."' && `user`.`password`= '".$password."'";
			$sql = $dbh->query($requete);
			// si une colonne ou plus, on prend ces données en session et on redirige vers la page suivante
			if ($sql->fetchColumn() >= 1) {
				$sql = $dbh->query($requete);
				$sql->execute();
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

				// ici,  rediriger vers la page main.php
				header("Location: ../main.php");
			} else {
				// ici,  rediriger vers la page main.php
				header("Location: ../connexion.php?erreur");
			}

	}
	catch(Exception $e) {
		trigger_error($e->getMessage(), E_USER_ERROR);
	}

}

?>