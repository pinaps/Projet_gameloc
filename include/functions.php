<?php

function CheckLoggedIn(){
	if(empty($_SESSION['user'])){
		header("location: index.php");
		die();
	}
}

function CheckAdmin(){
	if ($_SESSION['user']['role'] != 'admin') {
		header("HTTP/1.0 403 Forbidden");
		die();
	}
}













// Pour enregistrer en bdd :
// champs latitude: DECIMAL(10,8)
// champs longitude: DECIMAL(11,8)
function geocode($address) {

	// Url de l'api http://maps.google.com/maps/api/geocode/json?address=

	// Encodage de l'adresse pour la soumettre sur l'url par la suite
	$address = urlencode($address);

	// Url de l'api pour geocoder
	// 'http://maps.google.com/maps/api/geocode/json?address='.$address
	$urlApi = "http://maps.google.com/maps/api/geocode/json?address=$address";

	// Appel à l'Api gmap decode (en GET - réponse en JSON)
	$responseJson = file_get_contents($urlApi); 

	// Decodage du json pour le transformer en array php associatif (2eme paramètre à true)
	$reponseArray = json_decode($responseJson, true);

	/*echo '<pre>';
	print_r($reponseArray);
	echo '</pre>';*/

	// On prépare un tableau associatif comme réponse de cette fonction
	$reponse = [];

	// Je test le statut de réponse à OK (sinon cela signifie qu'il n'a pas de correspondance) 
	if($reponseArray['status'] == 'OK') {
		$lat = $reponseArray['results'][0]['geometry']['location']['lat'];
		$lng = $reponseArray['results'][0]['geometry']['location']['lng'];

		// Test les valeurs (pas indispensable)
		if($lat && $lng) {
			$reponse['lat'] = $lat;
			$reponse['lng'] = $lng;
		}
	}

	return $reponse;

}



?>