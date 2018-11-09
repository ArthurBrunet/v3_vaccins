<?php


include('inc/pdo.php');
include('inc/fonction.php');

$errors = array();

if (!empty($_POST)) {
// faille xss
  $login = trim(strip_tags($_POST['login']));
  $password = trim(strip_tags($_POST['password']));


  $sql = "SELECT * FROM v3_vac_users
          WHERE email = :login";
          $query = $pdo->prepare($sql);
          $query->bindvalue(':login',$login);
          $query->execute();
      $user = $query->fetch();

  if (!empty($user)) {

    if (password_verify($password,$user['password'])) {
      if (count($errors) == 0) {
        $_SESSION['v3_user'] = array(
          'v3_id' => $user['id'], 'v3_email' => $user['email'], 'v3_role' => $user['role'], 'v3_ip' => $_SERVER['REMOTE_ADDR']
        );
        header('Location: index.php');
      }
    }else {
      $errors['password'] = 'votre mdp est incorrect';
    }


  }else {
    $errors['login'] = 'Vos identifiants ne sont pas correct !';
  }

  }








include('inc/header.php');



?>

<form class="" method="post">
  <label for="login">Email</label>
  <input type="text" name="login" value=""><?php afficheErrors($errors,'login'); ?>
  <label for="login">mot de passe</label>
  <input type="password" name="password" value=""><?php afficheErrors($errors,'password'); ?>
  <input type="submit" name="submitted" value="connexion">
</form>

<a href="passwordforget.php">mot de passe oublier</a>

<?php
include('inc/footer.php');
