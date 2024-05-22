<?php include 'backbone.php'; ?>
<?php
$conn = $_SESSION['conn'];
$ssn = $_SESSION['ssn'];
$plate_id = $_GET['plate_id'];
if(!isset($_GET['plate_id'])){
    echo '<script>';
    echo 'window.location = "car_catalog.php"';
    echo '</script>';
}
$result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn' AND is_admin='F'");
$user = mysqli_fetch_assoc($result);
if (!$user) {
    echo '<script>';
    echo 'window.location = "register.php"';
    echo '</script>';
}


$result = mysqli_query($conn, "SELECT * FROM `car` WHERE plate_id ='$plate_id'");
$car = mysqli_fetch_assoc($result);
if(!$car) {
    echo '<script>';
    echo "alert(\"car $plate_id\")";
    echo '</script>';
}

if($car['out_of_service'] === "T") {
    echo '<script>';
    echo 'alert("Car is out of service")';
    echo 'window.location = "index.php"';
    echo '</script>';
}
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
    <script src="js/reservationValidate.js"></script>
</head>
<body class="is-preload">
<!-- Wrapper -->
<style>
    .btn-primary {
    background-color: grey; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte du bouton */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #3b4146; /* Couleur de fond du bouton au survol */
    color: white; /* Couleur du texte du bouton au survol */
    text-decoration: none;
}
.btn-primary:active {
    background-color: #3b4146  !important; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte du bouton */
    text-decoration: none;
    outline: none !important;
 
}
#titre{
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
  border:black !important;
}
.card {
    border: 2px solid #ccc; /* Bordure */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
    padding: 20px; /* Espacement intérieur pour le contenu */
    margin-bottom: 50px;
}

</style>


        <section>
            <div class="row">
                <div class="col-md-6">
                    <h2 id="titre">Details</h2>
                <ul>
                    <?php
                        echo "<img src=\"images/" . $car['img'] . "\" class=\"nav-item\" style=\"width: 500px; height: 300px;\">";
                        echo "<li class=\"nav-item\">Modéle: " . $car['model'] . "</li>";
                        echo "<li class=\"nav-item\">Année: " . $car['year'] . "</li>";
                        echo "<li class=\"nav-item\">Couleur: " . $car['color'] . "</li>";
                        echo "<li class=\"nav-item\">Puissance: " . $car['power'] . "</li>";
                        if($car['automatic'] === 'T') {
                            $type = "Automatic";
                        } else {
                            $type = "Manual";
                        }
                        echo "<li class=\"nav-item\">Type: " . $type . "</li>";
                        echo "<li class=\"nav-item\">Capacité du réservoir : " . $car['tank_capacity'] . "</li>";
                        echo "<li class=\"nav-item\">Location: " . $car['loc'] . "</li>";
                        echo "<li class=\"nav-item\">Prix par jour (Da/€/Dr) :" . $car['price'] . "</li>";
                    ?>
                </ul>
                </div>
                <div class="col-md-6">
                <h2 id="titre">Réserver</h2>
            <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                <form class="form-inline" method="post" name="myForm" action="" onsubmit="return validateReservationForm();">
                    <?php 
                        $result = mysqli_query($conn, "SELECT branch_name FROM `car` NATURAL JOIN `location` NATURAL JOIN `branch` WHERE plate_id = \"$plate_id\"");
                        $branches = Array();
                        while($row = mysqli_fetch_assoc($result)){
                            $branches[] = strtolower($row['branch_name']);
                        }
                    ?>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="pickup_location" id="pickup_location" required>
                            <option value="" disabled selected hidden>Lieu prise en charge</option>
                            <?php
                                foreach (array_unique($branches) as &$branch) {
                                    echo "<option value=\"$branch\">$branch</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="return_location" id="return_location" required>
                            <option value="" disabled selected hidden>Lieu de retour </option>
                            <?php
                                foreach (array_unique($branches) as &$branch) {
                                    echo "<option value=\"$branch\">$branch</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="pickup_time">Date prise en charge </label>
                        <input type="date" name="pickup_time" class="form-control" id="pickup_time" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="return_time">Date de  retour </label>
                        <input type="date" name="return_time" class="form-control" id="return_time" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" value="Réserver"/>
                </form>
            </div>
                </div>
            </div>
           
        </section>
  


</div>

<?php include 'scripts.php';?>

<?php
if (isset($_POST['submit'])) {

    $reservation_time = date("Y-m-d H:i:s");
    $pickup_location = $_POST['pickup_location'];
    $return_location = $_POST['return_location'];
    $pickup_time = $_POST['pickup_time'];
    $return_time = $_POST['return_time'];

    $result = mysqli_query($conn, "SELECT * FROM `reservation` WHERE plate_id = '$plate_id' AND ((pickup_time BETWEEN '$pickup_time' AND  '$return_time') OR (return_time BETWEEN '$pickup_time' AND '$return_time')  OR ('$pickup_time' BETWEEN pickup_time AND return_time) OR ('$return_time' BETWEEN pickup_time AND return_time))");
    $clash = mysqli_fetch_assoc($result);
    
    if ($clash) { // if there is a clash
        echo '<script>';
        echo 'alert("La réservation existe déja!");';
        echo 'window.location = "car_catalog.php"';
        echo '</script>';
    } else {
        $query = "INSERT INTO `reservation` (plate_id,ssn,reservation_time,pickup_location,return_location,pickup_time,return_time,is_paid) VALUES('$plate_id','$ssn','$reservation_time','$pickup_location','$return_location','$pickup_time','$return_time','F')";
        $result = mysqli_query($conn, $query);

        echo '<script>';
        echo 'alert("Reservation faite avec succés");';
        echo '</script>'; 

        echo '<script>';
        echo 'window.location = "index.php"';
        echo '</script>';
    }
}

$conn->close();

?>
    <?php include 'footer.php'; ?>
 
</body>
</html>