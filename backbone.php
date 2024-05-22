<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto loc";

// Creation de connexion
$conn = new mysqli($servername, $username, $password, $dbname);
// verifier la connexion
if ($conn->connect_error) {
    die("Connexion éronnée: " . $conn->connect_error);
}
$_SESSION['conn'] = $conn;
?>
<!-- Header -->
<header id="header">
    <div class="inner">

        <!-- Logo -->
     

        <!-- Nav -->
        <nav>
            <ul>
                <li><a href="#menu">Menu</a></li>
            </ul>
        </nav>

    </div>
</header>

<!-- Menu -->
<nav id="menu">

    <ul class="navbar-nav ml-auto">
    <img src="images/logo 1.png" alt="" class="logo">
    <li class="nav-item"><a href="index.php" class="nav-link">Acceuil</a></li>
    <li class="nav-item"><a href="blog.php" class="nav-link">Blog de voyage </a></li>
      <li class="nav-item"><a href="car_catalog.php" class="nav-link">Catalogue</a></li>
      <?php
    if (isset($_SESSION['ssn'])) {
        $ssn = $_SESSION['ssn'];
        $result = mysqli_query($conn, "SELECT * FROM `user` WHERE ssn ='$ssn'");
        $user = mysqli_fetch_assoc($result);
        $is_admin = $user['is_admin'];
    } else {
        $is_admin='F';
    }

    if (!isset($_SESSION['ssn'])) { ?>
        <li class="nav-item"><a href="login.php" class="nav-link">Se connecter </a></li>
        <li class="nav-item"><a href="register.php" class="nav-link">S'inscrire</a></li>
    <?php } else { ?>
        <?php if ($is_admin == 'T') { ?>
            <li class="nav-item"><a href="register_car.php" class="nav-link">Ajouter une voiture</a></li>
            <li class="nav-item"><a href="reservations_info.php" class="nav-link">Réservations</a></li>
            <li class="nav-item"><a href="admin_dashboard.php" class="nav-link">Tableau de bord Admin</a></li>
            <li class="nav-item"><a href="cars_info.php" class="nav-link">Information sur les voitures </a></li>
            <li class="nav-item"><a href="customers_info.php" class="nav-link">Information des clients </a></li>
            <li class="nav-item"><a href="generatepdf.php" class="nav-link">Génerer contrat</a></li>
            <li class="nav-item"><a href="destroy.php" class="nav-link">Se déconnecter</a></li> <!-- Déplacé ici -->
        <?php } else { ?>
            <li class="nav-item"><a href="user_reservations.php" class="nav-link">Réservations</a></li>
            <li class="nav-item"><a href="payment.php" class="nav-link">Paiement</a></li>
            <li class="nav-item"><a href="destroy.php" class="nav-link">Se déconnecter</a></li> <!-- Déplacé ici -->
        <?php } ?>
    <?php } ?>



    </ul>
</nav>

<!-- Main -->
<div id="main" >
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 " src="images/carusel4.jpg" alt="First slide"
                            style="height: 600px; object-fit: fill;">
                        <div class="carousel-caption  d-none d-md-block">
                            <h5 class="hcarousel" style="color:#fba104;font-weight: bold;">Auto Loc</em></h5>



                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 " src="images/carou1.avif" alt="Second slide"
                            style="height: 600px; object-fit: fill;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Explorez notre gamme de véhicules</h5>
                            <hr>
                            <p>Inscrivez-vous pour découvrir nos services de location de voitures.</p>
                            <hr>
                            <a href="register.php"><button type="button" class="btncarousel"
                                    style="border: 1px solid #ffffff; background-color: transparent; color: #ffffff !important;">S'inscrire
                </button></a>
                        </div>
                    </div>

                </div>

                <!-- <div class="carousel-item">
                    <img class="d-block w-100 " src="images/slider-image-3-1920x700.jpg" alt="Third slide" style="height: 600px; object-fit: fill;">
                </div> -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

   