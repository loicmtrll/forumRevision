<?php
  require 'connexionBd.php';
  require 'fonction.php';

  if (isLogged()==false) {
    header('Location:index.php');
  }

  if (isset($_POST['btnPublier'])) {
    if (!empty($_POST['titre']) AND !empty($_POST['description'])) {
      $titre = filter_input(INPUT_POST,'titre',FILTER_SANITIZE_STRING);
      $description =  filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);


      $insertart = $bdd->prepare("insert INTO articles(titreArticle,texteArticle) VALUES(?,?)");
      $insertart->execute(array($titre,$description));
      $erreur = "Votre article a bien été ajouté !";
      header("Location: index.php");

    }else {
      $erreur = "Veuillez remplir tout les champs.";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Publication</title>
  </head>
  <body>
    <h1>Bonjour <?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?>, voici votre fil d'actualités !</h1>

    <br><br><br>
    <form action="" method="post">
      titre : <br>
      <input type="text" name="titre"><br><br>
      Description :<br>
      <TEXTAREA name="description" rows="6" cols="50"></TEXTAREA>
      <input type="submit" name="btnPublier" value="Publier">
    </form><br><br><br>
    <?php if (isset($erreur)) {
      echo $erreur;
    } ?>
    <br><a href="logout.php">Déconnection</a>
  </body>
</html>
