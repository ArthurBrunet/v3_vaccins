<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>
<?php if (isadmin()) { ?>

<?php 

    $sql = "SELECT COUNT(*) FROM v3_vac_users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    //debug($count);

    $num = 10;
    $page = 1;
    $offset = 0;

    //écrasée par celui de l'URL si get['page'] n'est pas vide
    if (!empty($_GET['page'])){
        $page = $_GET['page'];
        $offset = $page * $num - $num;
    }

     $sql = "SELECT * FROM v3_vac_users ORDER BY role DESC
            LIMIT $offset,$num";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listusers = $query->fetchAll();
    // debug($listusers);


    ?>
    






<?php include('inc/headerb.php'); ?>
    <h2 style="text-align: center">Liste des Utilisateurs inscrits actuellement sur le site</h2>
<div class="col-lg-12 ui-sortable">
    <?php echo paginationIdeausers($page,$num,$count) ?>
<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer" style="text-align: center;">
    <tr>
        <th style="text-align: center;">Adresse Mail</th>
        <th style="text-align: center;">Les Vaccins</th>
        <th style="text-align: center;">Rôle</th>
        <th style="text-align: center;">Création du compte</th>
        <th style="text-align: center;">Modification du compte</th>
        <th style="text-align: center;">Modifier</th>
        <th style="text-align: center;">Supprimer</th>
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
                    <td><a href="modifusers.php?id='.$listuser['id'].'">Modifier</a></td>
                    <td><a href="deleteusers.php?id='.$listuser['id'].'"  onclick="return confirm(\'Etes vous sur de vouloir supprimer cet utilisateur?\')">Supprimer</a></td>

            </tr>');
        } ?>
       
</table>
    <?php echo paginationIdeausers($page,$num,$count) ?>
</div>




<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>
