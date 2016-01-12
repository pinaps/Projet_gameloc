<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Catalogue</title>
	<?php include_once(__DIR__.'/include/head.php');?>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
		  	
				<form>

					<div class="form-group">
						<label for="searchId">Rechercher</label>
						<input type="text" class="form-control" id="searchId" placeholder="Tapez votre rechercher">
					</div>
					<div class="form-group">
						<label for="plateformeId">Plateforme</label>
						<select id="plateformeId" class="form-control">
        					<option>Tous</option>
        					<option>PC</option>
        					<option>Playstation 4 </option>
        					<option>X-Box one</option>
      					</select>
					</div>
					
					<div class="checkbox">
						<label>
						<input type="checkbox"> Check me out
						</label>
					</div>

					<button type="submit" class="btn btn-default">Submit</button>

				</form>

		  	</div>

			<div class="col-md-8">
		  	
		  	</div>
		</div>
	</div>

</body>
</html>