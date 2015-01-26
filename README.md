# Pictionary
Pictionnary Asynchrone est une application similaire à l'application Draw Something [LPSIL][IDSE]  Cette application est développée en cours lors des séances prévues avec M. Khalil Bouzidi

Créer un dossier 'data' ou autre pour enregistrer les images temporaires et lui donnée les droits 'www-data'
Exemple:

~~~ sh
# Changement des permissions en lecture, écriture sur le dossier d'image temporaire
~$ sudo chmod 775 /var/www/Pictionary/data
# Ici tous les droits au propriétaire et au groupe et les autres seulement éxecutable

# Changement de propriétaire et de groupe sur le dossier d'image temporaire
~$ sudo chown www-data:www-data /var/www/Pictionary/data
~~~

Ainsi dans l'arborescence /var/www/Pictionary/vue/php/ le fichier 'img_profil.php' pourra créer une image en fonction de la première lettre du prénom lors d'une inscription sans séléction d'image.

Le dossier TP contient tous les tests réussi lors du TP facebook, création Mashup, application tremblements de Terre

Editer les variable ci-dessous dans le fichier "/vue/php/img_profil.php" pour que la création automatique de l'image puisse fonctionner dans votre environnement.

![Alt text](http://img4.hostingpics.net/pics/221093pictionary.png "Pictionary dossier")
