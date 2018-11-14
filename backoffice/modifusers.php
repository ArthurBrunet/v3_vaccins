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
    $email = $_POST['email'];
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
    }else {
        $error['email'] = 'Veuillez renseigner une adresse mail';
    }
    if (count($error) == 0) {
        
    }
    $role = $_POST['role'];
    $sql2 = "UPDATE v3_vac_users SET email = :email, role = :role, updated_at = NOW() WHERE id = :id";
    $query2 = $pdo->prepare($sql2);
    $query2->bindValue(':email', $email, PDO::PARAM_STR);
    $query2->bindValue(':role', $role, PDO::PARAM_STR);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();


}
?>


<?php include('inc/headerb.php'); ?>
    <div class="body collapse in col-lg-6 box col-lg-12" style="position: relative; left: 24%; border: none;">
        <form action="" method="post" style="text-align: center;">

                <label for="email">Email: </label>
                <span><?php if (!empty($error['email'])) { echo($error['email']);} ?></span>
            <div style="width: 20%; position: relative; left: 40%;">
                <br><input type="text" name="email" id="email" value="<?php if (!empty($_POST['email'])) { echo($_POST['email']);} else{echo($users[0]['email']);} ?>" class="form-control">
            </div>

                <br><label for="role">Rôle de l'utilisateur: </label>
                <span><?php if (!empty($error['role'])) { echo($error['role']);} ?></span>
            <div style="width: 10%; position: relative; left: 45%;">
                <br><select name="role" id="role" class="form-control autotab">
                     <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
                <br><input type="submit" name="submittedmodifuser" value="Valider" class="btn btn-metis-5 btn-lg btn-round">
        </form>
    </div>





<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>