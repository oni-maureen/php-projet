<?php 
session_start();
if (!isset($_SESSION['login'])) {
   header("Location: connexion.php");
   exit();
}

$recupIdees = file_get_contents('idees.json');
if ($recupIdees === false) {
die('Erreur : Impossible de lire le fichier idees.json');
}

$lesIdees = json_decode($recupIdees, true);
if (json_last_error() !== JSON_ERROR_NONE) {
die('Erreur : JSON invalide - ' . json_last_error_msg());
}

$recupVotes = file_get_contents('votes.json');
if ($recupVotes === false) {
   die('Erreur : Impossible de lire le fichier votes.json');
   }
   
$lesVotes = json_decode($recupVotes, true);


function AjoutVote($id_idee, $lesVotes, $typeVote){

   foreach($lesVotes as $vote){
       if($vote['id_idee'] == $id_idee && $vote['user'] == $_SESSION['login']){
           $lElement = array_search($vote, $lesVotes);
           if ($lElement !== false) {
               unset($lesVotes[$lElement]);
           }
       }
   }
   $nouveauVote = [
       "id_idee" => $id_idee,
       "user" => $_SESSION["login"],
       "type_vote" => $typeVote
   ];
   $lesVotes[] = $nouveauVote;
   $jsonMisAJour = json_encode($lesVotes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
   file_put_contents('./votes.json', $jsonMisAJour);

   header("Location: " . $_SERVER['PHP_SELF']); 
   exit();
}

if(isset($_POST["like"])){
   AjoutVote($_POST["idIdee"], $lesVotes, "positif");
}
if(isset($_POST["dislike"])){
   AjoutVote($_POST["idIdee"], $lesVotes, "negatif");
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Liste des idées</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>  
       <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
           <div class="container-fluid justify-content-end">
               <ul class="nav">
                   <li class="nav-item">
                       <a href="soumettre-idee.php" class="nav-link">Soumettre une idée</a>
                   </li>
                   <li class="nav-item">
                       <a href="deconnexion.php" class="nav-link">Déconnexion</a>
                   </li>
               </ul>
           </div>
       </nav>
       <h1 class="text-center mt-4 mb-4">Les Idées</h1>

       <div class="container mt-4 mb-5">
           <div class="row g-4">
               <?php foreach ($lesIdees as $idee): 
                   $like = 0;
                   $dislike = 0;
                   foreach($lesVotes as $vote){
                       if($vote['id_idee'] == $idee['id_idee']){
                           if($vote['type_vote'] == "positif"){
                               $like = $like + 1;
                           } else {
                               $dislike = $dislike + 1;
                           }
                       }
                   }
               ?>
                   <div class="col-12 col-md-6 col-lg-4">
                       <div class="card h-100">
                           <div class="card-body">
                               <p class="card-title h3"><?= htmlspecialchars($idee['titre'] ?? 'Titre non disponible') ?></p>
                               <p class="card-text" style="max-height: 100px; overflow-y: auto;"><?= $idee['description'] ?? 'Description non disponible' ?></p>
                               <p class="card-text"><?= htmlspecialchars($idee['auteur'] ?? 'Auteur inconnu') ?>, le <?= htmlspecialchars($idee['dateDeCreation'] ?? 'Date non disponible') ?></p>
                               <form action='' method='POST'>
                                   <input name="idIdee" type="hidden" value="<?= $idee['id_idee'] ?>"/>
                                   <input name="dislike" type="submit" class="btn btn-outline-danger btn-sm" value="Dislike <?= htmlspecialchars($dislike ?? '0') ?>"/>
                                   <input name="like" type="submit" class="btn btn-outline-success btn-sm" value="Like <?= htmlspecialchars($like ?? '0') ?>"/>
                               </form>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
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