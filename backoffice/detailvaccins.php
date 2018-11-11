<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>

<?php 
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM v3_vac_vaccins WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $detailvaccins = $query->fetchAll();
    }

        $sql2 = "SELECT updated_at FROM v3_vac_vaccins WHERE id = $id ";
        $query2 = $pdo->prepare($sql2);
        $query2->execute();
        $guit = $query2->fetch();
        debug($guit);
?>





<?php include('inc/headerb.php'); ?>

    <h1>Détail du vaccin <?php foreach ($detailvaccins as $detailvaccin) { 
        $datecreation =  date('d/m/Y', strtotime($detailvaccin['created_at'])); //Création de la variable pour afficher la date de création en français
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
                    echo('<tr><td>'.$detailvaccin['nom'].'</td><td>'.$detailvaccin['content'].'</td><td>'.$detailvaccin['numerolot'].'</td><td>'.$datecreation.'</td><td>'.$detailvaccin['updated_at'].'</td><td>'.$detailvaccin['categorie'].'</td><td>'.$detailvaccin['statuts'].'</td></tr>');
                }
            ?>
        </table>



<?php include('inc/footerb.php'); ?>