<?php include 'backbone.php'; ?>
<?php include 'redirectLoggedIn.php'; ?>
<!DOCTYPE html>
<html lang="en">
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
<body>

<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <br>
    <br>
</div>
<div class="overlay"></div>
<div class="container">
    <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
        <div class="col-lg-8 ftco-animate">
            <div class="text w-100 text-center mb-md-5 pb-md-5 px-2">
                <h1 class="mb-4">Connectez-vous pour rejoindre le moyen le plus rapide et le plus simple de louer une voiture</h1>
                <div class="card text-center" style="margin:10px;padding: 50px;background: transparent">
                    <form class="form-inline" method="post" name="myForm" action=""
                          onsubmit="return validateLoginForm()">

                        <div class="form-group mx-sm-3 mb-2">
                            <label for="Email" class="sr-only">Email</label>
                            <input type="email" name="Email" class="form-control" id="Email" placeholder="Email">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="Password" class="sr-only">Mot de passe </label>
                            <input type="password" name="Password" class="form-control" id="Password"
                                   placeholder="Password">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary mb-2 cent" value="Se connecter ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<style>
    /* Styles pour le bouton "Se connecter" */
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

/* Style pour supprimer l'outline bleue et l'ombre bleue autour des champs de formulaire */
input:focus, select:focus {
  outline: none !important;
  box-shadow: none !important;
}
h1 {
  font-size: 32px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  font-family: Arial, sans-serif; /* Police de caractères */
  font-weight: bold; /* Gras */
  text-align: center; /* Alignement du texte */
  margin-bottom: 20px; /* Marge en bas */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Ombre de texte */
}
/* Style pour la section de connexion */
.card {
  border: 3px solid #ccc; /* Bordure grise de 1 pixel */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
  padding: 20px; /* Espacement intérieur pour le contenu */
  border-radius: 10px;
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

if (isset($_POST['submit'])) {
    // receive all input values from the form

    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ((($password) == $user['password']) && $user) {
        $_SESSION['ssn'] = $user['ssn'];

        echo '<script>';
        echo 'window.location = "index.php"';
        echo '</script>';
        exit();
    } else {
        echo '<script>';
        echo 'alert("Check email or password");';
        echo 'window.location = "login.php"';
        echo '</script>';
    }
}
mysqli_close($conn);
?>
  <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>


</body>
</html>