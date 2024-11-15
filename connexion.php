<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="connexion.php">
        <label for="nom">Nom :</label>
        <input type="text" id="id" name="nom" required><br>
        <button type="submit">Se connecter</button>
    </form>
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