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

        $numerolot = trim(strip_tags($_POST['numerolot']));
        $error = veriftext($error,$numerolot,'numerolot',3,8);

        $categorievac = $_POST['categorievac'];

        $statuts = $_POST['statuts'];
        //Requete pour remplir notre base de données des vaccins
        if (count($error)==0) {
        $sql="INSERT INTO vac_vaccins(nom, content, categorie, statuts, numerolot, created_at) VALUES ( :nom, :content, :categorievac, :statuts, :numerolot, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $nomvaccin, PDO::PARAM_STR);
        $query->bindValue(':content', $contentvaccin, PDO::PARAM_STR);
        $query->bindValue(':numerolot', $numerolot, PDO::PARAM_STR);
        $query->bindValue(':categorievac', $categorievac, PDO::PARAM_STR);
        $query->bindValue(':statuts', $statuts, PDO::PARAM_STR);
        $query->execute();
        }

    }


?>







<?php include('inc/headerb.php'); ?>

<form action="" method="post" class="newvaccin">
        <label for="nom">Nom du vaccin: </label>
        <span> <?php if (!empty($error['nom'])) { echo($error['nom']); } ?></span>
        <br><input type="text" name="nom" id="nom" value="">

        <br><label for="content">Description: </label>
        <span> <?php if (!empty($error['content'])) { echo($error['content']); } ?></span>
        <br><input type="text" name="content" id="content" value="">

        <br><label for="numerolot">Numero du lot: </label>
        <span> <?php if (!empty($error['numerolot'])) { echo($error['numerolot']); } ?></span>
        <br><input type="text" name="numerolot" id="numerolot" placeholder="G215468">
        
        <br><label for="categorievac">Catégorie du vaccin: </label>
        <br><input type="radio" name="categorievac" id="categorievac" value="vivant"><label for="Vivant">Vivant</label>
        <input type="radio" name="categorievac" id="categorievac" value="inactive"><label for="Inactive">Inactive</label>

        <br><label for="statuts">Obligatoire ou non: </label>
        <br><input type="radio" name="statuts" id="statuts" value="recommande"><label for="recommande">Recommandé</label>
        <input type="radio" name="statuts" id="statuts" value="obligatoire"><label for="obligatoire">Obligatoire</label>

        <br><input type="submit" name="submittedvaccin" id="submittedvaccin" value="Envoyer">

</form>





<?php include('inc/footerb.php'); ?>