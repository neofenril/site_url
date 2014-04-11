<?php

// Inclusion de red bean
require 'rb.phar';
R::setup('mysql:host=localhost;dbname=racurl',
        'yohann','');
R::debug (TRUE, 1);

function nbEnreg($motcle = "")
{
  if ($motcle == "") {
    return R::count('film');
  }
  else {
    return R::count('film', ' titre LIKE ? ', [ ('%' . $motcle . '%') ]);
  }
}

function constReq($motcle = "", $inddep = -1, $nbelt = 0)
{
  if ($motcle == "") {
    if ($inddep != -1) {
      $films = R::findAll('film', ' LIMIT ?, ?' , [((int) $inddep), ((int) $nbelt)]);
    }
    else {
      $films = R::findAll('film');
    }
  }
  else {
    if ($inddep != -1) {

      $film = R::findAll('film', ' titre LIKE ? LIMIT ? : ?',
			 [ ('%' . $motcle . '%'), ((int) $inddep), ((int) $nbelt) ]);
    }
    else {
      $film = R::findAll('film', ' titre LIKE ? ', [ ('%' . $motcle . '%') ]);
    }
  }

  return $films;
}
?>

<!DOCTYPE html> 
<html>
  <head>
    <meta charset="utf-8" />
    <title>
      Recherche sur la base Films
    </title>
  </head>
  
  <body>
    <h1>
      Recherche sur la base Films
    </h1>
    
    <?php
    // Récupération des données du formulaire
    $type = $_GET['typerech'];
    $motcle = trim($_GET['filtre']);
    $maxelt = $_GET['maxelt'];
    
    if (isset($_GET['page']))
      $page = $_GET['page'];
    else
      $page = 1;
    
    // On lance la requête...
    
    if ($type == "complete") {
      $res = constReq("", ($page - 1) * $maxelt, (int) $maxelt);
      echo "<h2>Type de requête : complète</h2>";
    }
    else {
      $res = constReq($motcle, ($page - 1) * $maxelt, (int) $maxelt);
      echo "<h2>Type de requête : filtrée sur '$motcle'</h2>";
    }
    
    // On itère sur les résultats grâce à foreach...
    
    $i = 0;
    echo "<table>";
    
    foreach ($res as $f) {
      echo '<tr><td bgcolor="#' .
	   (($i++ % 2) ? "D0FFFF" : "FFD0FF") .
           '">' . 
	   $f->titre . 
	   "</td></tr>\n";
    }      

    echo "</table>";
    
    // Gestion des pages de résultat
    
    $nbEnr = nbEnreg($motcle);
    $nbPages = (int) ($nbEnr / $maxelt);
    
    if (($nbEnr % $maxelt) != 0)
      $nbPages++;
    
    // Génération des liens de navigation
    
    if ($page != 1)
      echo "<a href=\"film.php?typerech=$type&filtre=$motcle&page=" .
	   ($page - 1) . "&maxelt=$maxelt\">Précédent</a> ";
    
    if ($page != $nbPages)
      echo "<a href=\"film.php?typerech=$type&filtre=$motcle&page=" .
	   ($page + 1) . "&maxelt=$maxelt\">Suivant</a>";
    
    $p = null;
    ?>
    <br />
    <br />
    <a href="index.php">Retour au formulaire</a>
  </body>
</html>
