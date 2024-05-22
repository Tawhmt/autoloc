<?php 
include 'backbone.php';
include 'redirectNotLoggedIn.php';

if ($user['is_admin']=='F') {
    header('location: index.php');
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
</head>

<body class="is-preload">



    <div class="inner">
        <section>
            <h2 id="titre">Ajouter une voiture</h2>
            <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                <form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="plateId" class="form-control" id="plateId" placeholder="Immatriculation" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="model" class="form-control" id="model" placeholder="Modéle" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="year" class="form-control" id="year" placeholder="Année" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="color" class="form-control" id="color" placeholder="Couleur" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="automatic" id="automatic" required>
                            <option value="" disabled selected hidden>Automatiqe/Manuelle</option>
                            <option value="T">Automatique</option>
                            <option value="F">Manuelle</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="tank_capacity" class="form-control" id="tank_capacity" placeholder=" Capacite Réservoir" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="power" class="form-control" id="power" placeholder="Puissance en chevaux " required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="price" class="form-control" id="price" placeholder="Prix" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">                        
                        <select name="location" id="location" required>
                            <option value="" disabled selected hidden>Location</option>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM `location`");
                                $locations = Array();
                                while($row = mysqli_fetch_assoc($result)){
                                    $locations[] = $row['loc'];
                                }
                                foreach ($locations as &$location) {
                                    echo "<option value=\"$location\">$location</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="img">Image: </label>
                        <input type="file" accept="image/*" name="img" id = "img" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" value="Ajouter"/>
                </form>
            </div>
        </section>
    </div>


</div>
<style>
    /* Styles pour le formulaire */
.card {
  border: 2px solid #ccc; /* Bordure */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
  padding: 50px; /* Espacement intérieur pour le contenu */
  margin-bottom:50px;
  width:95%;
  margin-left: auto;
  margin-right: auto;
}

/* Styles pour les champs de formulaire */
.form-control {
  /* Ajoutez ici les styles souhaités pour les champs de formulaire */
}

/* Style pour le bouton */
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
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
  border:black !important;
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
</style>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="js/registerValidate.js"></script>
<script src="js/loginValidate.js"></script>
<?php
$conn = $_SESSION['conn'];
$ssn = $_SESSION['ssn'];

$result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn'");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $plate_id = $_POST['plateId'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $tank_capacity = $_POST['tank_capacity'];
    $power = $_POST['power'];
    $isAutomatic = $_POST['automatic'];
    $location = $_POST['location'];
    $out_of_service = 'F';

    $result = mysqli_query($conn, "SELECT * FROM `car` WHERE plate_id = '$plate_id'");
    $car = mysqli_fetch_assoc($result);

    if ($car) { // if car exists
        echo '<script>';
        echo 'alert("La voiture existe déja!");';
        echo 'window.location = "register_car.php"';
        echo '</script>';
    } else {
        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];    
        $folder = "images/". $filename;
        if (move_uploaded_file($tempname, $folder))  {
            $query = "INSERT INTO `car` (plate_id, model, year, out_of_service, price, color, power, `automatic`, tank_capacity, loc, img) VALUES('$plate_id','$model','$year','$out_of_service','$price','$color','$power','$isAutomatic','$tank_capacity','$location','$filename')";
            $result = mysqli_query($conn, $query);

            echo '<script>';
            echo 'alert("La voiture a été ajouter avec succés ");';
            echo '</script>';

            echo '<script>';
            echo 'window.location = "index.php"';
            echo '</script>';
            exit();
        } else {
            echo "<script>";
            echo "alert('Failed to upload the image !')";
            echo "</script>";

            echo '<script>';
            echo 'window.location = "register_car.php"';
            echo '</script>';
        }
    }
}

$conn->close();

?>
  <?php include 'footer.php'; ?>
  <?php include 'scripts.php';?>
</body>
</html>
