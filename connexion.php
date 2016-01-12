

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
			            
					<form method="POST" action="registerHandler.php">
						
						<div class="form-group">
			              <label for="email">Email</label>
			              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
			            </div>

			            <div class="form-group">
			              <label for="password">Password</label>
			              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			            </div>


			           
			            <button type="submit" name="action" class="btn btn-default">Valider</button>
					</form>
				</div>

				</form>
				</div>
			</div>
		</div>
	</body>
</html>