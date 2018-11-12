<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>

<?php 
    $sql = "SELECT * FROM v3_vac_users";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listusers = $query->fetchAll();
    // debug($listusers);

?>





<?php include('inc/headerb.php'); ?>

<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" style="text-align: center;">
    <tr>
        <th style="text-align: center;">Adresse Mail</th>
        <th style="text-align: center;">Les Vaccins</th>
        <th style="text-align: center;">Rôle</th>
        <th style="text-align: center;">Création du compte</th>
        <th style="text-align: center;">Modifier</th>
        <th style="text-align: center;">Supprimer</th>
    </tr>

    <?php 
        foreach ($listusers as $listuser) {
            # code...
        }
    ?>
</table>





<?php include('inc/footerb.php'); ?>