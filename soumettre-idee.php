<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre des idées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid justify-content-end">
            <ul class="nav">
                <li class="nav-item">
                    <a href="idees.php" class="nav-link">Voir les idées</a>
                </li>
                <li class="nav-item">
                    <a href="deconnexion.php" class="nav-link">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4 ">
        <div class="grid row justify-content-center row-gap-3">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <p class="h4">Soumettre une nouvelle idée</p>
                    </div>
                    <form method="POST" action="soumettre-idee.php">
                        <div class="m-4">
                            <label for="titre" class="form-label mt-3">Titre :</label><br>
                            <input type="text" id="titre" name="titre" class="form-control" required>
                        </div>
                        <div class="m-4">
                            <label for="description" class="form-label">Description :</label><br>
                            <textarea id="description" name="description" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-info">Soumettre l'idée</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $auteur = htmlspecialchars($_SESSION['login']);
    $dateDeCreation = date('d/m/Y');
    $fichierJson = './idees.json';

    if (file_exists($fichierJson)) {
        $contenu = file_get_contents($fichierJson);
        $data = json_decode($contenu, true); 
    } else {
        $data = [];
    }

    $nouvelleIdee = [
        "id_idee" => uniqid(), // Générer un ID unique
        "titre" =>  $titre,
        "description" => $description,
        "auteur" => $auteur,
        "dateDeCreation" => $dateDeCreation 
    ];

    $data[] = $nouvelleIdee;
    $jsonMisAJour = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($fichierJson, $jsonMisAJour);
    
    header("Location: ./idees.php");
    exit();
}
?>