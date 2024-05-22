<?php include 'backbone.php'; ?>
<?php
$conn = $_SESSION['conn'];
if(isset($_GET['plate_id']))
$plate_id = $_GET['plate_id'];

$result = mysqli_query($conn, "SELECT * FROM `car` WHERE plate_id = '$plate_id'");
$car = mysqli_fetch_assoc($result);
if (!$car) {
    echo '<script>';
    echo 'window.location = "index.php"';
    echo '</script>';
}
if($car['out_of_service'] === 'T') {
    $status = "Hors Service";
} else {
    $status = "Disponible";
}
$_SESSION['plate_id'] = $plate_id;
$_SESSION['status'] = $status;
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Auto Loc </title>
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
    #titre{
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}
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
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
}


</style>

<!-- Footer -->
<footer id="footer">
        <section>
            <h2 id="titre">Détails</h2>
            <div>
                <ul>
                    <?php
                        echo "<img src=\"images/" . $car['img'] . "\" class=\"nav-item\" style=\"width: 500px; height: 300px;\">";
                        echo "<li class=\"nav-item\">Model: " . $car['model'] . "</li>";
                        echo "<li class=\"nav-item\">Year: " . $car['year'] . "</li>";
                        echo "<li class=\"nav-item\">Statut: " . $status . "</li>";
                    ?>
                </ul>
            </div>
        </section>
        <form action="change_car_status.php" method="post">
            <label for="changeStatus">Voulez vous changer le statut de la voiture ?
                <?php
                    if($status === 'Disponible') {
                        echo "Hors service  ?";
                    } else {
                        echo "Disponible  ?";
                    }
                ?>
            </label>
            <input type="submit" name="changeStatus" value="OUI" class="btn-primary">
        </form>
</footer>
</div>

<?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>

</body>
</html>
