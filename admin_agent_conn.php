
<?php
session_start();

$errorMessage = ""; // Initialisation du message d'erreur à une chaîne vide

// Nouvelle fonction de vérification des identifiants et mots de passe
function verifyCredentials($username, $password) {
    if ($username === 'admin' && $password === 'admin123') {
        return 'admin';
    } else if ($username === 'agent' && $password === 'agent123') {
        return 'agent';
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs saisies dans le formulaire
    $username = $_POST['id'];
    $password = $_POST['mot_de_passe'];

    // Vérification des identifiants et du rôle en utilisant la nouvelle fonction
    $userRole = verifyCredentials($username, $password);

    if ($userRole) {
        // Les identifiants sont corrects, enregistrez l'utilisateur dans la session
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $userRole;
        
        // Redirection en fonction du rôle
        if ($userRole === 'admin') {
            header('Location: confirmer_commande.php');
        } elseif ($userRole === 'agent') {
            header('Location: tableau.php');
        }
        exit; // Arrêtez le script ici pour éviter la poursuite de l'exécution
    } else {
        $errorMessage = 'Identifiants incorrects.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="image/jibal.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>

<style>
        
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;


}


/*login page placer au milieu*/
body {
    display: flex;
    align-items: center; /* Modifier l'alignement vertical */
    justify-content: center; /* Modifier l'alignement horizontal */
    min-height: 90vh;
    margin: 0; /* Réinitialiser les marges du corps */
    background-image: url('image/background.jpg');
    background-size: cover;
     background-repeat: no-repeat;
}


#login-page {
    border: 2px solid black;
    width: 420px;
    background: transparent;
    color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 15px 40px;
    margin: 40px; /* Modifier la marge */
    background-image: url(); /* Ajouter l'image d'arrière-plan */
    background-size: cover; /* Ajuster la taille de l'image pour couvrir tout le conteneur */
}

#login-page h1 {
    text-align: center;
    font-size: 39px;
    color: black;
}

#login-page .input-box {
    position: center;
    width: 85%;
    height: 50px;
    margin: 30px 0px;
}

.input-box input {

    width: 100%;
    height: 90%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid black;
    border-radius: 30px;
    font-size: 17px;
    padding: 10px 60px 10px 25px;
}

.input-box input::placeholder {
    color: rgb(0, 0, 0);


}

.input-box i {
    position: absolute;
    right: 20px;
    top: 35%;
    transform: translateY(-50%);
    color: black;
}

#login-page .remember-forgot {
    display: flex;
    justify-content: space-between;
    margin: -15px 0 15px;
    margin: 12px 0px 12px 0px;

}

.remember-forgot label input {
    accent-color: rgb(255, 255, 255);
    margin-right: 7px;

}

.remember-forgot label {
    color: black;
}

.remember-forgot a {
    color: black;
    font-weight: bold;
    text-decoration: underline;
}

.remember-forgot a:hover {
    text-decoration: underline;
    color: rgb(0, 0, 0);
}

#login-page .btn {
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    border-radius: 30px;
    background-image: linear-gradient(to left, white, black);

    cursor: pointer;
    font-size: 15px;
    color: rgb(0, 0, 0);
    font-weight: bold;
}

#login-page .register-here {
    font-size: 15px;
    text-align: center;
    margin: 30px 0px 20px;
}

.register-here p {
    color: rgb(0, 0, 0);
    font-size: 16px;

}

.register-here p a {
    color: black;
    font-size: 17px;
    font-weight: bold;
    text-decoration: underline;
}

.register-here p a:hover {
    color: rgb(0, 0, 114);
    text-decoration: underline;

}
</style>

    <link rel="stylesheet" href="se connecter.css">
</head>
<body>
    <div id="login-page">
        <form action="" method="post"> <!-- Laissez l'attribut "action" vide pour envoyer le formulaire vers la même page -->
            <h1>Se connecter</h1>
            <?php
                // Afficher le message d'erreur s'il y en a un
                if ($errorMessage) {
                    echo '<p style="color: red;">' . $errorMessage . '</p>';
                }
            ?>
            <div class="input-box">
                <input type="text" name="id" placeholder="identifiant" required>
                <i class='bx bxs-user bx-tada bx-rotate-90'></i>
            </div>
            <div class="input-box">
                <input type="password" name="mot_de_passe" placeholder="mot de passe" required>
                <i class='bx bxs-lock-alt bx-tada bx-rotate-90'></i>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>
