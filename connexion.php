<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gameloc</title>
		<?php include_once(__DIR__.'/include/head.php'); ?>
</head>

	<body>
		<main id="backgroundGrey" class="center" >
			<?php include(__DIR__.'/include/coreStyle.php'); ?>
			<h4>Connexion</h4>
				<br></br>
				<br></br>
		</main>	
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">

							
					<!-- Copié de bootstrap : http://getbootstrap.com/css/#forms -->
			          
					<?php if (isset($_SESSION['message'])):?>
						<div class="alert alert-info">
							<?php echo $_SESSION['message'];?>
							<?php unset($_SESSION['message']) ;?>
						</div>
					<?php endif;?>

					<form method="POST" action="gerantConnexion.php">
						
						<div class="form-group">
			              <label for="email">Email</label>
			              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
			            </div>

			            
			            <?php if(isset($_SESSION['loginErrors']['email'])): ?>
						<div class="alert alert-danger">
						<?php  echo $_SESSION['loginErrors']['email']; ?>
						<?php unset($_SESSION['loginErrors']['email']);?>
						</div>
						<?php endif; ?>

			            <div class="form-group">
			              <label for="password">Password</label>
			              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			            </div>


			            <?php if(isset($_SESSION['loginErrors']['password'])): ?>
						<div class="alert alert-danger">
						<?php  echo $_SESSION['loginErrors']['password']; ?>
						<?php unset($_SESSION['loginErrors']['password']);?>
						</div>
						<?php endif; ?>



						
			           	<button type="submit" name="send" class="btn btn-success" >Valider</button>
									           
						<a href="mdpoublie.php" class="btn btn-link" role="button">Mot de passe oublié ?</a>

					</form>
				</div>

				</form>
				</div>
			</div>
		</div>
	</body>
</html>