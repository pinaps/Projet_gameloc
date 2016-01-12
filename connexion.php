

<!DOCTYPE html>
<html>
	<head>
		<title>Gameloc</title>
		<meta charset='utf-8'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="public/css/main.css">
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

				<!-- Affiche les erreurs stockés en session avec la clé registerErrors -->
					<?php if(isset($_SESSION['registerErrors'])): ?>
						<div class="alert alert-danger">
							<?php foreach($_SESSION['registerErrors'] as $keyError => $error): ?>
								<p><?php echo $error; ?></p>
							<?php endforeach; ?>
						</div>
						<!-- Supprime les erreurs après les avoir affiché 1 fois -->
						<?php unset($_SESSION['registerErrors']); ?>
					<?php endif; ?>

						
					<!-- Copié de bootstrap : http://getbootstrap.com/css/#forms -->
			            
					<form method="POST" action="catalogue.php">
						
						<div class="form-group">
			              <label for="email">Email</label>
			              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
			            </div>

			            <div class="form-group">
			              <label for="password">Password</label>
			              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			            </div>


			           
			            <button type="submit" name="action" class="btn btn-success">Valider</button>
					</form>
				</div>

				</form>
				</div>
			</div>
		</div>
	</body>
</html>