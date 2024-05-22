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
  margin-bottom: 50px;

}

.form-group {
  margin-bottom: 20px;
  flex: 0 0 50%; /* Mettre chaque champ à 50% de la largeur */
  padding: 0 10px; /* Ajouter de l'espacement horizontal entre les champs */
  box-sizing: border-box; /* Inclure le padding dans la largeur */
}

.form-control {
  width: 50%;
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
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
}

/* Style pour les options du select */
select option {
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
}
.btn-primary {
    background-color: grey; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte du bouton */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin-top:50px;
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

#titre{
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}
#sex {
  width: 10%; /* Ajustement de la largeur */
}

#payment_end_date {
  width: 100%; /* Ajustement de la largeur à 100% */
  padding: 10px; /* Ajouter un padding */
  margin-top: 5px; /* Ajustement de la marge supérieure */
  box-sizing: border-box; /* Inclure le padding dans la largeur */
  display: block; /* Afficher en tant que bloc */
}
.form-inline {
  display: flex;
  flex-wrap: wrap;
}
</style>
<div id="wrapper">
    <div class="inner">
        <br>
        <h2 id="titre">Recherche de réservations</h2>
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
                    <input type="text" name="plate_id" class="form-control" id="plate_id" placeholder="Plaque immatriculation">
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
                           class="form-control" id="min_price" placeholder="Prix min ">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="max_price"
                           class="form-control" id="max_price" placeholder="Prix max">
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
                           class="form-control" id="min_capacity" placeholder="Capacité min ">
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
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="Nom">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Prénom">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="number" onkeypress="return event.charCode >= 48" min="1" name="phone"
                           class="form-control" id="phone" placeholder="Téléphhone">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select name="sex" id="sex">
                        <option value="" disabled selected hidden>Male/Femelle</option>
                        <option value="M">Male</option>
                        <option value="F">Femelle</option>
                    </select>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="min_reservation_date">Min Reservation date</label>
                    <input type="date" name="min_reservation_date" class="form-control" id="min_reservation_date"
                           placeholder="Min. Reservation date">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="max_reservation_date">Max Reservation Date</label>
                    <input type="date" name="max_reservation_date" class="form-control" id="max_reservation_date"
                           placeholder="Max. Reservation date">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="payment_start_date">Date de paeiment </label>
                    <input type="date" name="payment_start_date" class="form-control" id="payment_start_date"
                           placeholder="Payment Start date">
                </div>
               
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Recherche"/>
            </form>
        </section>
</div>
        
        <h2 id="titre" style="margin-top:50px;">Tableau de réservations</h1>
        <section>
            <div style="overflow-x:auto;width:100%;height:500px">
                <table>
                    <thead>
                    <th style="text-align: center;">ID carte d'identité </th>
                    <th style="text-align: center;">Prénom</th>
                    <th style="text-align: center;">Nom</th>
                    <th style="text-align: center;">Téléphone</th>
                    <th style="text-align: center;">Emaill</th>
                    <th style="text-align: center;">Sex</th>
                    <th style="text-align: center;">Plaque d'immatriculation</th>
                    <th style="text-align: center;">Modèle</th>
                    <th style="text-align: center;">Annéé</th>
                    <th style="text-align: center;">Statut</th>
                    <th style="text-align: center;">Prix</th>
                    <th style="text-align: center;">Couleur</th>
                    <th style="text-align: center;">Puissance</th>
                    <th style="text-align: center;">Automatique/Manuelle</th>
                    <th style="text-align: center;">Capacité réservoir</th>
                    <th style="text-align: center;">Location</th>
                    <th style="text-align: center;">Numéro de reservation</th>
                    <th style="text-align: center;"> Date de Réservation</th>
                    <th style="text-align: center;">Lieu de prise en charge </th>
                    <th style="text-align: center;">Lieu de retour </th>
                    <th style="text-align: center;">Date prise en charge</th>
                    <th style="text-align: center;">Date de retour </th>
                    <th style="text-align: center;">Payé ?</th>
                    <th style="text-align: center;">Payé le </th>
                    </thead>
                    <?php
                    if (isset($_POST['submit'])) {
                        $result = "SELECT * FROM `reservation` NATURAL JOIN `car` NATURAL JOIN `user` WHERE 1";
                        if ($_POST["plate_id"] != "") {
                            $result = $result . " AND plate_id = " . $_POST["plate_id"];
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
                        if ($_POST["fname"] != "") {
                            $result = $result . " AND LOWER(fname) = LOWER(\"" . $_POST["fname"] . "\")";
                        }
                        if ($_POST["lname"] != "") {
                            $result = $result . " AND LOWER(lname) = LOWER(\"" . $_POST["lname"] . "\")";
                        }
                        if ($_POST["phone"] != "") {
                            $result = $result . " AND phone = \"" . $_POST["phone"] . "\"";
                        }
                        if ($_POST["email"] != "") {
                            $result = $result . " AND email = \"" . $_POST["email"] . "\"";
                        }
                        if (isset($_POST["sex"])) {
                            $result = $result . " AND sex = \"" . $_POST["sex"] . "\"";
                        }
                        if ($_POST["min_reservation_date"] != "") {
                            $result = $result . " AND pickup_time >= \"" . $_POST["min_reservation_date"] . "\"";
                        }
                        
                        if ($_POST["max_reservation_date"] != "") {
                            $result = $result . " AND return_time <= \"" . $_POST["max_reservation_date"] . "\"";
                        }
                       
                        if ($_POST["payment_start_date"] != "") {
                            $result = $result . " AND paid_at >= \"" . $_POST["payment_start_date"] . "\"";
                        }
                      
                        $result = mysqli_query($conn, $result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">" . $row["ssn"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["fname"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["lname"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["phone"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["email"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["sex"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["plate_id"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["model"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["year"] . "</td>";
                            $status = "Disponible";
                            if ($row["out_of_service"] == 'T') {
                                $status = "Hors service ";
                            }
                            echo "<td style=\"text-align: center;\">" . $status . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["price"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["color"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["power"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["automatic"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["tank_capacity"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["loc"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["reservation_number"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["reservation_time"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["pickup_location"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["return_location"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["pickup_time"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["return_time"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["is_paid"] . "</td>";
                            echo "<td style=\"text-align: center;\">" . $row["paid_at"] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </section>
        <br>
        <h2 id="titre">Table de paeiment </h2>
        <section>
            <div style="overflow-x:auto;width:100%;height:500px">
                <table>
                    <thead>
                    <th style="text-align: center;">Jour</th>
                    <th style="text-align: center;">Paeiment total par jour</th>
                    </thead>
                    <?php
                    if (isset($_POST['submit'])) {
                        $res = "SELECT paid_at,SUM(price* (DATEDIFF(return_time, pickup_time))) AS totaldailypayment FROM car as C inner join reservation as R on C.plate_id=R.plate_id WHERE 1";
                        if ($_POST["payment_start_date"] != "") {
                            $res = $res . " AND paid_at >= \"" . $_POST["payment_start_date"] . "\"";
                        }
                      
                        if ($_POST["payment_start_date"] != "" ) {
                            $res = $res . " AND paid_at is not null GROUP BY paid_at ";
                            $result = mysqli_query($conn, $res);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style=\"text-align: center;\">" . $row["paid_at"] . "</td>";
                                echo "<td style=\"text-align: center;\">" . $row["totaldailypayment"] . "</td>";
                                echo "</tr>";

                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </section>
        <?php include 'scripts.php'; ?>
        <?php include 'footer.php'; ?>

</body>
</html>