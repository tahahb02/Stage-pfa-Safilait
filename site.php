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
$numero_telephone = clean_input($_POST['numero_telephone']);
$commentaire = clean_input($_POST['commentaire']);

// Vérification de champs obligatoires
if (empty($nom) || empty($prenom) || empty($email) || empty($numero_telephone)) {
    die("Tous les champs obligatoires doivent être remplis.");
}

// Vérification du format de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Le format de l'email est invalide.");
}

// Vérification de la clé "taureau" dans $_POST
$taureau = isset($_POST['taureau']) ? clean_input($_POST['taureau']) : '';

// Utilisation de requête préparée pour éviter les attaques par injection SQL
$sql = "INSERT INTO formulaire (nom, prenom, email, numero_telephone, taureau, commentaire)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $nom, $prenom, $email, $numero_telephone, $taureau, $commentaire);

try {
    if (mysqli_stmt_execute($stmt)) {
        echo "Réservation accomplie avec succès.";
    } else {
        throw new Exception("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
    }
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
