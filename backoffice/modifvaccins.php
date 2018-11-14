<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>

<!-- Soumission du formulaire -->
<?php
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM v3_vac_vaccins WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $modifvaccins = $query->fetch();
    // debug($modifvaccins);
    //on créer des variables pour pouvoir appeler nos valeurs enregistre en BDD sur le formulaire
    $modifvaccinsnom = $modifvaccins['nom'];
    $modifvaccinscontent = $modifvaccins['content'];
    $modifvaccinslot = $modifvaccins['numerolot'];

}else {
    header('Location: ../404.php');
}
$error = array();
// debug($error);
//soumission du formulaire
if (!empty($_POST['submittedmodif'])) {
    //verif des erreurs
    $modifnom = $_POST['nom'];
    $error = veriftext($error,$modifnom,'nom',3,50,$empty = true);

    $modifcontent = $_POST['content'];
    $error = veriftext($error,$modifcontent,'content',3,1000,$empty = true);

    $modifnumerolot = $_POST['numerolot'];
    $error = veriftext($error,$modifnumerolot,'numerolot',3,8,$empty = true);
    //on créer des conditions pour les boutons input pour afficher une erreur
    if (isset($_POST['categorievac'])){
        $categorievac = $_POST['categorievac'];
    }else {
          $error['categorievac'] = 'Veuillez selectionnez une option';
    }
    if (isset($_POST['statuts'])){
        $modifstatuts = $_POST['statuts'];
    }else {
          $error['statuts'] = 'Veuillez selectionnez une option';
    }
    //on fait appel a une requete pour la modif
    if (count($error)==0) {
        $sql2 = "UPDATE `v3_vac_vaccins` SET `nom`= :nom,`content`= :content,`numerolot`= :numerolot,`updated_at`= NOW(),`categorie`= :categorievac,`statuts`= :statutsvac WHERE id = :id";
        $query2 = $pdo->prepare($sql2);
        $query2->bindValue(':nom', $modifnom, PDO::PARAM_STR);
        $query2->bindValue(':content', $modifcontent, PDO::PARAM_STR);
        $query2->bindValue(':numerolot', $modifnumerolot, PDO::PARAM_STR);
        $query2->bindValue(':categorievac', $categorievac, PDO::PARAM_STR);
        $query2->bindValue(':statutsvac', $modifstatuts, PDO::PARAM_STR);
        $query2->bindValue(':id', $id, PDO::PARAM_INT);
        $query2->execute();
        header('Location: listvaccins.php');
    }
}



?>







<?php include('inc/headerb.php'); ?>
    <div class="body collapse in col-lg-6 box col-lg-12" style="margin-left: 475px; margin-top: 150px;">
        <form action="" method="post" class="form-horizontal">
                <label for="nom">Nom du vaccin: </label>
                <span><?php if (!empty($error['nom'])) { echo($error['nom']);} ?></span>
                <br><input type="text" name="nom" id="nom" value="<?php if (!empty($_POST['nom'])) { echo($_POST['nom']);} else{ echo($modifvaccinsnom);} ?>" class="col-lg-8 form-control">

                <br><label for="numerolot">Numero du lot: </label>
                <br><input type="text" name="numerolot" id="numerolot" value="<?php if (!empty($_POST['numerolot'])) { echo($_POST['numerolot']);} else{ echo($modifvaccinslot);} ?>" class="col-lg-8 form-control">

                <br><label for="categorievac">Catégorie du vaccin: </label>
                <span><?php if (!empty($error['categorievac'])) { echo($error['categorievac']);} ?></span>
                <br><input type="radio" name="categorievac" id="categorievac" value="1"><label for="categorievac">Vivant</label>
                <br><input type="radio" name="categorievac" id="categorievac" value="0"><label for="categorievac">Inactive</label>


                <br><label for="statuts">Statuts: </label>
                <span><?php if (!empty($error['statuts'])) { echo($error['statuts']);} ?></span>
                <br><input type="radio" name="statuts" id="statuts" value="1"><label for="statuts">Obligatoire</label>
                <br><input type="radio" name="statuts" id="statuts" value="0"><label for="statuts">Recommander</label>

                <br><label for="content">Description: </label>
                <br><textarea name="content" id="content" cols="80" rows="5" class="form-control"><?php if (!empty($_POST['content'])) { echo($_POST['content']);} else{ echo($modifvaccinscontent);} ?></textarea>

            <div class="input" style="text-align: center;">
            <br><input type="submit" name="submittedmodif" id="submittedmodif" value="Envoyer" class="btn btn-metis-5 btn-round">
            </div>
        </form>
    </div>





<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>