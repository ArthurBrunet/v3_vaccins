<?php
$title = "Inscription";
include('inc/pdo.php');
include('inc/fonction.php');


$errors = array();
if (!islogged()){
if (!empty($_POST['submitted'])) {

  $email = trim(strip_tags($_POST['email']));
  $password = trim(strip_tags($_POST['password']));
  $password2 = trim(strip_tags($_POST['password2']));


  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sql = "SELECT email FROM v3_vac_users WHERE email = :Email ";
        $query = $pdo -> prepare($sql);
        $query -> bindValue(':Email',$email);
        $query -> execute();

    $verifEmail = $query->fetch();
    if (!empty($verifEmail)) {
      $errors['email'] = "cette email est deja utiliser sur le site";
    }

  } else {
    $errors['email'] = "veuillez renseigner un email valide";
  }

  if (!empty($password) && !empty($password2)) {
    if ($password != $password2) {
      $errors['password'] = 'mot de passe pas correct !';
    }else {

      if (strlen($password) < 3) {
        $errors['password'] = 'plus de 3 caracteres';
      }elseif (strlen($password) > 50) {
        $errors['password'] = 'pas plus de 50 caracteres';
      }


    }
  }else {
    $errors['password'] = 'veuillez renseigner un mot de passe';
  }


if (count($errors) == 0) {
  $success = true;
  $hash = password_hash($password,PASSWORD_DEFAULT);
  $token = generateRandomString(255);


  $sql = "INSERT INTO v3_vac_users ( email, password, token, created_at) VALUES ( :Email, :Password, '$token', NOW()) ";
      $query = $pdo->prepare($sql);
      $query->bindValue(':Email',$email);
      $query->bindValue(':Password',$hash);
      $query->execute();


  header('Location: connection.php');


}

}

include('inc/header.php');
?>
<div class="background">
  <img src="asset/images/bg-banner1.png" alt="">
  <div class="contenu-image">
    </div>
</div>
<div class="wrapperinscription">
  <form class="" method="post">
    <p>Email</p>
    <input type="text" name="email" value="<?php remplissageValue($_POST,'email'); ?>"><?php afficheErrors($errors,'email') ?>
    <p>Mot de passe</p>
    <input type="password" name="password" value=""><?php afficheErrors($errors,'password') ?>
    <p>Confirmation du mot de passe</p>
    <input type="password" name="password2" value="">
    <input type="submit" name="submitted" value="S'incrire !">
  </form>
</div>



<?php
}else {
  header('Location: index.php');
}



include('inc/footer.php');
