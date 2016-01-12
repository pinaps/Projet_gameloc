<?php
session_start();

require('../config/db.php');
require('../include/functions.php');

// checkLoggedIn();
/*checkAdmin(); 
*/
//Compter le nbr de users en bdd
$query = $pdo->query ('SELECT count(id) as total FROM users');
$resultCount  = $query->fetch();
$totalUser = $resultCount['total']; //Afficher cela dans la page admin avec un echo


?>

<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 50%;
             width: 100%; 
             margin-left: 25px;

            }
    </style>
  </head>
  <body>



    <div>
      <h1>Statistique</h1>
      <p>Il y a utilisateurs <?php echo $totalUser ?> sur le site. </p>
    </div>


   <!-- affichage de la map avec les marqueurs correspondant aux utilisateurs. --> 

      <h1>Localisation des utilisateurs</h1>
    <div id="map">
    </div>

    <script type="text/javascript">

    var map;

    var myLatLng = {lat: 48.8909964, lng: 2.2345892};

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 48.8588376, lng: 2.2773461},
        zoom: 12
      });

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'hello'
      });
    }

    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApFHyhOE1lniNGNo0yrkthO-wEUp4OOzM&callback=initMap">
    </script>
  </body>
</html>