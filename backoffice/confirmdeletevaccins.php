<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php 
    if (isadmin()) {
?>




<?php include('inc/headerb.php'); ?>







<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>
