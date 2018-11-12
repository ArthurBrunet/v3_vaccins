<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>





<?php include('inc/headerb.php'); ?>

<table>
    <tr>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Numéro de sécurité social</td>
        <td>Adresse Mail</td>
    </tr>
</table>





<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>