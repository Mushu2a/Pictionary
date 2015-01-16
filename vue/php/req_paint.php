<?php
session_start();

if (isset($_POST) && isset($_POST["paintingForm"])) {
	// Extrait toutes les variables transmis dans le formulaire
	// et lui attribue les même nom de formulaire pour les variables PHP
	extract($_POST);

	// Si submit actionner
	try {
		// On modifie l'utilisateur avec les informations renseigner
		$dbh = new PDO('mysql:host=localhost;dbname=tpWeb', 'test', 'test', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$requete = "INSERT INTO `drawings` (`id`, `idUser`, `command`, `dessin`) VALUES ('', :idUser, :command, :dessin)";
		$sql = $dbh->prepare($requete);
		$sql->bindParam(':idUser', $id);
		$sql->bindParam(':command', $drawingCommands);
		$sql->bindParam(':dessin', $picture);

		if (!$sql->execute()) {
			/*echo "PDO::errorInfo():<br/>";
			$err = $sql->errorInfo();
			print_r($err);*/
			header("Location: ../main.php?erreur");
		} else {

			$_SESSION["idUser"] = $id;
			$_SESSION["command"] = $drawingCommands;
			$_SESSION["picture"] = $picture;

			header("Location: ../guess.php");
			// ici,  rediriger vers la page main.php avec succès
		}

	}
	catch(Exception $e) {
		trigger_error($e->getMessage(), E_USER_ERROR);
	}

}

?>