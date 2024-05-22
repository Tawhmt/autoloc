<?php include 'backbone.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Auto Loc</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <link rel="icon" type="imag/png" href="images/logo 1.png">
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
<div class="banner-promotion">
  <p>Offre spéciale ! Réduction de 20% sur votre prochaine location de voiture.</p>
  <a href="login.php" class="btn-promotion">Réservez maintenant</a>
</div> 

<div class="benefits-section">
  <h2>Les avantages de la location avec nous</h2>
  <div class="benefits-container">
    <div class="benefit">
      <img src="images/temps.avif" alt="Économisez du temps">
      <h3>Économisez du temps</h3>
      <p>Évitez les tracas des transports en commun et des horaires de bus en louant une voiture.</p>
    </div>
    <div class="benefit">
      <img src="images/porche.png" alt="Flexibilité">
      <h3>Flexibilité</h3>
      <p>Explorez à votre rythme et découvrez des endroits hors des sentiers battus.</p>
    </div>
    <div class="benefit">
      <img src="images/camaro.avif" alt="Voitures de qualité">
      <h3>Voitures de qualité</h3>
      <p>Nous offrons une flotte de véhicules bien entretenus et récents pour votre confort et votre sécurité.</p>
    </div>
  </div>
</div>


 


<div class="testimonial-section">
  <h2>Témoignages de nos clients</h2>
  <div class="testimonials-container">
    <div class="testimonial">
      <p >"J'ai loué une voiture chez <em>Auto Loc </em> pour un voyage en famille et j'ai été impressionnée par la qualité du service et la fiabilité du véhicule. Je recommande vivement !"</p>
      <p class="client-name">- Larab Dounia </p>
    </div>
    <div class="testimonial">
      <p>"Excellent service client et voitures bien entretenues. J'utilise toujours <em>Auto Loc </em> pour mes voyages d'affaires et je n'ai jamais été déçu."</p>
      <p class="client-name">- Haddadou Lina  </p>
     
    </div>
    <div class="testimonial">
      <p>"Je suis très satisfaite de mon expérience avec <em>Auto Loc </em>. Le processus de location était simple et rapide, et le personnel était très serviable."</p>
      <p class="client-name">- Maibeche Louisa </p>
    </div>

  </div>
</div>




<style>
  .banner-promotion {
  background-color: white; /* Couleur de fond de la bannière */
  color: black; /* Couleur du texte */
  padding: 20px;
  text-align: center;
}

.btn-promotion {
  background-color: #3b4146; /* Couleur de fond du bouton */
  color: white; /* Couleur du texte du bouton */
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  display: inline-block;
  margin-top: 10px;
  animation: zoom 3s infinite alternate linear; /* Animation de zoom constante */

}


@keyframes zoom {
  from {
    transform: scale(1);
  }
  to {
    transform: scale(1.1);
  }
}

.btn-promotion:hover {
  background-color:  #3b4146;/* Couleur de fond du bouton au survol */
  color: white; /* Couleur du texte du bouton au survol */
  text-decoration: none;
  box-shadow: 1px 1px 8px 1px black;

  
}
.testimonial-section {
  text-align: center;
  padding: 20px; /* Ajout de padding pour plus d'espace autour de la section */
}

.testimonials-container {
  display: flex; /* Utilisation de flexbox */
  justify-content: center; /* Centrer les éléments horizontalement */
}

.testimonial {
  margin: 0 10px; /* Marge entre les témoignages */
  background-color: #ffffff; /* Changement de la couleur de fond */
  padding: 30px; /* Augmentation du padding pour plus d'espace à l'intérieur */
  border-radius: 15px; /* Augmentation du rayon de la bordure */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  max-width: 400px; /* Limiter la largeur du témoignage */
}

.testimonial p {
  font-size: 15px; /* Augmentation de la taille de la police */
  line-height: 1.5; /* Espacement des lignes amélioré pour une meilleure lisibilité */
  margin-bottom: 20px; /* Augmentation de la marge inférieure */
}

.client-name {
  font-style: italic;
  font-weight: bold;
  font-size: 18px; /* Augmentation de la taille de la police */
  margin-top: 20px;
  color: #333333; /* Changement de la couleur du texte */
}.card {
  border: 1px solid #ccc; /* Bordure grise pour les cartes */
  border-radius: 8px; /* Coins arrondis */
  transition: box-shadow 0.3s ease; /* Animation de transition pour l'ombre */
}

.card:hover {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre légère au survol */
}

.card-title {
  font-size: 20px; /* Taille de police pour le titre */
}/* Styles pour la section des avantages de la location */

.benefits-section {
  padding: 50px 0;
  text-align: center;
}

.benefits-section h2 {
  margin-bottom: 30px;
  font-size: 2rem;
}

.benefits-container {
  display: flex;
  justify-content: space-around;
  align-items: flex-start; /* Aligner les éléments en haut */
  flex-wrap: wrap;
}

.benefit {
  width: 300px;
  margin-bottom: 20px;
  text-align: center;
}

.benefit img {
  width: 100px; /* Taille des images */
  height: 100px; /* Taille des images */
  margin-bottom: 20px;
}

.benefit h3 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

.benefit p {
  font-size: 1rem;
}




</style>


    </div>
    <?php include 'footer.php'; ?>
    <?php include 'scripts.php';?>
</body>
</html>