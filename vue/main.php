<?php
session_start();

echo $_SESSION["email"]."<br>";
echo $_SESSION["nom"]."<br>";
echo $_SESSION["prenom"]."<br>";
echo $_SESSION["couleur"]."<br>";
echo "<img src'".$_SESSION["profilepic"]."'><br>";

?>