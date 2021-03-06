<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>


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

        // Definition de la variable rappel
        if (is_numeric($_POST['rappel'])){
            $rappelvaccin = $_POST['rappel'];
        }else{
            $error['rappel'] = 'Veuillez entrer un nombre';
        }

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
   
                //Requete pour remplir notre base de données des vaccins
                    if (count($error)==0) {
                    $sql="INSERT INTO v3_vac_vaccins(nom, content, categorie, statuts, numerolot, Rappel, created_at) VALUES ( :nom, :content, :categorievac, :statuts, :numerolot, :rappel, NOW())";
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':nom', $nomvaccin, PDO::PARAM_STR);
                    $query->bindValue(':content', $contentvaccin, PDO::PARAM_STR);
                    $query->bindValue(':numerolot', $numerolot, PDO::PARAM_STR);
                    $query->bindValue(':categorievac', $categorievac, PDO::PARAM_STR);
                    $query->bindValue(':statuts', $modifstatuts, PDO::PARAM_STR);
                    $query->bindValue(':rappel', $rappelvaccin, PDO::PARAM_INT);
                        $query->execute();
                    header('Location: listvaccins.php');
                    }
    }


?>







<?php include('inc/headerb.php'); ?>
    <div class="body collapse in col-lg-6 box col-lg-12" style="position: absolute; left: 20%; top: 20%; bottom: 20%; right: 20%;">
    <form action="" method="post" class="form-horizontal">

        <label for="nom">Nom du vaccin: </label>
        <span> <?php if (!empty($error['nom'])) { echo($error['nom']); } ?></span>
        <br><input type="text" name="nom" id="nom" value="" class="col-lg-8 form-control">

        <br><label for="numerolot">Numero du lot: </label>
        <span> <?php if (!empty($error['numerolot'])) { echo($error['numerolot']); } ?></span>
        <br><input type="text" name="numerolot" id="numerolot" placeholder="G215468" class="col-lg-8 form-control">

        <br><label for="categorievac">Catégorie du vaccin: </label>
        <span><?php if (!empty($error['categorievac'])) { echo($error['categorievac']);} ?></span>
        <br><input type="radio" name="categorievac" id="categorievac" value="1"><label for="categorievac">Vivant</label>
        <br><input type="radio" name="categorievac" id="categorievac" value="0"><label for="categorievac">Inactive</label>


        <br><label for="statuts">Statuts: </label>
        <span><?php if (!empty($error['statuts'])) { echo($error['statuts']);} ?></span>
        <br><input type="radio" name="statuts" id="statuts" value="Obligatoire"><label for="statuts">Obligatoire</label>
        <br><input type="radio" name="statuts" id="statuts" value="Recommander"><label for="statuts">Recommander</label>

        <br><label for="rappel">Rappel du vaccin, si pas de rappel ne pas remplir:</label>
        <span><?php if (!empty($error['rappel'])) {echo $error['rappel'];}?></span>
        <br><input type="number" name="rappel" placeholder="Veuillez entrer le nombre de mois" class="form-control col-lg-6 ">

        <br><label for="content">Description: </label>
        <span> <?php if (!empty($error['content'])) { echo($error['content']); } ?></span>
        <br><textarea name="content" id="content" cols="80" rows="3" placeholder="Veuillez entrer la description du vaccin" class="form-control"></textarea>

        <div class="input" style="text-align: center;">
        <br><input type="submit" name="submittedvaccin" id="submittedvaccin" value="Envoyer" class="btn btn-metis-5 btn-round" style="margin: auto;">
        </div>
</form>
</div>




<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>