<?php


/*
* Permet la création d'une image avec la première lettre du prénom
* Utiliser lorsque l'utilisateur n'indique pas de photo
*/
function creerImage($letexte) {

	// Majuscule du texte
	$lettre = strtoupper($letexte[0]);
	// Date Année,Mois,Jour,Heure,Minute,Seconde
	$date = date("YmdHis");

	// Défini la taille de l'image et la créer
	$img = @imagecreate(90, 90)
		or die("Impossible d'initialiser la bibliothèque GD");

	// Assigne aléatoirement une couleur à l'image
	$c1 = mt_rand(50,200); // rouge
	$c2 = mt_rand(50,200); // vert
	$c3 = mt_rand(50,200); // bleu

	// Test si on regénere ou pas une nouvelle palette de couleur
	if(imagecolorstotal($img) >= 255) {
		// Palette utilisée et on attribue c'est couleur au background de l'image
		$color = imagecolorclosest($img, $c1, $c2, $c3);
	} else {
		// Pas utilisée, attribue d'autre couleur
		$color = imagecolorallocate($img, $c1, $c2, $c3);
	}

	// Taille du rectangle avec ça couleur
	imagefilledrectangle($img, 0, 0, 89, 89, $color);
	// Couleur du texte sur l'image
	$texte = imagecolorallocate($img, 255, 255, 255);

	// Chemin vers notre fichier de police ttf
	$font = "/var/www/Pictionary/vue/font/DejaVuSans.ttf";
	$fichier = "/var/www/Pictionary/data/".$date."_".$lettre.".png";

	$largeur = imagesx($img);
	$hauteur = imagesy($img);
	$angle = 0;

	// Permet de pouvoir centrer le texte au centre de l'image
	// Par rapport coordonnée sommet du rectangle
	$coord = imagettfbbox(50, $angle, $font, $lettre);
	$c = $coord[4] - $coord[6];
	$d = $coord[3] - $coord[5];
	$y = ($hauteur - $d)/2;
	$x = ($largeur - $c)/2;

	// Ajoute le texte sur l'image
	imagefttext($img, 50, $angle, $x, $y+$d, $texte, $font, $lettre);
	// Créer l'image de la plus haute qualité
	imagepng($img, $fichier, 9);

	// Récupère l'extension de l'image
	$type = pathinfo($fichier, PATHINFO_EXTENSION);
	// Récupère le fichier stocker
	$data = file_get_contents($fichier);
	// Convertie l'image type en base64
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

	// détruit l'image pour libérer de l'espace mémoire
	imagedestroy($img);
	supprimerImage();

	return $base64;
}

function supprimerImage() {

	$dossier = "/var/www/Pictionary/data";
	$repertoire = opendir($dossier);

	// Lecture de chaque fichier du répertoire
	while (false !== ($fichier = readdir($repertoire))) {
		// On définit le chemin du fichier à effacer.
		$chemin = $dossier."/".$fichier;

		// Si le fichier n'est pas un répertoire
		if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier)) {
			unlink($chemin); // On efface.
		}
	}
	// Fermeture dossier
	closedir($repertoire);
}

?>
