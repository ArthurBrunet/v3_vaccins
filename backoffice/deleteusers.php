<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>



<?php 
    if (!empty($_GET['id'])&&is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        if (!empty($_POST['submittedoui'])) {
            $sql = "DELETE FROM v3_vac_users WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':id',$id, PDO::PARAM_STR);
            $query->execute();
            header('Location: listusers.php');
        }elseif (!empty($_POST['submittednon'])) {
            header('Location: listusers.php');
        }             
    }else {
        header('Location: ../404.php');
    }
   
?>





<?php include('inc/headerb.php'); ?>

<div style="position: relative; left: 35%;">
    <p>Êtes-vous sûr de vouloir supprimer cet utilisateur définitivement <br>de la Base De Données?</p>
</div>
    <div>
            <form action="" method="post">
                <input type="submit" name="submittedoui" value="OUI" class="btn btn-metis-5 btn-lg btn-round">
                <input type="submit" name="submittednon" value="NON" class="btn btn-metis-5 btn-lg btn-round">
            </form>
    </div>






<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>