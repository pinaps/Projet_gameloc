<?php
session_start();

require(__DIR__.'/config/db.php');

// Vérifie que le button submit a été cliqué
if (isset($_POST['send'])) {

	// Affecte une variable à chaque valeur clé de $_POST
	$email = trim(htmlentities($_POST['email']));
	$password = trim(htmlentities($_POST['password']));
	$passwordConfirm = trim(htmlentities($_POST['passwordConfirm']));
	$lastname = trim(htmlentities($_POST['lastname']));
	$firstname = trim(htmlentities($_POST['firstname']));
	$adress = trim(htmlentities($_POST['adress']));
	$zipcode = trim(htmlentities($_POST['zipcode']));
	$town = trim(htmlentities($_POST['town']));
	$phone = trim(htmlentities($_POST['phone']));






	// Initialisation d'un tableau d'erreurs
		$errors = [];



// 1. Vérifier tous les champs input


	// Check du champs email
		if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
			$errors['email'] = "Wrong email.";
		}
		elseif(strlen($email) > 60) {
			$errors['email'] = "Email too long.";
		}
		else {
			// Je vérifie que l'email existe pas déjà dans ma bdd
			$query = $pdo->prepare('SELECT email FROM users WHERE email = :email');
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();
			// Je récupère le résultat sql
			$resultEmail = $query->fetch();

			if($resultEmail['email']) {
				$errors['email'] = "Email already exists.";
			}
		}


	//check du champ lastname
	if (!empty($lastname)) {
		// Le lastname contient entre 3 et 30 letrres
		$lastnameValid = preg_match('/[a-zA-Z]{3,30}/', $lastname);	
		if (!$lastnameValid) {
			$errors['lastname'] = "le nom n'est pas conforme.";
		}
	}

	else{
		$errors['lastname'] = "Vous n'avez pas écrit votre nom.";
	}

	//check du champ firstname
	if (!empty($firstname)) {
		// Le firstname contient entre 3 et 30 letrres
		$firstnameValid = preg_match('/[a-zA-Z]{3,30}/', $firstname);	
		if (!$firstnameValid) {
			$errors['firstname'] = "le prénom n'est pas conforme.";
		}
	}

	else{
		$errors['firstname'] = "Vous n'avez pas écrit votre prénom.";
	}
	
	//check du champ adresse
	if (empty($adress)) {
		$errors['adress'] = "Vous n'avez pas indiqué votre adresse.";
	}

	//check du champ code postal
	if (empty($zipcode)) {
		$errors['zipcode'] = "Vous n'avez pas indiqué votre code postal.";
	}
	else {
		// Le code postal contient 5 chiffres ?
			$zipcodeValid  = preg_match('/\d{5}/', $zipcode);
			if (!$zipcodeValid) {
				$errors['zipcode'] = "le code postal est non comforme.";
			}
	}


	//check du champ ville
	if (empty($town)) {
		$errors['town'] = "Vous n'avez pas indiqué votre ville.";
	}

	//check du champ téléphone
	if (empty($phone)) {
		$errors['phone'] = "Vous n'avez pas indiqué votre numéro de téléphone.";
	}
	else{
		// Lenuméro de téléphone contient 10 chiffres ?
			$phoneValid  = preg_match('/\d{10}/', $phone);
		if (!$phoneValid) {
			$errors['phone'] = "le numéro de téléphone n'est pas conforme.";
		}
	}
// 2. Vérifier que les 2 champs password sont identiques
	
	// Check du champs password
		// 1. Vérifier que les 2 passwords sont identiques
		if($password != $passwordConfirm) {
			$errors['password'] = "Not same passwords.";
		}

		// 2. Vérifier que le passwords ne fasse moins de 6 caractères
		elseif(strlen($password) <= 6) {
			$errors['password'] = "Password too short.";
		}

		// 3. Conditions de caractères dans le password

		else {
			// Le password contient au moins une lettre ?
			$containsLetter = preg_match('/[a-zA-Z]/', $password);
			// Le password contient au moins un chiffre ?
			$containsDigit  = preg_match('/\d/', $password);
			// Le password contient au moins un autre caractère ?
			$containsSpecial= preg_match('/[^a-zA-Z\d]/', $password);

			// Si une des conditions n'est pas remplie ... erreur
			if(!$containsLetter || !$containsDigit || !$containsSpecial) {
				$errors['password'] = "Choose a best password with at least one letter, one number and one special character.";
			}
		}

// 3. On crypte le mot de passe
	// Hash du password pour la sécurité
				// Attention, PHP 5.5 ou plus !!! - Sinon, depuis 5.3.7 : https://github.com/ircmaxell/password_compat
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 4. Enregistrer en bdd
	if(empty($errors)) {
				$query = $pdo->prepare('INSERT INTO users(email, password, lastname, firstname, adress, zipcode, town, phone,  created_at, updated_at) VALUES(:email, :password, :lastname, :firstname, :adress, :zipcode, :town, :phone, NOW(), NOW())');
				$query->bindValue(':email', $email, PDO::PARAM_STR);				
				$query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
				$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
				$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
				$query->bindValue(':adress', $adress, PDO::PARAM_STR);
				$query->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
				$query->bindValue(':town', $town, PDO::PARAM_STR);
				$query->bindValue(':phone', $phone, PDO::PARAM_STR);
				$query->execute();


// 5. Créer une session user pour le logger immédiatement
	// L'utilisateur a t-il été bien inséré en bdd ?
			if($query->rowCount() > 0) {
				// Récupération de l'utilisateur depuis la bdd 
				// pour l'affecter à une variable de session
				$query = $pdo->prepare('SELECT * FROM users WHERE id = :id');
				$query->bindValue(':id', $pdo->lastInsertId(), PDO::PARAM_INT);
				$query->execute();
				$resultUser = $query->fetch();

				// On stocke le user en session et on retire le password avant (pas très grave)
				unset($resultUser['password']);
				$_SESSION['user'] = $resultUser;

				// On redirige l'utilisateur vers la page protégée profile.php
				header("Location: catalogue.php");
				die();
			}
	}
	else {
			// On stocke toutes les erreurs en session
			$_SESSION['registerErrors'] = $errors;

			// On redirige dans l'index
			header("Location: inscription.php");
			die();
		}		
}
?> 