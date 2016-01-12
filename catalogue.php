<?php
session_start();

if (isset($_POST['send'])) {
	$jeu = trim(htmlentities($_POST['game']));
	$plateforme = trim(htmlentities($_POST['plateform']));

	$query = $pdo->prepare('SELECT * 
							FROM games
							WHERE (name = :jeu AND plateforme = :plateforme)');
	$query->bindValue(':jeu', $jeu, PDO::PARAM_STR);
	$query->bindValue(':plateforme', $plateforme, PDO::PARAM_STR);
	$query->execute();

	$allgames = $query->fetchAll();

	echo "<pre>";
	echo $allgames;
	echo "</pre>";
}






?>

<!DOCTYPE html>
<html>
<head>
	<title>Catalogue</title>
	<?php include_once(__DIR__.'/include/head.php');?>

</head>
<body>
	<div id="backgroundGrey" class="center" >
		<?php include(__DIR__.'/include/coreStyle.php'); ?>
		<h4>Catalogue</h4>
			<br></br>
			<br></br>
											
	</div>	
	<div class="container">
		<div class="row">
			<div class="col-md-3" style=" background-color: #E3E3E3; margin-top: 40px;">
		  	
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

					<div class="form-group">
						<label for="searchId">Rechercher</label>
						<input type="text" class="form-control" id="searchId" name="game" placeholder="Tapez votre recherche">
					</div>
					<div class="form-group">
						<label for="plateformeId">Plateforme</label>
						<select id="plateformeId" class="form-control" name="plateform">
        					<option>Tous</option>
        					<option>PC</option>
        					<option>Playstation 4 </option>
        					<option>X-Box one</option>
      					</select>
					</div>
					
					<div class="checkbox">
						<label>
						<input type="checkbox">	Disponible immédiatement
						</label>
					</div>

					<button type="submit"  name="send" class="btn btn-primary">Rechercher</button>

				</form>

		  	</div>


			<div class="col-md-9">

		  	
		  	</div>
		</div>
	</div>

</body>
</html>