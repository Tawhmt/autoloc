<?php 
include 'backbone.php';
include 'redirectNotLoggedIn.php';

$conn = $_SESSION['conn'];
$ssn = $_SESSION['ssn'];

$result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn'");
$user = mysqli_fetch_assoc($result);
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
    <style>
        /* Styles pour le formulaire */
.form-inline {
  border: 2px solid #ccc; /* Bordure */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
  padding: 20px; /* Espacement intérieur pour le contenu */
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
    </style>
<!-- Wrapper -->
<div id="wrapper">
    <div class="inner">
        <h2 id="titre">Voitures</h2>
        <?php
            $result = mysqli_query($conn, "SELECT * FROM `car`");
            $colors = Array();
            $models = Array();
            while($row = mysqli_fetch_assoc($result)){
                $models[] = strtolower($row['model']);
                $colors[] = strtolower($row['color']);
            }

            $result = mysqli_query($conn, "SELECT * FROM `location`");
            $locations = Array();
            while($row = mysqli_fetch_assoc($result)){
                $locations[] = $row['loc'];
            }
        ?>

        <section>
            <form class="form-inline" method="post" name="myForm" action="">
                <div class="form-group mx-sm-3 mb-2">
                    <select name="model" id="model">
                        <option value="" disabled selected hidden>Modéle</option>
                        <?php
                            foreach (array_unique($models) as &$model) {
                                echo "<option value=\"$model\">$model</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="year" class="form-control" id="year" placeholder="Année">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_price" class="form-control" id="min_price" placeholder="Prix min">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="max_price" class="form-control" id="max_price" placeholder="Prix max ">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="color" id="color">
                        <option value="" disabled selected hidden>Couleur</option>
                        <?php
                            foreach (array_unique($colors) as &$color) {
                                echo "<option value=\"$color\">$color</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_power" class="form-control" id="min_power" placeholder="Puissance min">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_capacity" class="form-control" id="min_capacity" placeholder="Puissance max">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="location" id="location">
                        <option value="" disabled selected hidden>Location</option>
                        <?php
                            foreach ($locations as &$location) {
                                echo "<option value=\"$location\">$location</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="automatic" id="automatic">
                        <option value="" disabled selected hidden>Automatique/Manuelle</option>
                        <option value="T">Automatique</option>
                        <option value="F">Manuelle</option>
                    </select>
                </div>
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Recherche "/>
            </form>
        </section>
        <section class="tiles">
            <?php
                if (isset($_POST['submit'])) {
                    $result = "SELECT * FROM `car` WHERE out_of_service = \"F\"";
                    if (isset($_POST["model"])) {
                        $result = $result . " AND model = \"" . $_POST["model"] . "\"";
                    }
                    if ($_POST["year"] != "") {
                        $result = $result . " AND year = " . $_POST["year"];
                    }
                    if ($_POST["min_price"] != "") {
                        $result = $result . " AND price >= " . $_POST["min_price"];
                    }
                    if ($_POST["max_price"] != "") {
                        $result = $result . " AND price <= " . $_POST["max_price"];
                    }
                    if (isset($_POST["color"])) {
                        $result = $result . " AND color = \"" . $_POST["color"] . "\"";
                    }
                    if ($_POST["min_power"] != "") {
                        $result = $result . " AND power >= " . $_POST["min_power"];
                    }
                    if ($_POST["min_capacity"] != "") {
                        $result = $result . " AND tank_capacity >= " . $_POST["min_capacity"];
                    }
                    if (isset($_POST["location"])) {
                        $result = $result . " AND loc = \"" . $_POST["location"] . "\"";
                    }
                    if (isset($_POST["automatic"])) {
                        $result = $result . " AND automatic = \"" . $_POST["automatic"] . "\"";
                    }
    
                    $result = mysqli_query($conn, $result);
                } else {
                    $result = mysqli_query($conn, "SELECT * FROM `car` WHERE out_of_service = 'F'");
                };
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<article class=\"style1\">";
                    echo "<span class=\"image\">";
                    echo "<img src=\"images/" . $row["img"] . "\" alt=\"\"/>";
                    echo "</span>";

                    if($user['is_admin'] === 'F') {
                        echo "<a href=\"reservation.php?plate_id=" . $row["plate_id"] . "\">";    
                    } else {
                        echo "<a href=\"edit_car.php?plate_id=" . $row["plate_id"] . "\">";
                    }
            
                    echo "<h2>" . $row["model"] . " " . $row["year"] . "</h2>";
                    echo "<p>Prix: <strong>". $row["price"] . "</strong> par jour</p>";
                    echo "<div class=\"content\">";
                    
                    if($row['automatic'] === 'T') {
                        $type = "Automatique";
                    } else {
                        $type = "Manuelle";
                    }
                    echo "<p>Type: <strong>". $type . "</strong></p>";
                    echo "</div>";
                    echo "</a>";
                    echo "</article>";
                }
            ?>
        </section>

        <br>

    </div>
    <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>

</body>
</html>