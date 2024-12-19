<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password_db = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "daba";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérification de la connexion à la base de données
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Préparez la requête SQL pour vérifier les informations de l'utilisateur
    $sql = "SELECT nom, prenom, email, mot_de_passe FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // L'utilisateur existe, vérifiez le mot de passe
        $user = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Mot de passe correct, authentification réussie
            $_SESSION['loggedin'] = true;
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            header("Location: site.html"); // Redirigez vers la page d'accueil après une connexion réussie
            exit();
        } else {
            $message = 'Mot de passe incorrect.';
        }
    } else {
        $message = 'Identifiant incorrect.';
    }

    $stmt->close();
    $conn->close();
} else {
    $message = 'Veuillez remplir tous les champs.';
}
?>