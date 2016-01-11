<?php
session_start();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/normalize.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>Inscription</h1>
				<form method="POST" action="gerantIscription.php">
					<div class="form-group">
					    <label for="EmailId">Email</label>
					    <input type="text" class="form-control" id="EmailId" placeholder="Email" name="email" required >
					</div>
					<div class="form-group">
					    <label for="passwordId">Mot de passe</label>
					    <input type="password" class="form-control" id="passwordId" placeholder="Mot de passe" name="password" required >
					</div>
					<div class="form-group">
					    <label for="passwordConfirmID">Confirmer mot de passe</label>
					    <input type="password" class="form-control" id="passwordConfirmID" placeholder="Confirmer mot de passe" name="passwordConfirm" required >
					</div>
					<div class="form-group">
					    <label for="nameId">Nom</label>
					    <input type="text" class="form-control" id="nameId" placeholder="Nom" name="lastname" required >
					</div>
					<div class="form-group">
					    <label for="firstNameId">Prénom</label>
					    <input type="text" class="form-control" id="firstNameId" placeholder="Prénom" name="firstname" required >
					</div>
					<div class="form-group">
					    <label for="adressId">Adresse</label>
					    <input type="password" class="form-control" id="adressId" placeholder="Adresse" name="adress" required >
					</div>
					<div class="form-group">
					    <label for="zipcodeId">Code postal</label>
					    <input type="text" class="form-control" id="zipcodeId" placeholder="Code Postal" name="zipcode" required >
					</div>
					<div class="form-group">
					    <label for="cityId">Ville</label>
					    <input type="text" class="form-control" id="cityId" placeholder="Ville" name="town" required >
					</div>
					<div class="form-group">
					    <label for="phoneId">Téléphone</label>
					    <input type="text" class="form-control" id="phoneId" placeholder="06 ou 07 ..." name="phone" required >
					</div>
					
					  <button type="submit"  class="btn btn-primary" name="send">Valider</button>
					</form>

			</div>
					  
		</div>
	</div>
</body>
</html>