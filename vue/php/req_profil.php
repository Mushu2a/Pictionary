<?php
session_start();

if (isset($_POST) && isset($_POST["modifForm"])) {
	// Extrait toutes les variables transmis dans le formulaire
	// et lui attribue les même nom de formulaire pour les variables PHP
	extract($_POST);

	// Si submit actionner
	try {
		// On modifie l'utilisateur avec les informations renseigner
		$dbh = new PDO('mysql:host=localhost;dbname=tpWeb', 'test', 'test', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$requete = "UPDATE `users` 
					SET `email` = :email,
						`nom` = :nom,
						`prenom` = :prenom,
						`password` = :password,
						`tel` = :tel,
						`birthdate` = :birthdate,
						`profilepic` = :profil
					WHERE `id` = :id";
		$sql = $dbh->prepare($requete);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':nom', $nom);
		$sql->bindParam(':prenom', $prenom);
		$sql->bindParam(':password', $mdp1);
		$sql->bindParam(':tel', $tel);
		$sql->bindParam(':birthdate', $birthdate);
		$sql->bindParam(':profil', $profil);
		$sql->bindParam(':id', $id);

		if (!$sql->execute()) {
			/*echo "PDO::errorInfo():<br/>";
			$err = $sql->errorInfo();
			print_r($err);*/
			header("Location: profil.php?erreur");
		} else {

			// On selectionne l'utilisateur avec les informations de connexion
			$requete = "SELECT `user`.`id`, `user`.`email`, `user`.`nom`, `user`.`prenom`, `user`.`tel`, `user`.`birthdate`, `user`.`couleur`, `user`.`profilepic` FROM `users` AS user WHERE `user`.`email`= '".$email."' && `user`.`password`= '".$mdp1."'";
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
					$_SESSION["profilepic"] = $data["profilepic"];
				}

				// ici,  rediriger vers la page main.php avec succès
				header("Location: ../connexion.php?modifier");
			}
		}

	}
	catch(Exception $e) {
		trigger_error($e->getMessage(), E_USER_ERROR);
	}
}

?>