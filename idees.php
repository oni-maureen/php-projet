<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid justify-content-end">
            <ul class="nav">
                <li class="nav-item">
                    <a href="soumettre-idees.php" class="nav-link">Soumettre une idée</a>
                </li>
                <li class="nav-item">
                    <a href="deconnexion.php" class="nav-link">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row g-4 me-4">
            <div class="card" style="width: 20rem; margin-right:25px;">
                <div class="card-body">
                    <p class="card-title h3"><?php $titre ?>Titre</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <button class="btn btn-outline-danger btn-sm">Contre</button>
                    <button class="btn btn-success btn-sm">Pour</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Etape:
// Recupèrer les idées dans le JSON des idées.
// Les afficher comme des cartes, dans l'ordre antchronologique.
// Récupèrer les votes et afficher le nombres pour chaques idées.
// Mettre en avant les votes deja fait de l'utilisateur. 
// Ajouter un votes positif ou negatif.
// Remplacé si déjà voter.
// Bouton Deconnection + Ajouter Idées
?>