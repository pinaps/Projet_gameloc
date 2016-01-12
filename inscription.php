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
	<div id="backgroundGrey" class="center" >
		<?php include(__DIR__.'/include/coreStyle.php'); ?>
		<h4>Inscription</h4>
			<br></br>
			<br></br>
											
	</div>	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
					<form method="POST" action="gerantIscription.php">

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['email'])) echo"has-error";?>">
						    <label for="EmailId">Email</label>
						    <input type="text" class="form-control" id="EmailId" placeholder="Email" name="email" required >
							
							<?php if(isset($_SESSION['registerErrors']['email'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['email'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['password'])) echo"has-error";?>">
						    <label for="passwordId">Mot de passe</label>
						    <input type="password" class="form-control" id="passwordId" placeholder="Mot de passe" name="password" required >
							
							<?php if(isset($_SESSION['registerErrors']['password'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['password'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['password'])) echo"has-error";?>">
						    <label for="passwordConfirmID">Confirmer mot de passe</label>
						    <input type="password" class="form-control" id="passwordConfirmID" placeholder="Confirmer mot de passe" name="passwordConfirm" required >
							
							<?php if(isset($_SESSION['registerErrors']['password'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['password'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['lastname'])) echo"has-error";?>">
						    <label for="nameId">Nom</label>
						    <input type="text" class="form-control" id="nameId" placeholder="Nom" name="lastname" required >
							
							<?php if(isset($_SESSION['registerErrors']['lastname'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['lastname'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['firstname'])) echo"has-error";?>">
						    <label for="firstNameId">Prénom</label>
						    <input type="text" class="form-control" id="firstNameId" placeholder="Prénom" name="firstname" required >
							
							<?php if(isset($_SESSION['registerErrors']['firstname'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['firstname'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['adress'])) echo"has-error";?>">
						    <label for="adressId">Adresse</label>
						    <input type="text" class="form-control" id="adressId" placeholder="Adresse" name="adress" required >
							
							<?php if(isset($_SESSION['registerErrors']['adress'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['adress'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['zipcode'])) echo"has-error";?>">
						    <label for="zipcodeId">Code postal</label>
						    <input type="text" class="form-control" id="zipcodeId" placeholder="Code Postal" name="zipcode" required >
							
							<?php if(isset($_SESSION['registerErrors']['zipcode'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['zipcode'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['town'])) echo"has-error";?>">
						    <label for="cityId">Ville</label>
						    <input type="text" class="form-control" id="cityId" placeholder="Ville" name="town" required >
							
							<?php if(isset($_SESSION['registerErrors']['town'])):?>
								<div class="alert alert-danger">
									<?php echo $_SESSION['registerErrors']['town'];?>
								</div>
							<?php endif;?>
						</div>

						<div class="form-group <?php if(isset($_SESSION['registerErrors']['phone'])) echo"has-error";?>">
						    <label for="phoneId">Téléphone</label>
						    <input type="text" class="form-control" id="phoneId" placeholder="06 ou 07 ..." name="phone" required >
							
							<?php if(isset($_SESSION['registerErrors']['phone'])):?>
								<div class="alert alert-danger">
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