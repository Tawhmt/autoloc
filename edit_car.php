<?php 
include 'backbone.php';
include 'redirectNotLoggedIn.php';

$conn = $_SESSION['conn'];
$ssn = $_SESSION['ssn'];

$result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn'");
$user = mysqli_fetch_assoc($result);

if ($user['is_admin']=='F') {
    header('location: index.php');
}


if(isset($_GET['plate_id'])) {
    $plate_id = $_GET['plate_id'];
    $result = mysqli_query($conn, "SELECT * FROM `car` WHERE out_of_service = \"F\" AND plate_id=\"$plate_id\"");
    $car = mysqli_fetch_assoc($result);

    if (!isset($car)) {
        echo '<script>';
        echo 'alert("Car with this plate id doesn\'t exist!");';
        echo 'window.location = "index.php"';
        echo '</script>';
    }
} else {
    header('location: index.php');
}
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
</head>
<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">

 
    <style>
        /* Styles pour la section */
.card {
    border: 2px solid #ccc; /* Bordure */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
    padding: 20px; /* Espacement intérieur pour le contenu */
    margin-bottom: 50px;
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
/* Style pour l'image */
.img-fluid {
    max-width: 100%; /* Largeur maximale de l'image */
    height: auto; /* Hauteur automatique pour maintenir les proportions */
}

    </style>
</div>


    <div class="inner">
        <section>
            <h2 id="titre">Editer la voiture </h2>
            <div class="row">
                <div class="col-md-6">
             <div class="card text-center" style="margin-top:10px;padding:50px;background: transparent">
                <form class="form-inline" method="post" name="myForm" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <?php
                            echo '<input type="text" name="model" class="form-control" id="model" value="'.$car["model"].'">';
                        ?>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <?php
                            echo '<input type="number" onkeypress="return event.charCode >= 48" min="1" name="year" class="form-control" id="year" value="'.$car["year"].'">';
                        ?>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <?php
                            echo '<input type="text" name="color" class="form-control" id="color" value="'.$car["color"].'">';
                        ?>     
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="automatic" id="automatic">
                            <?php
                                if ($car["automatic"] == "T") {
                                    echo '<option value="T" selected>Automatic</option>';
                                    echo '<option value="F">Manuelle</option>';
                                } else {
                                    echo '<option value="T">Automatique</option>';
                                    echo '<option value="F" selected>Manual</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="tank_capacity" style="padding-right: 10;">Réservoir</label>
                        <?php
                            echo '<input type="number" onkeypress="return event.charCode >= 48" min="1" name="tank_capacity" class="form-control" id="tank_capacity" value="'.$car["tank_capacity"].'">';
                        ?>     
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="power" style="padding-right: 10;">Puissance</label>
                        <?php
                            echo '<input type="number" onkeypress="return event.charCode >= 48" min="1" name="power" class="form-control" id="power" value="'.$car["power"].'">';
                        ?>     
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="price" style="padding-right: 10;">Prix</label>
                        <?php
                            echo '<input type="number" onkeypress="return event.charCode >= 48" min="1" name="price" class="form-control" id="price" value="'.$car["price"].'">';
                        ?>     
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="location" id="location">
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM `location`");
                                $locations = Array();
                                while($row = mysqli_fetch_assoc($result)){
                                    $locations[] = $row['loc'];
                                }
                                foreach ($locations as &$location) {
                                    if ($location == $car["loc"]) {
                                        echo "<option value=\"$location\" selected>$location</option>";
                                    } else {
                                        echo "<option value=\"$location\">$location</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" value="Editer "/>
                </form>
            </div>
                </div>
          <div class="col-md-6">
            <div class="card text-center" style=" margin-top:9px;padding:50px; background: transparent;">
                <?php
                echo '<img src="images/'.$car["img"].'" class="img-fluid" alt="" style="max-width: 95%; height: auto;">';
                ?>
            </div>
        </div>
            </div>
          
        </section>
    </div>


</div>

<?php include 'scripts.php';?>
<?php
if (isset($_POST['submit'])) {

    $current_date = date("Y-m-d");

    $query = "SELECT * FROM `reservation` WHERE plate_id = '$plate_id' AND ('$current_date' < return_time)";
    $result = mysqli_query($conn, $query);
    $output = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) != 0) {
        echo '<script>';
        echo 'alert("vous ne pouvez pas changer le statut de la voiture ")';
        echo '</script>';
        echo '<script>';
        echo 'window.location = "car_catalog.php"';
        echo '</script>';
    }
    else {
        $model = $_POST['model'];
        $year = $_POST['year'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $tank_capacity = $_POST['tank_capacity'];
        $power = $_POST['power'];
        $isAutomatic = $_POST['automatic'];
        $location = $_POST['location'];
        $img = $_POST['img'];
        $out_of_service = 'F';
        
        $query = "UPDATE `car` SET model='$model', year='$year', price='$price', color='$color', power='$power', automatic='$isAutomatic', tank_capacity='$tank_capacity', loc='$location' WHERE plate_id='$plate_id'";
        $result = mysqli_query($conn, $query);


        echo '<script>';
        if (mysqli_affected_rows($conn) > 0) {
            echo 'alert("La voiture a été mise a jour avec succés!");';
            echo 'window.location = "index.php"';
        } else {
            echo 'alert("Error: La voiture n\'a pas été mise a jour!\n'.mysqli_error($con).'");';
        }
        echo '</script>';
    }
}

$conn->close();

?>
    <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>
</body>
</html>
