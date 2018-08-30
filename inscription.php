<?php
  require 'connexionBd.php';


  if (isset($_POST['forminscription'])) {

    if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['identifiant']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

      $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
      $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
      $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);


      if ($mdp == $mdp2) {
        $reqidentifiant = $bdd->prepare("select * FROM membres WHERE identifiant = ?");
        $reqidentifiant->execute(array($identifiant));
        $identifiantexist = $reqidentifiant->rowCount();
        if ($identifiantexist == 0) {
          $insertmbr = $bdd->prepare("insert INTO membres(prenom,mdp,identifiant,nom) VALUES(?,?,?,?)");
          $insertmbr->execute(array($prenom,$mdp,$identifiant,$nom));
          $erreur = "Votre compte a bien été créer !";
          header("Location: index.php");
          exit();
        }else {
          $erreur = "Identifiant deja utilisé.";
        }
      }else {
        $erreur = "Les deux mots de passe ne correspondent pas.";
      }
    }else{
      $erreur = "Tout les champs doivent etre completer !";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>inscription</title>
  </head>
  <body>
    <form method="POST" action="">
      <table>
        <tr>
          <td colspan="2">Inscription</td>
        </tr>
        <tr>
          <td>Prenom :</td>
          <td><input type="text" id="prenom" name="prenom" value="<?php if (isset($prenom)){echo $prenom;}?>"></td>
        </tr>
        <tr>
          <td>Nom :</td>
          <td><input type="text" id="nom" name="nom" value="<?php if (isset($nom)){echo $nom;}?>"></td>
        </tr>
        <tr>
          <td>Identifiant :</td>
          <td><input type="text" id="identifiant" name="identifiant" value="<?php if (isset($identifiant)){echo $identifiant;}?>"></td>
        </tr>
        <tr>
          <td>Mot de passe :</td>
          <td><input type="password" id="mdp" name="mdp"></td>
        </tr>
        <tr>
          <td>Confirmation du mot de passe :</td>
          <td><input type="password" id="mdp2" name="mdp2"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="forminscription" value="Je m'inscris"></td>
        </tr>
      </table>
    </form>
    <?php if (isset($erreur)) {
      echo $erreur;
    } ?>
  </body>
</html>
