<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>

<!-- Requete pour appeler la table de la vaccination -->
<?php 
    $sql = "SELECT * FROM v3_vac_vaccins";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listvaccins = $query->fetchAll();
    // debug($listvaccins);

?>

<?php include('inc/headerb.php'); ?>
<h1 class="text-primary">Listing des vaccins</h1>
<p>Voici un listing de tout les vaccins figurant sur le site.</p>
<p>Si vous souhaitez ajouter un nouveau alors il vous suffit de <a href="newvaccins.php">Cliquez ici</a> </p>

<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" style="text-align: center;">
    <tr>
        <th style="text-align: center;">Nom du vaccin</th>
        <th style="text-align: center;">Numéro de lot</th>
        <th style="text-align: center;">Catégorie</th>
        <th style="text-align: center;">Statuts</th>
        <th style="text-align: center;">Détail</th>
        <th style="text-align: center;">Modification</th>
    </tr>
    <?php 
        //boucle pour integrer nos données pour remplir notre liste 
        foreach ($listvaccins as $listvaccin) {
            echo('<tr><td>'.$listvaccin['nom'].'</td><td>'.$listvaccin['numerolot'].'</td><td>'.$listvaccin['categorie'].'</td><td>'.$listvaccin['statuts'].'</td><td><a href="detailvaccins.php?id='.$listvaccin['id'].'">Détail</a></td><td><a href="modifvaccins.php?id='.$listvaccin['id'].'">Modifier</a></td></tr>');
        }
    ?>
</table>





<?php include('inc/footerb.php'); ?>