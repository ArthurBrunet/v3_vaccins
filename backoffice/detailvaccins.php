<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>



<?php 
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM v3_vac_vaccins WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $detailvaccins = $query->fetchAll();
    }

        
?>





<?php include('inc/headerb.php'); ?>

    <h1>Détail du vaccin <?php foreach ($detailvaccins as $detailvaccin) { // Mon foreach est en haut car je voulais faire apparaitre le nom du vaccin dans le titre
        $datecreation =  date('d/m/Y', strtotime($detailvaccin['created_at'])); //Création de la variable pour afficher la date de création en français
        if (!empty($detailvaccin['updated_at'])) { //Création de la variable modifier pour la date de modif dans la BDD et ne pas oublier que !empty veut dire la meeme chose que 'pas null'
            $modifvaccin = date('d/m/Y', strtotime($detailvaccin['updated_at']));
        }else{
            $modifvaccin = 'Il n\'as pas encore été modifié';
        }
        if($detailvaccin['categorie'] == 1){ //Condition pour transformer les chiffres en BDD en variables sur la liste des vaccins
            $detailvaccinc = 'Vivant';
        }else {
            $detailvaccinc = 'Inactive';
        }
        if ($detailvaccin['statuts'] == 1) { //Condition pour transformer les chiffres en BDD en variables sur la liste des vaccins
            $detailvaccinst = 'Obligatoire';
        }else {
            $detailvaccinst = 'Recommander';
        }

        echo($detailvaccin['nom']) ?>: </h1>
        
        <table id="defaultTable" class="table responsive-table">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Numero de lot</th>
                <th>Date d'entrée</th>
                <th>Date de modification</th>
                <th>Catégorie</th>
                <th>Statuts</th>
            </tr>
            
            <?php 
                    echo('<tr><td>'.$detailvaccin['nom'].'</td><td>'.$detailvaccin['content'].'</td><td>'.$detailvaccin['numerolot'].'</td><td>'.$datecreation.'</td><td>'.$modifvaccin.'</td><td>'.$detailvaccinc.'</td><td>'.$detailvaccinst.'</td></tr>');
                }
            ?>
        </table>



<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>