<?php

if (isset($_POST) && isset($_POST["modifForm"])) {
	extract($_POST);

	try {
		// Connect to server and select database.
		$dbh = new PDO('mysql:host=localhost;dbname=tpWeb', 'test', 'test', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

		// Si l'email est déjà existant
		$sql = $dbh->query("SELECT * FROM `users` WHERE `email` = '".$email."'");
		if ($sql->fetchColumn() >= 1) {
			header("Location: ../inscription.php?erreur&email=".$email."&nom=".$nom."&prenom=".$prenom."&tel=".$tel."&date=".$birthdate."&age=".$age."");
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		$dbh = null;
		die();
	}
}

?>