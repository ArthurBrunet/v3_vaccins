<?php
$title = "Modif mot de passe";
include('inc/pdo.php');
include('inc/fonction.php');

if (!empty($_GET['email']) && !empty($_GET['token'])) {
  $errors = array();
  //decode
  $email = urldecode($_GET['email']);
  $token = urldecode($_GET['token']);
  //requet sql
  $sql = "SELECT * FROM v3_vac_users WHERE email= :Email AND token= :Token";
        $query = $pdo->prepare($sql);
        $query -> bindValue(':Email',$email);
        $query -> bindValue(':Token',$token);
        $query -> execute();
  $user = $query -> fetch();
  if (!empty($user)) {
    if (!empty($_POST['submitted'])) {
      $password = trim(strip_tags($_POST['password']));
      $password2 = trim(strip_tags($_POST['password2']));
      if (!empty($password) && !empty($password2)) {
        if ($password != $password2) {
          $errors['password'] = 'mot de passe pas correct !';
        }else {
          if (strlen($password) < 3) {
            $errors['password'] = 'plus de 3 caract';
          }elseif (strlen($password) > 255) {
            $errors['password'] = 'pas plus de 255';
          }
        }
      }else {
        $errors['password'] = 'veuillez renseigner un mot de passe';
      }
      if (count($errors) == 0) {
        $success = true;
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $token = generateRandomString(255);
        $sql = "UPDATE v3_vac_users SET password=:Password, token=:Token, updated_at= NOW() WHERE id=:Id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':Id',$user['id']);
            $query->bindValue(':Password',$hash);
            $query->bindValue(':Token',$token);
            $query->execute();
        header('Location: connection.php');
      }
    }
    include('inc/header.php');
    ?>
    <div class="background">
      <img src="asset/images/bg-banner1.png" alt="">
      <div class="contenu-image">
        <h1>Bienvenue sur A.B.A</h1>
        <p>Le nouveau site de carnets de vaccination électronique, permettant de vous faciliter la vie dans vos démarches de santé.</p>
        <p>Vous pourrez conserver la trace de tous vos vaccins reçus</p>      </div>
    </div>
    <form class="" method="post">
      <input type="password" name="password" value=""><?php afficheErrors($errors,'password'); ?>
      <input type="password" name="password2" value="">
      <input type="submit" name="submitted" value="changez">
    </form>
    <?php
  }else {
    header('Location: 404.php');
  }



}else {
  header('Location: 404.php');
}

include('inc/footer.php');
