<?php
if (isset($_GET['numero_commande'])) {
    // Récupérez l'ID de commande depuis l'URL
    $numeroCommande = $_GET['numero_commande'];

    // Établissez une connexion à la base de données (personnalisez les informations de connexion)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "daba";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die('La connexion a échoué : ' . mysqli_connect_error());
    }

    // Écrivez une requête SQL pour supprimer la commande de la table
    $sql = "DELETE FROM formulaire WHERE numero_commande = $numeroCommande";

    // Exécutez la requête SQL
    if (mysqli_query($conn, $sql)) {
        // La suppression a réussi
        echo 'La commande a été supprimée avec succès.';
    } else {
        // La suppression a échoué
        echo 'Erreur lors de la suppression de la commande : ' . mysqli_error($conn);
    }

    // Fermez la connexion à la base de données
    mysqli_close($conn);
}
?>
