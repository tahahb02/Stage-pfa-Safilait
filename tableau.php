<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="image/jibal.jpg">
    <title>Liste des Commandes</title>

    <!-- Add FontAwesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--style CSS de la page-->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            margin-right: 5px;
        }

        /*navbar*/
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 100px;
            background: rgb(0, 0, 0);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .logo {
            font-size: 32px;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-family: "Poppins", sans-serif;
            transition: color 0.3s ease;
            margin-right: 900px;
        }

        .logo:hover {
            color: #ff6600;
        }

        .navbar {
            flex-grow: 1;
        }

        .navbar a {
            position: relative;
            font-size: 18px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar a:hover {
            color: #ff6600;
            transform: scale(1.1);
        }

        main {
            margin-top: 80px;
        }

        .icon-deco {
            color: white;
            font-size: 40px;
            transform: scale(1.5);
            display: inline-block;
        }
    </style>
</head>
<body>
<header class="header">
    <a href="#" class="logo">SAFILAIT</a>
    <nav class="navbar">
        <a href="#">Se deconnecter</a>
        <a href="admin_agent_conn.php" class="icon-deco"><i class="fas fa-sign-out-alt"></i></a>
    </nav>
</header>
<br>
<br>
<br>
<br>
<br>
<h1>Liste des Commandes</h1>
<table>
    <thead>
        <tr>
            <th>Numéro de Commande</th>
            <th>Nom du Client</th>
            <th>Prénom du Client</th>
            <th>Article Commandé</th>
            <th>Numéro de Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Établir une connexion à la base de données (personnalisez les informations de connexion)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "daba";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die('La connexion a échoué : ' . mysqli_connect_error());
    }

    // Écrivez une requête SQL pour sélectionner les données de la table (personnalisez la requête)
    $sql = "SELECT numero_commande, nom, prenom, taureau, numero_telephone FROM formulaire";

    // Exécutez la requête SQL
    $result = mysqli_query($conn, $sql);

    // Récupérez les données et générez les lignes du tableau HTML
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['numero_commande'] . '</td>';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['prenom'] . '</td>';
        echo '<td>' . $row['taureau'] . '</td>';
        echo '<td>' . $row['numero_telephone'] . '</td>';
        echo '<td>';
        echo '<button onclick="confirmerCommande(' . $row['numero_commande'] . ')"><i id="icon_' . $row['numero_commande'] . '" class="fas fa-shopping-cart"></i></button>';
        echo '<button onclick="supprimerCommande(' . $row['numero_commande'] . ')"><i class="fas fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }

    // Libérez les ressources et fermez la connexion à la base de données
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
    </tbody>
</table>

<!-- JavaScript for confirmation button with FontAwesome -->
<script>
    function supprimerCommande(numero_commande) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
            // Utilisez une requête Ajax pour supprimer la commande côté serveur
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // La suppression a réussi, actualisez la page ou effectuez d'autres actions nécessaires
                        window.location.reload(); // Actualisez la page actuelle
                    } else {
                        // La suppression a échoué, affichez un message d'erreur ou effectuez d'autres actions nécessaires
                        alert('Erreur lors de la suppression de la commande.');
                    }
                }
            };
            xhr.open('GET', 'supprimer_commande.php?numero_commande=' + numero_commande, true);
            xhr.send();
        }
    }

    function confirmerCommande(numero_commande) {
    var iconElement = document.getElementById('icon_' + numero_commande);

    if (iconElement.classList.contains('fa-shopping-cart')) {
        var prix = prompt('Veuillez saisir le prix pour confirmer la commande :');

        if (prix !== null && prix !== "") {
            if (confirm('Êtes-vous sûr de vouloir confirmer cette commande ?')) {
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText); // Affichez la réponse du serveur
                            // Changez l'icône en icône de coche (icône pour confirmé)
                            iconElement.classList.remove('fa-shopping-cart');
                            iconElement.classList.add('fa-check-circle');
                        } else {
                            alert('Erreur lors de la confirmation de la commande.');
                        }
                    }
                };

                // Envoyez les données (numéro_commande et prix) à la page enregistrer_commande.php
                xhr.open('GET', 'enregistrer_commande.php?numero_commande=' + numero_commande + '&prix=' + prix, true);
                xhr.send();
            }
        } else {
            alert('Veuillez saisir le prix avant de confirmer la commande.');
        }
    }
}

</script>
</body>
</html>
