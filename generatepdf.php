<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once 'connexionbdd.php';

// Récupérer le SSN de la session
$ssn = $_SESSION['ssn'];

// Requête SQL pour récupérer les informations sur la réservation
$sql = "SELECT 
            u.ssn as id_client,
            u.fname AS first_name,
            u.lname AS last_name,
            r.plate_id,
            c.model,
            c.year,
            c.color,
            c.automatic,
            c.price,
            r.reservation_number,
            r.reservation_time,
            r.pickup_location,
            r.return_location,
            r.pickup_time,
            r.return_time
        FROM 
            reservation r
        INNER JOIN 
            user u ON r.ssn = u.ssn
        INNER JOIN 
            car c ON r.plate_id = c.plate_id";
      
// Préparer la requête



$query = $baseautoloc->query($sql);
$reservations = $query->fetchAll();
//var_dump($reservations);

// Mettre en mémoire tampon la sortie
ob_start();

// Inclure le contenu du PDF
require_once 'contenupdf.php';

// Récupérer le contenu mis en mémoire tampon
$html = ob_get_clean();

// Inclure l'autoloader de Dompdf après avoir récupéré le contenu
require_once 'dompdf/autoload.inc.php';

// Instancier la classe Dompdf avec les options
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier'); // Définir la police par défaut
$dompdf = new Dompdf($options);

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// Définir la taille et l'orientation du papier
$dompdf->setPaper('A4', 'portrait');

// Rendre le PDF
$dompdf->render();

// Nom du fichier PDF à télécharger
$fichier = 'contrat.pdf';

// Afficher le PDF directement dans le navigateur
$dompdf->stream($fichier);
?>
