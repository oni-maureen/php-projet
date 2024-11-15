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
// Etape:
// Crée champ de connection: login
// Verifier avec le tableau des autorisé si le login est valide.
// Si valide: Crée une Session puis rediriger vers la page idées.
// Si erreur: Afficher que l'utilisateur n'est pas accepté. 
// Doit verifier que l'utilisateur a bien une session lorsqu'il est sur les autres page, si non: redirige ici
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le nom saisi
    $nomSaisi = htmlspecialchars($_POST['nom']);
    setcookie('login', $_POST['nom'], );

    // Lire le contenu du fichier JSON
    $jsonData = file_get_contents('login.json');
    $utilisateurs = json_decode($jsonData, true); // Convertir le JSON en tableau PHP

    // Vérifier si le nom saisi est dans la liste
    $authentifie = false;
    foreach ($utilisateurs as $utilisateur) {
        if (strcasecmp($utilisateur['nom'], $nomSaisi) === 0) { // Comparaison insensible à la casse
            $authentifie = true;
            break;
        }
    }


    if ($authentifie) {
        session_start();
        header("Location: idees.php");
    } else {
        echo "<p style='color: red;'>Nom incorrect. Veuillez réessayer.</p>";
    }
}
?>