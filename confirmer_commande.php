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
    <meta charset="UTF-8">
    <title>Liste des Commandes Validées</title>
</head>
<body>
    <h1>Liste des Commandes Validées</h1>
    <table >
        <thead>
            <tr>
                <th>Numéro de Commande</th>
                <th>Nom du Client</th>
                <th>Prénom du Client</th>
                <th>Taureau Acheté</th>
                <th>Date d'Achat</th>
                <th>Prix d'Achat</th>
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

            // Écrivez une requête SQL pour sélectionner les données de la table "commande_valider"
            $sql = "SELECT num_commande, nom_client, prenom_client, taureau_acheter, date_achat, prix_achat FROM commande_valider";

            // Exécutez la requête SQL
            $result = mysqli_query($conn, $sql);

            // Affichez les données dans le tableau
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['num_commande'] . '</td>';
                echo '<td>' . $row['nom_client'] . '</td>';
                echo '<td>' . $row['prenom_client'] . '</td>';
                echo '<td>' . $row['taureau_acheter'] . '</td>';
                echo '<td>' . $row['date_achat'] . '</td>';
                echo '<td>' . $row['prix_achat'] . '</td>';
                echo '</tr>';
            }

            // Libérez les ressources et fermez la connexion à la base de données
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
