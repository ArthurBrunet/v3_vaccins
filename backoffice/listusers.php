<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>
<?php if (isadmin()) { ?>

<?php 
    $sql = "SELECT * FROM v3_vac_users";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listusers = $query->fetchAll();
    // debug($listusers);

    
?>





<?php include('inc/headerb.php'); ?>
<div class="col-lg-12 ui-sortable">
<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" style="text-align: center;">
    <tr>
        <th style="text-align: center;">Adresse Mail</th>
        <th style="text-align: center;">Les Vaccins</th>
        <th style="text-align: center;">Rôle</th>
        <th style="text-align: center;">Création du compte</th>
        <th style="text-align: center;">Modification du compte</th>
        <th style="text-align: center;">Supprimer</th>
        <th style="text-align: center;">Modifier</th>
    </tr>

    <?php 
        foreach ($listusers as $listuser) {
            $datecreationusers =  date('d/m/Y', strtotime($listuser['created_at'])); //Création de la variable pour afficher la date de création en français
            if (!empty($listuser['updated_at'])) { //Création de la variable modifier pour la date de modif dans la BDD et ne pas oublier que !empty veut dire la meeme chose que 'pas null'
                $modifusers = date('d/m/Y', strtotime($listuser['updated_at']));
            }else{
                $modifusers = 'Il n\'y a eu aucune modification pour l\'instant';
            } 
            echo('<tr>
                    <td>'.$listuser['email'].'</td>
                    <td><a href="detailusers.php?id='.$listuser['id'].'">Détail</a></td>
                    <td>'.$listuser['role'].'</td>
                    <td>'.$datecreationusers.'</td>
                    <td>'.$modifusers.'</td>
                    <td><a href="deleteusers.php?id='.$listuser['id'].'">Supprimer</a></td>
                    <td><a href="modifusers.php?id='.$listuser['id'].'">Modifier</a></td>
            </tr>');
        } ?>
       
</table>
</div>




<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>
