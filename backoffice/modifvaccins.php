<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>

<!-- Soumission du formulaire -->
<?php 
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM v3_vac_vaccins WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $modifvaccins = $query->fetch();
    debug($modifvaccins);
}
$error = array();
debug($error);
if (!empty($_POST['submittedmodif'])) {
    $modifnom = $_POST['nom'];
    $error = veriftext($error,$modifnom,'nom',3,50,$empty = true);

    $modifcontent = $_POST['content'];
    $error = veriftext($error,$modifcontent,'content',3,1000,$empty = true);

    $modifnumerolot = $_POST['numerolot'];
    $error = veriftext($error,$modifnumerolot,'numerolot',3,8,$empty = true);

    $modifcategorie = $_POST['categorievac'];
    // $error =  remplir($modifcategorie);

    $modifstatuts = $_POST['statuts'];

    if (count($error)==0) {
        $sql2 = "UPDATE `v3_vac_vaccins` SET `nom`= :nom,`content`= :content,`numerolot`= :numerolot,`updated_at`= NOW(),`categorie`= :categorievac,`statuts`= :statutsvac WHERE id = :id";
        $query2 = $pdo->prepare($sql2);
        $query2->bindValue(':nom', $modifnom, PDO::PARAM_STR);
        $query2->bindValue(':content', $modifcontent, PDO::PARAM_STR);
        $query2->bindValue(':numerolot', $modifnumerolot, PDO::PARAM_STR);
        $query2->bindValue(':categorievac', $modifcategorie, PDO::PARAM_STR);
        $query2->bindValue(':statutsvac', $modifstatuts, PDO::PARAM_STR);
        $query2->bindValue(':id', $id, PDO::PARAM_INT);
        $query2->execute();
    }
}



?>







<?php include('inc/headerb.php'); ?>

<form action="" method="post" class="form-horizontal">
        <label for="nom">Nom du vaccin: </label>
        <span><?php if (!empty($error['nom'])) { echo($error['nom']);} ?></span>
        <br><input type="text" name="nom" id="nom" value="">

        <br><label for="content">Description: </label>
        <br><input type="text" name="content" id="content" value="">

        <br><label for="numerolot">Numero du lot: </label>
        <br><input type="text" name="numerolot" id="numerolot" placeholder="G215468">
        
        <br><label for="categorievac">Catégorie du vaccin: </label>
        <br><input type="text" name="categorievac" id="categorievac" placeholder="Vivant ou Inactive">

        <br><label for="statuts">Obligatoire ou non: </label>
        <br><input type="text" name="statuts" id="statuts" placeholder="Obligatoire ou Recommande">

        <br><input type="submit" name="submittedmodif" id="submittedmodif" value="Envoyer">

</form>





<?php include('inc/footerb.php'); ?>