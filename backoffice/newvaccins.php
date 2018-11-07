<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>

<!-- Soumission du formulaire -->
<?php 
$error=array();
// debug($error);
    if (!empty($_POST['submittedvaccin'])) {

        $nomvaccin=trim(strip_tags($_POST['nom']));
        $error = veriftext($error,$nomvaccin,'nom',3,50);

        $contentvaccin=trim(strip_tags($_POST['content']));
        $error = veriftext($error,$contentvaccin,'content',3,1000);

        $categorievac = $_POST['categorievac'];

        if (count($error)==0) {
        $sql="INSERT INTO vaccins(vac_nom, vac_content, vac_categorie) VALUES ( :nom, :content, :categorievac)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $nomvaccin, PDO::PARAM_STR);
        $query->bindValue(':content', $contentvaccin, PDO::PARAM_STR);
        $query->bindValue(':categorievac', $categorievac, PDO::PARAM_STR);
        $query->execute();
        }

    }


?>
<!-- Requete pour inserer un nouveau vaccin dans sql -->







<?php include('inc/headerb.php'); ?>

<form action="" method="post" class="newvaccin">
        <label for="nom">Nom du vaccin: </label>
        <span> <?php if (!empty($error['nom'])) { echo($error['nom']); } ?></span>
        <br><input type="text" name="nom" id="nom" value="">

        <br><label for="content">Description: </label>
        <span> <?php if (!empty($error['content'])) { echo($error['content']); } ?></span>
        <br><input type="text" name="content" id="content" value="">

        <br><label for="categorievac">Catégorie du vaccin: </label>
        <br><input type="radio" name="categorievac" id="categorievac" value="Vivant"><label for="Vivant">Vivant</label>
        <input type="radio" name="categorievac" id="categorievac" value="Inactive"><label for="Inactive">Inactive</label>
        <br><input type="submit" name="submittedvaccin" id="submittedvaccin" value="Envoyer">

</form>





<?php include('inc/footerb.php'); ?>