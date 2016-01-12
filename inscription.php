<?php
session_start();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<?php include_once(__DIR__.'/include/head.php'); ?>
		



</head>
<body>
	<main id="backgroundGrey" class="center" >
		<?php include(__DIR__.'/include/coreStyle.php'); ?>
		<h4>Inscription</h4>
			<br></br>
			<br></br>
											
	</main>	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
					<form method="POST" action="gerantIscription.php">
					<div class="form-group">
					    <label for="EmailId">Email</label>
					    <input type="text" class="form-control" id="EmailId" placeholder="Email" name="email" required >
						
						<?php if(isset($_SESSION['registerErrors']['email'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['email'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="passwordId">Mot de passe</label>
					    <input type="password" class="form-control" id="passwordId" placeholder="Mot de passe" name="password" required >
						
						<?php if(isset($_SESSION['registerErrors']['password'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['password'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="passwordConfirmID">Confirmer mot de passe</label>
					    <input type="password" class="form-control" id="passwordConfirmID" placeholder="Confirmer mot de passe" name="passwordConfirm" required >
						
						<?php if(isset($_SESSION['registerErrors']['password'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['password'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="nameId">Nom</label>
					    <input type="text" class="form-control" id="nameId" placeholder="Nom" name="lastname" required >
						
						<?php if(isset($_SESSION['registerErrors']['lastname'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['lastname'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="firstNameId">Prénom</label>
					    <input type="text" class="form-control" id="firstNameId" placeholder="Prénom" name="firstname" required >
						
						<?php if(isset($_SESSION['registerErrors']['firstname'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['firstname'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="adressId">Adresse</label>

					    <input type="text" class="form-control" id="adressId" placeholder="Adresse" name="adress" required >

					   						
						<?php if(isset($_SESSION['registerErrors']['adress'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['adress'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="zipcodeId">Code postal</label>
					    <input type="text" class="form-control" id="zipcodeId" placeholder="Code Postal" name="zipcode" required >
						
						<?php if(isset($_SESSION['registerErrors']['zipcode'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['zipcode'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="cityId">Ville</label>
					    <input type="text" class="form-control" id="cityId" placeholder="Ville" name="town" required >
						
						<?php if(isset($_SESSION['registerErrors']['town'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['town'];?>
							</div>
						<?php endif;?>
					</div>

					<div class="form-group">
					    <label for="phoneId">Téléphone</label>
					    <input type="text" class="form-control" id="phoneId" placeholder="06 ou 07 ..." name="phone" required >
						
						<?php if(isset($_SESSION['registerErrors']['phone'])):?>
							<div class="form-group has-error">
								<?php echo $_SESSION['registerErrors']['phone'];?>
							</div>
						<?php endif;?>
					</div>

					
					  <button type="submit"  class="btn btn-primary" name="send">Valider</button>
					</form>

			</div>
					  
		</div>
	</div>
</body>
</html>