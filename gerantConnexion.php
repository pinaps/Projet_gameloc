<?php
session_start();

require(__DIR__.'/config/db.php');

if(isset($_POST['send'])) {
// Affecte une variable à chaque valeur clé de $_POST
	$email = trim(htmlentities($_POST['email']));
	$password = trim(htmlentities($_POST['password']));

// Initialisation d'un tableau d'erreur 
	$errors= [];
// Récuperation de l'utilisateur vie l'email dans la bdd
	$query = $pdo->prepare('SELECT * FROM users WHERE email = :email');
	$query->bindValue(':email',$email,PDO::PARAM_STR);
	$query->execute();
	$resultUser = $query->fetch();		

//Si l'utilisateur à été trouvé
	if($resultUser) {
	// Compare mot de passe en clair avec le haché
		$isValidPassword = password_verify($password,$resultUser['password']);
// Si le mot de passe correspond on detruit le mot de passe enregistrer dans la variable par securité
		if($isValidPassword) {
			unset($resultUser['password']);
			$_SESSION['user'] = $resultUser;
//On redirige ensuite l'utilisateur vers le catalogue
			header("Location: catalogue.php");
			die();	
		}	
// Sinon on affiche un message d'erreur de connexion
		else {
			$errors['password'] = "Le mot de passe est incorrect";

		}
	}
	else {
		$errors['email'] = "Erreur de l'email ou email non enregistré";
	}
	$_SESSION['loginErrors'] = $errors;

	header("Location: connexion.php");
	die();

}	
?>	