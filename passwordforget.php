<?php
$title = "Mot de passe oublié";
include('inc/pdo.php');
include('inc/fonction.php');

$errors = array();
if (!empty($_POST['submitted'])) {
  $email = trim(strip_tags($_POST['email']));

  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sql = "SELECT email,token FROM v3_vac_users WHERE email = :Email ";
        $query = $pdo -> prepare($sql);
        $query -> bindValue(':Email',$email);
        $query -> execute();

    $user = $query->fetch();
    if (!empty($user)) {
      $body = '<p>cliquer cliquer cliquer</p>';
      $body .= '<a href="passwordmodif.php?email='.urlencode($user['email']).'&token='.urlencode($user['token']).'">ICI</a>';
      echo $body;
    }

  } else {
    $errors['email'] = "veuillez renseigner un email valide";
  }
}


include('inc/header.php');

?>
<div class="wrapper">


<form class="" method="post">
  <label for="">email *</label>
  <input type="email" name="email" value="<?php if (!empty($_POST['email'])) {echo $_POST['email']; } ?>">
  <input type="submit" name="submitted" value="Modifier mot de passe">
</form>
</div>

<?php
include('inc/footer.php');
