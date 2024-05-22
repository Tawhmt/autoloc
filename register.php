<?php include 'redirectLoggedIn.php'; ?>
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

    <!-- Header -->
    <?php include 'backbone.php'; ?>

    <br>
    <br>
</div>

<style>/* Styles pour le formulaire d'inscription */
#titre{
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}


section {
  text-align: center;
  padding: 50px 0;
  box-shadow: 5px 5px 5px 5px black;
}

.card {
  
  border-radius: 10px;
  border: 1px solid #ccc; /* Bordure grise de 1 pixel */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
  padding: 20px; /* Espacement intérieur pour le contenu */
  margin-bottom:50px;
}

.form-group {
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
}


/* Styles pour le bouton d'inscription */
#inscrire {
  background-color: white; /* Couleur de fond du bouton */
  color: white; /* Couleur du texte du bouton */
  padding: auto;
  border-radius: 5px;
  text-decoration: none;
  display: inline-block;
  margin-top: 10px;
  margin-left: 20px; /* Marge à gauche pour éloigner le bouton du champ "Male" */
  display: flex;
  align-items: center;
  justify-content: center;
}

#inscrire:hover {
  background-color: #3b4146; /* Couleur de fond du bouton au survol */
  color: white; /* Couleur du texte du bouton au survol */
  text-decoration: none;
  
}





/* Style pour les labels */
label {
  display: block;
  font-weight: bold;
}

/* Style pour les inputs type "date" */
input[type="date"] {
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
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
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
  border:black !important;
}
/* Animation pour le titre "S'inscrire" */
@keyframes bounce {
  0% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
  100% { transform: translateY(0); }
}

.animate {
  animation: bounce 1s infinite; /* Utilisation de l'animation bounce avec une durée de 1 seconde et en boucle */
}

</style>

    <div class="inner">
        <section>
            <h2 class="animate"id="titre">S'inscrire</h2>
            <div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
                <form class="form-inline" method="post" name="myForm" action=""
                      onsubmit="return validateRegisterForm()">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="Email" class="sr-only">Email</label>
                        <input type="email" name="Email" class="form-control" id="Email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="fName" class="sr-only">Nom</label>
                        <input type="text" name="fName" class="form-control" id="fName"
                               placeholder="Nom">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="lName" class="sr-only">Prénom</label>
                        <input type="text" name="lName" class="form-control" id="lName" placeholder="Prénom">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="Password" class="sr-only">Mot de passe </label>
                        <input type="password" name="Password" class="form-control" id="Password"
                               placeholder="Mot de passe ">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="Confirm" class="sr-only">Confirmer le mot de passe </label>
                        <input type="password" name="Confirm" class="form-control" id="Confirm"
                               placeholder="Confirmer le mot de passe">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="mobile" class="sr-only">Télephone</label>
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="mobile" class="form-control" id="mobile"
                               placeholder="Téléphone">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="ssn" class="sr-only">ID carte d'identité </label>
                        <input type="number" onkeypress="return event.charCode >= 48" min="1" name="ssn" class="form-control" id="ssn"
                               placeholder="ID carte nationale ">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="birthDate" class="sr-only">Date de naissance : </label>
                        <input type="date" name="birthDate" class="form-control" id="birthDate">
                    </div>
                    <div>
                        <label for="sex" class="sr-only">Sex</label>
                        <select name="sex" id="sex">
                            <option value="M">Male</option>
                            <option value="F">Femelle</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mb-2" id="inscrire" value="S'inscrire"/>
                </form>
            </div>
        </section>
    </div>


</div>

<?php include 'scripts.php';?>

<?php
$conn=$_SESSION['conn'];
if (isset($_POST['submit'])) {
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $ssn = $_POST['ssn'];
    $email = $_POST['Email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['Password'];
    $birthdate = $_POST['birthDate'];
    $sex = $_POST['sex'];
    $is_admin = 'F';


    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn = '$ssn' OR email = '$email' OR phone = '$mobile'");
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        echo '<script>';
        echo 'alert("Utilisateur existe deja");';
        echo 'window.location = "register.php"';
        echo '</script>';
    } else {
        $password = $_POST['Password'];

        $query = "INSERT INTO `user` (ssn,fname,lname,phone,email,password,sex,birthdate,is_admin) VALUES
                                                                                         ('$ssn','$fname','$lname','$mobile','$email','$password','$sex','$birthdate','$is_admin')";
        $result = mysqli_query($conn, $query);

        $_SESSION['ssn'] = $_POST['ssn'];

        echo '<script>';
        echo 'alert("User ajouter avec succés ")';
        echo '</script>';

        echo '<script>';
        echo 'window.location = "index.php"';
        echo '</script>';
        exit();
    }
}

$conn->close();
?>
  <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>
</body>
</html>
