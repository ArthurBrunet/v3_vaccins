<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>

<?php 
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT email, role FROM v3_vac_users WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetchAll();
    // debug($users);
}
$error = array();
if (!empty($_POST['submittedmodifuser'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $error = veriftext($error, $email, 'email', 3,50);

    if (isset($_POST['role'])){
        $modifrole = $_POST['role'];
    }else {
          $error['role'] = 'Veuillez selectionnez une option';
    }



}
?>


<?php include('inc/headerb.php'); ?>

<form action="" method="post">

        <label for="email">Email: </label>
        <span><?php if (!empty($error['email'])) { echo($error['email']);} ?></span>
        <br><input type="text" name="email" id="email" value="<?php if (!empty($_POST['email'])) { echo($_POST['email']);} else{echo($users[0]['email']);} ?>">

        <br><label for="role">Rôle de l'utilisateur: </label>
        <span><?php if (!empty($error['role'])) { echo($error['role']);} ?></span>
        <br><select name="role" id="role">
             <option value="user">user</option>
            <option value="admin">admin</option>
        </select>

        <br><input type="submit" name="submittedmodifuser" value="Valider">
</form>





<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>