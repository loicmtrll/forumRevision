<?php
require 'connexionBd.php';
require 'fonction.php';

if (isset($_POST['btnEnvoyer']))
  {
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $mdp = sha1($mdp);



    if (!empty($pseudo) AND !empty($mdp))
    {
      $requser = $bdd->prepare("select * FROM membres WHERE identifiant = ? AND mdp = ?");
      $requser->execute(array($pseudo, $mdp));
      $userexist = $requser->rowCount();
      if ($userexist == 1)
      {
          $userinfo = $requser->fetch();
          $_SESSION['pseudo'] = $userinfo['identifiant'];
          $_SESSION['nom'] = $userinfo['nom'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          $_SESSION['connect'] = true;
          header("Location: confirmation.php");
          exit();
      }else{
        $erreur = "Mauvais mail ou mot de passe !";
      }
    }else
    {
      $erreur = "Tous les champs doivent etre completés !";
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <div class="">
      <form action="" method="post">
        Identifiant : <br>
        <input type="text" name="pseudo" value="<?php if (isset($pseudo)){echo $pseudo;}?>"><br><br>
        Mot de passe :<br>
        <input type="password" name="mdp"><br>
        <input type="submit" name="btnEnvoyer" value="Valider">
      </form>
      <br><br>
      <?php if (isset($erreur)) {
        echo $erreur;
      } ?>
    </div>
    <a href="inscription.php">Pas encore inscrit ?</a>
  </body>
</html>
