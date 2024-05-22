<?php 
    include 'backbone.php';
    include 'redirectNotLoggedIn.php';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Auto Loc</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css"/>
    </noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Cinzel:regular,500,600,700,800,900" rel="stylesheet" />
</head>
<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <br>
    <br>
</div>

<section>
    <?php 
        $ssn = $_SESSION['ssn']; 
        $query = "SELECT plate_id, pickup_time, return_time, pickup_location, return_location, img, model, year, color, automatic, price FROM `car` NATURAL JOIN `reservation` WHERE ssn = '$ssn'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0) {
            echo "<h2>Reservations</h2>";
        } else {
            echo "<h2>Pas de réservation pour l'instant !</h2>";
        }
    ?>
    <div>
        <ul>
            <?php
                $reserv_num = 1;             
                while($car = mysqli_fetch_assoc($result)) {
                    echo "<br>";
                    echo "<h3>Reservation #" . $reserv_num . "</h3>";
                    $reserv_num = $reserv_num + 1;

                    echo "<img src=\"images/" . $car['img'] . "\" class=\"nav-item\" style=\"width: 500px; height: 300px;\">";
                    echo "<li class=\"nav-item\">Modèle: " . $car['model'] . "</li>";
                    echo "<li class=\"nav-item\">Année: " . $car['year'] . "</li>";
                    echo "<li class=\"nav-item\">Couleur: " . $car['color'] . "</li>";
                    if($car['automatic'] === 'T') {
                        $type = "Automatic";
                    } else {
                        $type = "Manual";
                    }
                    echo "<li class=\"nav-item\">Type: " . $type . "</li>";
                    
                    echo "<li class=\"nav-item\">Plaque immatriculation: " . $car['plate_id'] . "</li>";
                    echo "<li class=\"nav-item\">Lieu prise en charge: " . $car['pickup_location'] . "</li>";
                    echo "<li class=\"nav-item\">Date prise en charge " . $car['pickup_time'] . "</li>";
                    echo "<li class=\"nav-item\">Lieu de retour: " . $car['return_location'] . "</li>";
                    echo "<li class=\"nav-item\">Date de retour: " . $car['return_time'] . "</li>";
                    echo "<li class=\"nav-item\">Prix par jour (Da/€/Dr) : " . $car['price'] . "</li>";
                    
                    $start_date = strtotime($car['pickup_time']);  
                    $end_date = strtotime($car['return_time']);
                    $days = (($end_date - $start_date)/60/60/24);  //calculate number of reservation days
                    $cost_per_day = $car['price'];  //price of the car per day
                    $amount_per_reservation = $cost_per_day * $days;  //total amount to be paid
                    echo "<li class=\"nav-item\">Paiement total: (Da/€/Dr) :" . $amount_per_reservation . "</li>";
                }
            ?>
        </ul>
    </div>
</section>

<?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>

</body>
</html>