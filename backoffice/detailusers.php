<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>


<?php
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql2 = "SELECT * FROM v3_vac_vaccins AS v, v3_users_vaccins AS u WHERE v.id = u.id_vaccins AND u.id_user = $_GET[id]";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $vacusers = $query2->fetchAll();
    // debug($vacusers);
}else {
    header('Location: ../404.php');
}

?>

<?php include('inc/headerb.php'); ?>
<div class="col-lg-4 ui-sortable" style="position: absolute; left: 31.5%;">
<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer">
    <tr>
        <th style="text-align: center;">Vaccins</th>
        <th style="text-align: center;">Date du vaccin</th>
    </tr>
    <?php 
        foreach ($vacusers as $vacuser) {
            $datevaccin = date('d/m/Y', strtotime($vacuser['date']));
            echo('<tr>
                <td style="text-align: center;">'.$vacuser['nom'].'</td>
                <td style="text-align: center;">'.$datevaccin.'</td>
            </tr>');
        }

    ?>
</table>
</div>




<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>