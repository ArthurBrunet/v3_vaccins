<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>


<?php 
    if (!empty($_GET['id'])&&is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        if (!empty($_POST['submittedoui'])) {
            $sql = "DELETE FROM v3_vac_vaccins WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':id',$id, PDO::PARAM_STR);
            $query->execute();
            header('Location: listvaccins.php');
        }elseif (!empty($_POST['submittednon'])) {
            header('Location: listvaccins.php');
        }             
    }else {
        header('Location: ../404.php');
    }
   
?>





<?php include('inc/headerb.php'); ?>


<p style="position:absolute;
   top:50%;
   left:50%;
   width:300px; /* A toi de donner la bonne largeur */
   height:200px; /* A toi de donner la bonne hauteur */
   margin-left:-180px; /* -largeur/2 */
   margin-top:-250px; /* -hauteur/2 */
   text-align: center;
    color: red;
    font-size: 1.7em;">Êtes-vous sûr de vouloir supprimer ce vaccin définitivement de la Base De Données?</p>
<form action="" method="post" style="position:absolute;
   top:50%;
   left:50%;
   width:800px; /* A toi de donner la bonne largeur */
   height:200px; /* A toi de donner la bonne hauteur */
   margin-left:-100px; /* -largeur/2 */
   margin-top:-100px; /* -hauteur/2 */">
<input type="submit" name="submittedoui" value="OUI" class="btn btn-metis-5 btn-lg btn-round">
<input type="submit" name="submittednon" value="NON" class="btn btn-metis-5 btn-lg btn-round">
</form>







<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>