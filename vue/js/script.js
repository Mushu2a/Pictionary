// Confirmation du mot de passe
validateMdp2 = function(e) {
	var mdp1 = document.getElementById('mdp1');
	var mdp2 = document.getElementById('mdp2');
	if(mdp1.value == mdp2.value) {
		// ici on supprime le message d'erreur personnalisé, et du coup mdp2 devient valide.
		document.getElementById('mdp2').setCustomValidity("");
	} else {
		// ici on ajoute un message d'erreur personnalisé, et du coup mdp2 devient invalide.
		document.getElementById('mdp2').setCustomValidity("Les mots de passes doivent être égaux.");
	}
}

// Compte l'age de naissance par rapport à sa date de naissance
compteAge = function(e) {
	try{
		// Date choisie par l'utilisateur
		var date = Date.parse(document.getElementById("birthdate").valueAsDate);
		var birthDate = new Date(date);
		var dateNow = new Date(Date.now());
		// Convertie la saisie
		var date = document.getElementById("birthdate").value;
		var datebis = Date.parse(date);

		// Initialise date saisie et la date d'aujourdhui
		var birthDate = new Date(datebis);
		var dateNow = new Date(Date.now());

		if (birthDate.getTime()>dateNow.getTime()) {
			console.log("La date de naissance doit être supérieure à la date du jour !");
		} else {

			var jour = date.substr(0, 2);
			var moisbis = date.substr(3,3);
			var mois = moisbis.replace("/","");
			var annee = date.substr(6, 10);
			var age = dateNow.getFullYear() - annee;
			var age = dateNow.getFullYear() - birthDate.getFullYear();

			// Si la date d'anniversaire n'est pas encore passée, on corrige l'age
			if(dateNow.getMonth()<birthDate.getMonth() || dateNow.getMonth()==birthDate.getMonth() && dateNow.getDate()<birthDate.getDate()){
				age--;
			}

			document.getElementById('age').value = age;
		}
	} catch(e) {
		console.log("Erreur !");
	}
}

// Validation de l'age minimum requis pour s'inscrire
validateAge = function(e) {
	var age = document.getElementById('age').value;
	var accepter = (age >= 14);

	if (!accepter) {
		document.getElementById('birthdate').value = "";
		document.getElementById('age').value = "";
		alert("Vous devez avoir 14 ans minimum pour vous inscrire !");
		console.log("Vous devez avoir 14 ans minimum pour vous inscrire !");
	};
}

function uploadImage(e) {
	var files = e.target.files; // Liste d'Objets File

	// Pour toutes les images dans l'input file
	for (var i = 0, file; file = files[i]; i++) {

		// Restreint le format d'image
		if (!file.type.match('image.*')) {
		continue;
	}

	var image = document.getElementById("positionImage");
	if (image) {
		image.remove();
	}

	var reader = new FileReader();

	// Récupérer les informations du fichier
	reader.onload = (function(theFile) {
		return function(e) {
			// Rendu de l'image
			var div = document.createElement('div');
			div.innerHTML = ['<img id="positionImage" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
			document.getElementById('image').insertBefore(div, null);
			document.getElementById('img').value = e.target.result;
		};
	})(file);

	// Lis le fichier image
	reader.readAsDataURL(file);
	}
}
// Evenement pour pouvoir afficher l'image
document.getElementById('profil').addEventListener('change', uploadImage, false);

loadProfilePic = function (e) {
	// on récupère le canvas où on affichera l'image
	var canvas = document.getElementById("preview");
	var ctx = canvas.getContext("2d");
	// on réinitialise le canvas: on l'efface, et déclare sa largeur et hauteur à 0
	ctx.setFillColor("white");
	ctx.fillRect(0,0,canvas.width,canvas.height);
	canvas.width=0;
	canvas.height=0;
	// on récupérer le fichier: le premier (et seul dans ce cas là) de la liste
	var file = document.getElementById("profilepicfile").files[0];
	// l'élément img va servir à stocker l'image temporairement
	var img = document.createElement("img");
	// l'objet de type FileReader nous permet de lire les données du fichier.
	var reader = new FileReader();
	// on prépare la fonction callback qui sera appelée lorsque l'image sera chargée  
	reader.onload = function(e) {
		//on vérifie qu'on a bien téléchargé une image, grâce au mime type
		if (!file.type.match(/image.*/)) {
			// le fichier choisi n'est pas une image: le champs profilepicfile est invalide, et on supprime sa valeur
			document.getElementById("profilepicfile").setCustomValidity("Il faut télécharger une image.");
			document.getElementById("profilepicfile").value = "";
		}
		else {
			// le callback sera appelé par la méthode getAsDataURL, donc le paramètre de callback e est une url qui contient 
			// les données de l'image. On modifie donc la source de l'image pour qu'elle soit égale à cette url
			// on aurait fait différemment si on appelait une autre méthode que getAsDataURL.
			img.src = e.target.result;
			// le champs profilepicfile est valide
			document.getElementById("profilepicfile").setCustomValidity("");
			var MAX_WIDTH = 96;
			var MAX_HEIGHT = 96;
			var width = img.width;
			var height = img.height;

			if(width >= MAX_WIDTH && width > MAX_WIDTH ) {
				// Reduction par la largeur
				var reduction = ((MAX_WIDTH*100) / width );
				var NEW_HEIGHT = ((height*reduction) / 100 );
			}
			else {
				// Reduction par la heuteur
				var reduction = ((MAX_HEIGHT*100) / height );
				var NEW_WIDTH = ((width*reduction) / 100 );
			}

			canvas.width = width;
			canvas.height = height;
			// on dessine l'image dans le canvas à la position 0,0 (en haut à gauche)
			// et avec une largeur de width et une hauteur de height
			ctx.drawImage(img, 0, 0, width, height);
			// on exporte le contenu du canvas (l'image redimensionnée) sous la forme d'une data url
			var dataurl = canvas.toDataURL("image/png");
			// on donne finalement cette dataurl comme valeur au champs profilepic
			document.getElementById("profilepic").value = dataurl;
		};
	}
	// on charge l'image pour de vrai, lorsque ce sera terminé le callback loadProfilePic sera appelé.  
	reader.readAsDataURL(file);
}

// Cache la barre de notification lorsque qu'un erreur d'inscription à lieu
cacherNotification = function (e) {
	document.getElementById("notification").style.display = 'none';
}

// Désactive le bouton submit tant que les input requis sont vide
activeSubmit = function (e) {
	// Pour tous les éléments dans la balise <form></form>
	var f = document.forms["inscription"].elements;
	// J'initialise à true le faite que le bouton est désactiver
	var cansubmit = true;

	// Pour i de 0 à nombre(d'éléments)-10
	// Ici 19 éléments
	for (var i = 0; i < f.length-10; i++) {
		// Si les 9 premiers éléments sont différent de 0 on met active l'input
		if (f[i].value.length == 0 ) cansubmit = false;
	}
	console.log(f[i].value.length);
	console.log(cansubmit);

	// Si true input désactiver
	if (cansubmit == true) {
		document.getElementById('validForm').disabled = !cansubmit;
	} else {
		document.getElementById('validForm').disabled = !cansubmit;
	}
}