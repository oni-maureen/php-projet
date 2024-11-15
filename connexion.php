<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form method="POST" action="connexion.php" style="margin: 10px 10px 10px 10px;">
        <label for="nom"  placeholder="Username">Nom :</label>
        <input type="text" id="id" name="nom"  placeholder = "Entrez votre nom " ><br>
        <button type="submit" class="btn btn-info " style="margin-top: 10px;">Se connecter</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomSaisi = htmlspecialchars($_POST['nom']);

    // Lire le contenu du fichier JSON
    $jsonData = file_get_contents('login.json');
    $utilisateurs = json_decode($jsonData, true); 

    // Vérifier si le nom saisi est dans la liste
    $authentifie = false;
    foreach ($utilisateurs as $utilisateur) {
        if (strcasecmp($utilisateur['nom'], $nomSaisi) === 0) {
            $authentifie = true;
            break;
        }
    }


    if ($authentifie) {
        session_start();
        $_SESSION['login'] = $nomSaisi;
        header("Location: idees.php");
    } else {
        echo "<p style='color: red;'>Nom incorrect. Veuillez réessayer.</p>";
    }
}
?>