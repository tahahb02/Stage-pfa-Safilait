<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "daba";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Fonction de nettoyage pour éviter les failles XSS
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nom = clean_input($_POST['nom']);
$prenom = clean_input($_POST['prenom']);
$email = clean_input($_POST['email']);
$mot_de_passe = clean_input($_POST['mot_de_passe']);

// Vérification de champs obligatoires
if (empty($nom) || empty($prenom) || empty($email) || empty($mot_de_passe)) {
    die("Tous les champs obligatoires doivent être remplis.");
}

// Vérification du format de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Le format de l'email est invalide.");
}

// Hashage du mot de passe
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Utilisation de requête préparée pour éviter les attaques par injection SQL
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) 
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $nom, $prenom, $email, $mot_de_passe_hash);

if (mysqli_stmt_execute($stmt)) {
    echo "Inscription accomplie avec succès.";
} else {
    echo "Erreur lors de l'inscription : " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
