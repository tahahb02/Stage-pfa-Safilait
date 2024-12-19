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

// Récupérez le numéro de commande de la requête GET
$numero_commande = $_GET['numero_commande'];

// Échappez le numéro de commande pour éviter les injections SQL (utilisation de requêtes préparées est recommandée)
$numero_commande = mysqli_real_escape_string($conn, $numero_commande);

// Sélectionnez les données de la table "formulaire" en fonction du numéro de commande
$sql_select = "SELECT nom, prenom, taureau FROM formulaire WHERE numero_commande = '$numero_commande'";
$result_select = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result_select) > 0) {
    // Il y a des données correspondantes, récupérez-les
    $row = mysqli_fetch_assoc($result_select);
    
    // Récupérez les données nécessaires
    $nom_client = $row['nom'];
    $prenom_client = $row['prenom'];
    $taureau_acheter = $row['taureau'];
    
    // Obtenez également la date actuelle
    $date_achat = date('Y-m-d');
    
    // Récupérez le prix d'achat du formulaire HTML (assurez-vous que le champ correspondant est dans votre formulaire)
    $prix_achat = $_GET['prix'];
    


    // Échappez les données pour éviter les injections SQL
    $nom_client = mysqli_real_escape_string($conn, $nom_client);
    $prenom_client = mysqli_real_escape_string($conn, $prenom_client);
    $taureau_acheter = mysqli_real_escape_string($conn, $taureau_acheter);
    $prix_achat = mysqli_real_escape_string($conn, $prix_achat);
    
    // Insérez les données dans la table "commande_valider"
    $sql_insert = "INSERT INTO commande_valider (num_commande, nom_client, prenom_client, taureau_acheter, date_achat, prix_achat) VALUES ('$numero_commande', '$nom_client', '$prenom_client', '$taureau_acheter', '$date_achat', '$prix_achat')";
    
    if (mysqli_query($conn, $sql_insert)) {
        // Réussi à enregistrer la commande
        echo 'La commande a été enregistrée avec succès.';
    } else {
        // Échec de l'enregistrement de la commande
        echo 'Erreur lors de l\'enregistrement de la commande : ' . mysqli_error($conn);
    }
} else {
    // Aucune donnée correspondante trouvée pour le numéro de commande
    echo 'Aucune donnée correspondante trouvée pour le numéro de commande ' . $numero_commande;
}

// Fermez la connexion à la base de données
mysqli_close($conn);
?>
