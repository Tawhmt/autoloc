<?php
include 'backbone.php';
include 'redirectNotLoggedIn.php';

$conn = $_SESSION['conn'];
$ssn = $_SESSION['ssn'];

$result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn'");
$user = mysqli_fetch_assoc($result);

if ($user['is_admin'] == 'F') {
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
    <style>
section {
  text-align: center;
  padding: 50px 0;


}

.card {
  border-radius: 10px;
  border: 1px solid #ccc; /* Bordure grise de 1 pixel */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
  padding: 20px; /* Espacement intérieur pour le contenu */
 

}

.form-group {
  margin-bottom: 10px;


}

.form-control {

  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
}

/* Style pour les labels */
label {
  display: inline;
  font-weight: bold;
  margin: 5px;

}

/* Style pour les inputs type "date" */
input[type="date"] {

  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
  margin-top: 5px;
}

/* Style pour les select */
select {
  width: 100%;
  padding: 5px;
  border: 1px solid #ced4da;
  border-radius: 5px;
}

/* Style pour les options du select */
select option {
  padding: 5px;
  border: 1px solid #ced4da;
  border-radius: 5px;
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


#titre{
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}
.form-inline {
  display: flex;
  flex-wrap: wrap;
}
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
}
    </style>

<div id="wrapper">
    <div class="inner">
        <h2 id="titre">Recherche</h2>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM `car`");
        $models = array();
        $colors = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $models[] = strtolower($row['model']);
            $colors[] = strtolower($row['color']);
        }

        $result = mysqli_query($conn, "SELECT * FROM `location`");
        $locations = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $locations[] = $row['loc'];
        }
        ?>

        <div class="card">
            
        <section>
            <form class="form-inline" method="post" name="myForm" action="">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="plate_id" class="form-control" id="plate_id" placeholder="Plate ID">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="model" id="model">
                        <option value="" disabled selected hidden>Modèle</option>
                        <?php
                        foreach (array_unique($models) as &$model) {
                            echo "<option value=\"$model\">$model</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="year"
                           class="form-control" id="year" placeholder="Année">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_price"
                           class="form-control" id="min_price" placeholder="Prix max">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="max_price"
                           class="form-control" id="max_price" placeholder="Prix min">
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
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_power"
                           class="form-control" id="min_power" placeholder="Puissance min">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="min_capacity"
                           class="form-control" id="min_capacity" placeholder="Capacité min">
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
                <div class="form-group mx-sm-3 mb-2">
                    <label for="cur_state">Date statut</label>
                    <input type="date" name="cur_state" class="form-control" id="cur_state"
                           placeholder="Statut acctuel">
                </div>
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Search"/>
            </form>
        </section>
        </div>
        <br>
        <h2 id="titre">Voitures </h2>
        <section>
            <div style="overflow-x:auto;width:100%;height:500px">
                <table>
                    <thead>
                    <th style="text-align: center;">Plaque d'immatriculation</th>
                    <th style="text-align: center;">Modèle</th>
                    <th style="text-align: center;">Année</th>
                    <th style="text-align: center;">Statut</th>
                    < <th style="text-align: center;">Prix</th>
                    <th style="text-align: center;">Couleur</th>
                    <th style="text-align: center;">Puissance</th>
                    <th style="text-align: center;">Automatique</th>
                    <th style="text-align: center;">Capacité réservoir</th>
                    <th style="text-align: center;">Location</th>
                    </thead>
                    <?php
                    if (isset($_POST['submit'])) {
                        $result = "SELECT * FROM `car` WHERE 1";
                        if ($_POST["plate_id"] != "") {
                            $result = $result . " AND plate_id = \"" . $_POST["plate_id"] . "\"";
                        }
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
                        if ($_POST["cur_state"] != "") {
                            $temp = $result . " AND plate_id not in (SELECT plate_id FROM car_status WHERE (\"" . $_POST["cur_state"] . "\" BETWEEN out_of_service_start_date and out_of_service_end_date) or (\"" . $_POST["cur_state"] . "\" >=out_of_service_start_date AND out_of_service_end_date is null))";
                            $result = $result . " AND plate_id in (SELECT plate_id FROM car_status WHERE (\"" . $_POST["cur_state"] . "\" BETWEEN out_of_service_start_date and out_of_service_end_date) or (\"" . $_POST["cur_state"] . "\" >=out_of_service_start_date AND out_of_service_end_date is null))";
                        }
                        $result = mysqli_query($conn, $result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">" . $row["plate_id"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["model"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                            $status = "Disponible";
                            if ($row["out_of_service"] == 'T' || $_POST["cur_state"] != "") {
                                $status = "Hors service";
                            }
                            echo "<td style=\"text-align: center;\">" . $status . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["power"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["automatic"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["tank_capacity"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["loc"] . "</td>";
                            echo "</tr>";
                        }
                        if ($_POST["cur_state"] != "") {
                            $result = mysqli_query($conn, $temp);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style=\"text-align: center;\">" . $row["plate_id"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["model"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                                $status = "Disponible";
                                echo "<td style=\"text-align: center;\">" . $status . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["power"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["automatic"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["tank_capacity"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["loc"] . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </section>
    </div>

    <?php include 'scripts.php'; ?>
    <?php include 'footer.php'; ?>

</body>
</html>