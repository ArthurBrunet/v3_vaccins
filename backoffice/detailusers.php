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

<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer">
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