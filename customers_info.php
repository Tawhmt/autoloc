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
<div class="card">
<section>
            <form class="form-inline" method="post" name="myForm" action="">
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
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="min_birthdate">Date de naissance</label>
                    <input type="date" name="min_birthdate" class="form-control" id="min_birthdate"
                           placeholder="Min. Birth date">
                </div>
              
                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Recherche"/>
            </form>
        </section>
</div>

        <h2 id="titre" style="margin-top:50px;">Clients</h2>
        <section>
            <div style="overflow-x:auto;width:100%;height:500px">
                <table>
                    <thead>
                    <th style="text-align: center;">ID carte d'identité </th>
                    <th style="text-align: center;">Nom</th>
                    <th style="text-align: center;">Prénom</th>
                    <th style="text-align: center;">Téléphone</th>
                    <th style="text-align: center;">Emaill</th>
                    <th style="text-align: center;">Sex</th>
                    <th style="text-align: center;">Date de naissance</th>
                    </thead>
                    <?php
                    if (isset($_POST['submit'])) {
                        $result = "SELECT * FROM `user` WHERE is_admin = 'F'";
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
                        if ($_POST["min_birthdate"] != "") {
                            $result = $result . " AND birthdate >= \"" . $_POST["min_birthdate"] . "\"";
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
                            echo "<td style=\"text-align: center;\">" . $row["birthdate"] . "</td>";
                            echo "</tr>";
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