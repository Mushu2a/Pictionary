<?php
session_start();

require_once 'php/config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil - Pictionary</title>

		<link rel="icon" href="image/logo.ico" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<header>
			<h2 id="logo">
				<img width="100" height="100" src="image/logo.png" alt="Pictionary logo" />
			</h2>
		</header>
		<div>
			<ul id="lien">
				<li><a href="php/profil.php"><b>►</b> Profil</a></li>
				<li><a href="?deconnexion" ><b>◄</b> Déconnexion</a></li>
			</ul>
		</div>
		<?php if (isset($_SESSION["email"]) && isset($_SESSION["password"])) { ?>
			<h1>Bonjour et bienvenue, <?php echo "<br><br>".ucfirst($_SESSION["nom"])." ".ucfirst($_SESSION["prenom"]); ?></h1>
			<img src="<?php echo $_SESSION['profilepic']; ?>" id="connexionLogo">
		<?php } else {
			header("Location: ../index.php");
		} ?>
		<footer>
			<p>créé par <a href="http://lastennetloic.fr" target="_blank">Lastennet Loïc</a></p>
		</footer>
	</body>
</html>