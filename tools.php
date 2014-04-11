<?php

session_start();

function enteteHTML($titre)
{
  echo <<< YOP
  <!DOCTYPE html> 
  <html>
    <head>
      <meta charset="utf-8" />
      <link href="style.css" media="screen" rel="stylesheet" type="text/css">
      <title>
        $titre
      </title>
    </head>
    <body>
YOP;

  if (isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    echo <<< MSG
  
  <div class="msginfo">
    $info
  </div>
MSG;
  unset($_SESSION['info']);
  }
}

function enteteTitreHTML($titre)
{
  enteteHTML($titre);
  echo <<< YOP

    <h1>
      $titre
    </h1>
YOP;
}

function finHTML()
{
  echo <<< YOP

  </body>
</html>
YOP;
}

function flash($texte)
{
  $_SESSION['info'] .= $texte;
}

?>
