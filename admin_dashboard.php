<?php include 'backbone.php' ?>
<?php
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
<br>
<br>
<style>
    .card {
    border: 2px solid #ccc; /* Bordure */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
    padding: 20px; /* Espacement intérieur pour le contenu */
    margin-bottom: 50px;
}
.btn-primary {
    background-color: grey; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte du bouton */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    width: 80%; /* Définir la largeur à 100% */
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
</style>
<div class="card">
    
<form class="form-inline" method="post" name="myForm0" action="" onsubmit="return validateLocationBranchForm();">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="location0" class="form-control" id="location0" placeholder="Location" required>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="branch0" class="form-control" id="branch0" placeholder="Branche" required>
    </div>
    <input type="submit" name="submit0" class="btn btn-primary " value="Ajouter une nouvelle branche et location "/>
</form>
<br>
<br>
<form class="form-inline" method="post" name="myForm1" action="" onsubmit="return validateBranchForm();">
    <div class="form-group mx-sm-3 mb-2">
        <select name="location1" id="location1" required>
            <option value="" disabled selected hidden>Location</option>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM `location`");
            $locations = Array();
            while ($row = mysqli_fetch_assoc($result)) {
                $locations[] = $row['loc'];
            }
            foreach ($locations as &$location) {
                echo "<option value=\"$location\">$location</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="branch1" class="form-control" id="branch1" placeholder="Branch" required>
    </div>
    <input type="submit" name="submit1" class="btn btn-primary " value="Ajouter une nouvelle branche "/>
</form>

</div>
<div class="inner">
    <br><br>
    <div>
        <h2 id="titre">Voiture disponibles</h2>
        <section class="tiles">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM `car` WHERE out_of_service = 'F'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<article class=\"style1\">";
                echo "<span class=\"image\">";
                echo "<img src=\"images/" . $row["img"] . "\" alt=\"\"/>";
                echo "</span>";
                echo "<a href=\"car_status.php?plate_id=" . $row["plate_id"] . "\">";
                echo "<h2>" . $row["model"] . " " . $row["year"] . "</h2>";
                echo "<p>Price: <strong>" . $row["price"] . "</strong> per day</p>";
                echo "<div class=\"content\">";
                if($row['automatic'] === 'T') {
                    $type = "Automatic";
                } else {
                    $type = "Manual";
                }
                echo "<p>Type: <strong>". $type . "</strong></p>";
                echo "</div>";
                echo "</a>";
                echo "</article>";
            }
            ?>
        </section>
    </div>
    <br>
    <div>
        <h2 id="titre">Voitures hors service </h2>
        <section class="tiles">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM `car` WHERE out_of_service = 'T'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<article class=\"style1\">";
                echo "<span class=\"image\">";
                echo "<img src=\"images/" . $row["img"] . "\" alt=\"\"/>";
                echo "</span>";
                echo "<a href=\"car_status.php?plate_id=" . $row["plate_id"] . "\">";
                echo "<h2>" . $row["model"] . " " . $row["year"] . "</h2>";
                echo "<p>Price: <strong>" . $row["price"] . "</strong> per day</p>";
                echo "<div class=\"content\">";
                echo "<p>Tank capcity: <strong>" . $row["tank_capacity"] . "</strong> per day</p>";
                echo "</div>";
                echo "</a>";
                echo "</article>";
            }
            ?>
        </section>
    </div>
</div>

<?php include 'scripts.php'; ?>
<?php

if (isset($_POST['submit0'])) {
    $loc = $_POST['location0'];
    $branch = $_POST['branch0'];
    $result = mysqli_query($conn, "SELECT * FROM `location` where LOWER(loc) = LOWER('$loc')");
    $locResult = mysqli_fetch_assoc($result);
    if ($locResult) { // if location exists
        echo '<script>';
        echo 'alert("Location existe déja !");';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
    } else {
        $query = "INSERT INTO `location` (loc) VALUES('$loc')";
        $result = mysqli_query($conn, $query);
        $query = "INSERT INTO `branch` (loc,branch_name) VALUES('$loc','$branch')";
        $result = mysqli_query($conn, $query);

        echo '<script>';
        echo 'alert("Location et branche ajoutées avec succés ")';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
        exit();
    }
}

if (isset($_POST['submit1'])) {
    $loc = $_POST['location1'];
    $branch = $_POST['branch1'];

    $result = mysqli_query($conn, "SELECT * FROM `branch` where LOWER(branch_name) = LOWER('$branch') AND LOWER(loc) = LOWER('$loc')");
    $branchResult = mysqli_fetch_assoc($result);
    if ($branchResult) { // if branch exists
        echo '<script>';
        echo 'alert("Branche existe déja !");';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
    } else {
        $query = "INSERT INTO `branch` (loc,branch_name) VALUES('$loc','$branch')";
        $result = mysqli_query($conn, $query);

        echo '<script>';
        echo 'alert("Branche ajoutée avec succés")';
        echo 'window.location = "admin_dashboard.php"';
        echo '</script>';
        exit();
    }
}
?>
 <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>
</body>
</html>