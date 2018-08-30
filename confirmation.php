<?php
  require 'fonction.php';
  if (isLogged()== false) {
    header('Location:index.php');
  }
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connecté</title>
  </head>
  <body>
    <h1><?php echo "Bonjour,". $_SESSION['prenom']." ". $_SESSION['nom'].", vous etes connecté !"; ?></h1>
    <a href="main.php">Publier un article.</a>
  </body>
</html>
