<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Location de Voiture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        header, footer {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
        h1 {
            text-align: center;
            font-family: 'Arial Black', sans-serif;
            color: #333;
            text-transform: uppercase;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
       
    </style>
</head>
<body>
    <header>

        <h2><em>Auto Loc</em> </h2>
        <p>Téléphone : +213 5 52 47 14 13 | Email :autoloc@example.com</p>
    </header>
    <main>
        <h1>Contrat de Location de Voiture</h1>
        <?php foreach($reservations as $reservation):?>
            <table>
            <tr>
                    <th>ID carte d'identité</th>
                    <td><?= $reservation['id_client']?></td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td><?= $reservation['first_name']?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><?= $reservation['last_name']?></td>
                </tr>
                <tr>
                    <th>Modèle</th>
                    <td><?= $reservation['model'] ?></td>
                </tr>
                <tr>
                    <th>Année</th>
                    <td><?= $reservation['year'] ?></td>
                </tr>
                <tr>
                    <th>Couleur</th>
                    <td><?= $reservation['color'] ?></td>
                </tr>
                <tr>
                    <th>Automatique</th>
                    <td><?= $reservation['automatic'] ?></td>
                </tr>
                <tr>
                    <th>Prix de location par jour</th>
                    <td><?= $reservation['price'] ?></td>
                </tr>
                <tr>
                    <th>Lieu de Prise en Charge</th>
                    <td><?= $reservation['pickup_location'] ?></td>
                </tr>
                <tr>
                    <th>Lieu de Retour</th>
                    <td><?= $reservation['return_location'] ?></td>
                </tr>
                <tr>
                    <th>Date de Prise en Charge</th>
                    <td><?= $reservation['pickup_time'] ?></td>
                </tr>
                <tr>
                    <th>Date de Retour</th>
                    <td><?= $reservation['return_time'] ?></td>
                </tr>
            </table>
        <?php endforeach;?>
        <div class="signature">
            <p>Signature de l'Administrateur : ________________________________________</p>
            <p>Signature du Client : ________________________________________</p>
        </div>
    </main>
    <footer>
        <p><em>Auto Loc</em> Tous droits réservés © <?= date('Y') ?> . </p>
    </footer>
</body>
</html>
