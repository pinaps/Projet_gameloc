<?php
session_start();

require(__DIR__.'/config/db.php');
require(__DIR__.'/include/functions.php');
require(__DIR__.'/vendor/autoload.php');




if (isset($_POST['send'])){
	//on récupère l'eamil
	$email =trim(htmlentities($_POST['email']));

	//initialisation du tableau d'erreur
	$errors = [];

	//check du champ email
	if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
			$errors['email'] = "Erreur email.";
	}

	if (empty($errors)) {
		
		//on récupère l'utilisaateur en bdd
		$query = $pdo->prepare('SELECT * FROM users 
								WHERE email = :email');
		$query->bindvalue(':email', $email, PDO::PARAM_STR);
		$query->execute();

		$resultUser = $query->fetch();

		//si j'ai bien un user en bdd
		if($resultUser){

			//génération du token
			$token = md5(uniqid(mt_rand(), true));

			//Date d'expiration du token
			$expire_token = date("Y-m-d H:i:s", strtotime("+ 1 day"));

			//On récupère de l'adresse ip du demandeur
			$ip = $_SERVER['REMOTE_ADDR'];


			//Sauvegarder les 3 éléments ci-dessus en bdd
			$query = $pdo->prepare('UPDATE users
									SET token = :token, expire_token = :expire_token, ip = :ip
									WHERE id = :id');
			$query->bindvalue(':token', $token, PDO::PARAM_STR);
			$query->bindvalue(':expire_token', $expire_token, PDO::PARAM_STR);
			$query->bindvalue(':ip', $ip, PDO::PARAM_STR);
			$query->bindvalue(':id', $resultUser['id'], PDO::PARAM_INT);

			$query->execute();


			//si mise à jour ok
			if($query->rowCount() == 1){

				//on génère le lien de reset de password
				$resetLink = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/resetPassword.php?token='.$token.'&email='.$email;

				echo $resetLink; die();




				//envoie un email à l'utilisateur 


				$mail = new PHPMailer;

				

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'postmaster@sandbox504c3f44050c4ee3aa785151b4924429.mailgun.org';                 // SMTP username
				$mail->Password = '5af02be0e52d7990ab876526bae4ba3e';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				$mail->setFrom('no-reply@aego.fr', 'Mailer');
				$mail->addAddress('iadjalian@gmail.com');               // Name is optional
				$mail->addAddress($email);               // Name is optional

				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Nouveau mot de passe';
				$mail->Body    = ' <a href= "'.$resetLink.'"Voici le lien de reset mot de passe</a>';
				

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} 
				else {
				    echo 'Message has been sent';
				} 
				//Terminer le resetPassword.php avec le modèle dans wf3_session
			}
		}
		else{
			$errors['email'] ="Cette adresse email n'est pas dans la bdd"; 
		}
	}
}
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

					<form method="POST" action="<?php echo $_SERVER[PHP_SELF];?>">
						
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

			          


						
			           	<button type="submit" name="send" class="btn btn-success" >Valider</button>
									           
						

					</form>
				</div>

				</form>
				</div>
			</div>
		</div>
	</body>
</html>