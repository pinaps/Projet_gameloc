<?php
session_start();

//suppression de la variable de session 
unset($_SESSION['user']);

//création du message de déconnexion
$_SESSION['message'] = "Vous avez été déconnecté du site !";

// redirection vers la page de connexion 
header("Location: connexion.php");
die();



?>