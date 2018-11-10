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
        // debug($detailvaccins);
    }

?>





<?php include('inc/headerb.php'); ?>

    <h1>Détail du vaccin <?php foreach ($detailvaccins as $detailvaccin) { echo($detailvaccin['nom']) ?>: </h1>
        <table class="detailvaccins">
            <tr>
                <td>Nom</td>
                <td>Description</td>
                <td>Numero de lot</td>
                <td>Date d'entrée dans la BDD</td>
                <td>Date de modification dans la BDD</td>
                <td>Catégorie</td>
                <td>Statuts</td>
            </tr>
            
            <?php 
                    echo('<tr><td>'.$detailvaccin['nom'].'</td><td>'.$detailvaccin['content'].'</td><td>'.$detailvaccin['numerolot'].'</td><td>'.$detailvaccin['created_at'].'</td><td>'.$detailvaccin['updated_at'].'</td><td>'.$detailvaccin['categorie'].'</td><td>'.$detailvaccin['statuts'].'</td></tr>');
                }
            ?>
        </table>



<?php include('inc/footerb.php'); ?>