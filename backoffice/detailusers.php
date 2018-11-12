<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>


<?php
    $sql2 = "SELECT * FROM v3_users_vaccins AS u, v3_vac_vaccins AS v WHERE v.id = u.id_vaccins";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $vacusers = $query2->fetchAll();
    // debug($vacusers);

?>

<?php include('inc/headerb.php'); ?>
<table>
    <tr>
        <th>Vaccins</th>
        <th>Date du vaccin</th>
    </tr>
    <?php 
        foreach ($vacusers as $vacuser) {
            $datevaccin = date('d/m/Y', strtotime($vacuser['date']));
            echo('<tr>
                <td>'.$vacuser['nom'].'</td>
                <td>'.$datevaccin.'</td>
            </tr>');
        }

    ?>
</table>






<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>