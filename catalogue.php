<?php
session_start();
require(__DIR__.('/config/db.php'));



//On génère un select en fonction des platformes disponibles dans la bdd
$query = $pdo->query('SELECT * FROM platforms');
$plateformes = $query->fetchAll();
// echo"<pre>";
// print_r($plateformes);
// echo"</pre>"; 

//si le formulaire  n'est pas envoyé 

	//on récupère les infos voulues dans la bdd ordonnées de la plus récente à la plus ancienne
	$query = $pdo->prepare('SELECT games.*, platforms.name as platforms_name 
							FROM games 
							INNER JOIN platforms ON platform_id = platforms.id
							ORDER BY created_at DESC');
	$query->execute();
	$games = $query->fetchAll();	


	// echo"<pre>";
	// print_r($games);
	// echo"</pre>";	


// si le formulaire de recherche est envoyé
if (isset($_POST['send'])) {
	// on récupère les infos des champs
	$jeu = trim(htmlentities($_POST['game']));
	$plateformId = intval($_POST['plateform']);
	$disponible = isset($_POST['is_available']);

	// si toutes les plateforme sont selectionnées
	if ($plateformId == '0'&& $disponible) {
		echo "111111111111";

		//on récupère les infos voulues dans la bdd
		$query = $pdo->prepare('SELECT games.*, platforms.name as platforms_name 
								FROM games 
								INNER JOIN platforms ON platform_id = platforms.id
								WHERE (games.name LIKE :jeu AND is_available = :available )');
		$query->bindValue(':jeu', '%'.$jeu.'%', PDO::PARAM_STR);
		$query->bindValue(':available', $disponible, PDO::PARAM_BOOL);
		$query->execute();

		// et on place ces infos dans une variable pour les utiliser plus tard
		$games = $query->fetchAll();

		echo"<pre>";
		print_r($games);
		echo"</pre>";

	}

	elseif($plateformId == '0'&& !$disponible) {
		echo "2222222222";

		//on récupère les infos voulues dans la bdd
		$query = $pdo->prepare('SELECT games.*, platforms.name as platforms_name 
								FROM games 
								INNER JOIN platforms ON platform_id = platforms.id
								WHERE (games.name LIKE :jeu AND is_available = :available )');
		$query->bindValue(':jeu', '%'.$jeu.'%', PDO::PARAM_STR);
		$query->bindValue(':available', $disponible, PDO::PARAM_BOOL);
		$query->execute();

		// et on place ces infos dans une variable pour les utiliser plus tard
		$games = $query->fetchAll();

		echo"<pre>";
		print_r($games);
		echo"</pre>";
	}

	elseif ($plateformId > 0 && $disponible){
		echo "3333333";

		//on récupère les infos voulues dans la bdd
		$query = $pdo->prepare('SELECT games.*, platforms.name as platforms_name 
								FROM games 
								INNER JOIN platforms ON platform_id = platforms.id
								WHERE (games.name LIKE :jeu AND  games.platform_id = :plateforme AND is_available = :available) ');
		$query->bindValue(':jeu', '%'.$jeu.'%', PDO::PARAM_STR);
		$query->bindValue(':plateforme', $plateformId, PDO::PARAM_INT);
		$query->bindValue(':available', $disponible, PDO::PARAM_BOOL);
		$query->execute();

		// et on place ces infos dans une variable pour les utiliser plus tard
		$games = $query->fetchAll();
		
		echo"<pre>";
		print_r($games);
		echo"</pre>";
	}

	//si une plateforme particulière est choisie 
	elseif ($plateformId > 0 && !$disponible){
		echo "44444444";
		//on récupère les infos voulues dans la bdd
		$query = $pdo->prepare('SELECT games.*, platforms.name as platforms_name 
								FROM games 
								INNER JOIN platforms ON platform_id = platforms.id
								WHERE (games.name LIKE :jeu AND  games.platform_id = :plateforme AND is_available = :available ) ');
		$query->bindValue(':jeu', $jeu, PDO::PARAM_STR);
		$query->bindValue(':plateforme', $plateformId, PDO::PARAM_INT);
		$query->bindValue(':available', $disponible, PDO::PARAM_BOOL);
		$query->execute();

		// et on place ces infos dans une variable pour les utiliser plus tard
		$games = $query->fetchAll();
		
		echo"<pre>";
		print_r($games);
		echo"</pre>";
	}
	
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
			 	<!-- bouton de déconnexion -->
			 	<div style="float:right; margin:40;">
				<a href="deconnexion.php" class="btn btn-link" role="button">Deconnexion</a>	
			 	</div>
						  		
		<?php include(__DIR__.'/include/coreStyle.php'); ?>
		<h4>Catalogue</h4>
			<br></br>
			<br></br>
											
	</div>	
	<div class="container-fluid">
		<div class="row">

			<!-- Je sépare ma page en deux grâce à bootstrap --> 

			<div class="col-md-3" style=" background-color: #E3E3E3; margin-top: 40px;">

		  		<!-- Moteur de recherche de jeux -->
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

					<div class="form-group">
						<label for="searchId">Rechercher</label>
						<input type="text" class="form-control" id="searchId" name="game" placeholder="Tapez votre recherche">
					</div>

					<div class="form-group">
						<label for="plateformeId">Plateforme</label>

						<select id="plateformeId" class="form-control" name="plateform">
        					<option selected="" value="0">Tous</option>

						<?php foreach ($plateformes as $keyplateformes => $console):?>
        					<option value="<?php echo $console['id']; ?>"><?php echo $console['name'];?> </option>
        				<?php endforeach;?>

      					</select>
					</div>
					
					<div class="checkbox">
						<label>
						<input type="checkbox" name="is_available" checked>	Disponible immédiatement
						</label>
					</div>

					<div style="text-align: center; ">
						<button type="submit"  name="send" class="btn btn-primary" >Rechercher</button>
					</div>
					
				</form>

		  	</div>


			<div class="col-md-9">

				<!-- Je boucle sur mon tableau d'infos $games pour afficher ce que je désire -->
				<?php foreach ($games as $keygames => $game):?>

					<div style="display: inline-block; text-align: center; /* width:100%;*/   margin-top: 40px;">
						
						<img src="<?php echo $game['url_img'];?>" alt="image du jeu">
						<h5><?php echo $game['name'];?></h5>
						<p>Plateforme : <?php echo $game['platforms_name'];?></p>
						<button class=" btn <?php if ($game['is_available']==1){echo "btn-success";}else{echo "btn-danger";}?>">Louer</button>
					
					</div>

				<?php endforeach; ?> 

		  	</div>
		</div>
	</div>

</body>
</html>