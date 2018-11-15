<?php $title='Mes Vaccins'; ?>


<?php include('inc/pdo.php') ?>
<?php include('inc/fonction.php') ?>
<?php include('inc/header.php'); ?>
<?php

if (islogged()) {

  $iduser = $_SESSION['v3_user']['v3_id'];
  $errors = array();


  $sql = "SELECT * FROM v3_vac_vaccins ORDER BY statuts ASC";
      $query = $pdo->prepare($sql);
      $query->execute();
  $vaccins = $query->fetchAll();

  $sql = "SELECT id_vaccins FROM v3_users_vaccins WHERE id_user = :iduser";
      $query = $pdo->prepare($sql);
      $query->bindValue(':iduser',$iduser);
      $query->execute();
  $vaccinsUser = $query->fetchall();
  $vaccinUser = array();
  foreach ($vaccinsUser as $k) {
    $vaccinUser[] = $k['id_vaccins'];
  }

  // debug($vaccinUser);

  // ajout d'un vaccin a faire sur la table user_vaccin

  $sql = "SELECT * FROM v3_vac_vaccins AS vvv
              LEFT JOIN v3_users_vaccins AS vuv
              ON vvv.id = vuv.id_vaccins
              WHERE id_user = :iduser
              ORDER BY date, statuts ASC";
          $query = $pdo->prepare($sql);
          $query->bindValue(':iduser',$iduser);
          $query->execute();
  $verifVacId = $query->fetchAll();


  // debug($vaccins);



  if (!empty($_POST['submitted'])) {


    $dateVAC = trim(strip_tags($_POST['date']));
    $vaccinVAC = trim(strip_tags($_POST['vaccins']));

    // echo strtotime($dateVAC);

    if (strtotime("now") < strtotime($dateVAC)) {
      $dede = 'no';
    }else {
      $dede = 'yes';
    }

    if (validateDate($dateVAC,'Y-m-d')) {
      foreach ($vaccins as $vaccin) {
        if ($vaccinVAC == $vaccin['id']) {
          $idVac = $vaccin['id'];
        }
      }
      if (!empty($idVac)) {
        $sql = "INSERT INTO v3_users_vaccins (id_user, id_vaccins, created_at, date, fait) VALUES (:iduser, :idvaccins, NOW(), :date, :tr)";
            $query = $pdo->prepare($sql);
            $query->bindValue(':iduser',$iduser);
            $query->bindValue(':idvaccins',$idVac);
            $query->bindValue(':date',$dateVAC);
            $query->bindValue(':tr',$dede);
            $query->execute();

        header('Location: MesVaccins.php');

      }else{
        $errors['vaccins'] = 'veuillez rentrer un vaccin valide';
      }
    }else {
      $errors['date'] = 'veuillez rentrer une date valide';
    }


  }


  // affichée les vaccins A FAIRE dans l'ordre du plus proche collunm Date

  ?>
  <div class="background">
    <img src="asset/images/bg-banner1.png" alt="">
    <div class="contenu-image">
      <p>Ajouter, .</p>    </div>
  </div>
  <div class="wrapper-vaccins">


  <form class="form_vaccins" method="post">
    <p>Entrer la date</p>
    <input type="date" name="date" value=""><?php afficheErrors($errors,'date'); ?>
    <p>Vaccins</p>
    <select name="vaccins"><?php afficheErrors($errors,'vaccins'); ?>

      <?php


      foreach ($vaccins as $key) {

        if(!in_array($key['id'],$vaccinUser)){

          ?><option value="<?= $key['id'] ?>"><?= $key['nom'] ?><?php if ($key['Rappel'] != 0) {
            echo " || rappel tout les ".$key['Rappel'].'mois';
          } ?></option><?php

        }
      }

      ?>


    </select>
    <input type="submit" name="submitted" value="Ajouter">
    <div class="clear"></div>
  </form>
  </div>
  <?php
  if (!empty($verifVacId)) {
    ?>
    <table class="mesvaccins" style="text-align: center;">
        <tr>
            <th style="text-align: center;">Nom du vaccin</th>
            <th style="text-align: center;">Le contenue</th>
            <th style="text-align: center;">Statuts</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Rappel</th>
            <th style="text-align: center;">Supprimer</th>
        </tr>
        <?php
            //boucle pour integrer nos données pour remplir notre liste
            foreach ($verifVacId as $vvi) {
              if (!empty($vvi['fait']) && $vvi['fait'] == 'no') {
                ?><tr>
                    <td><?= $vvi['nom'] ?></td>
                    <td><?= $vvi['content'] ?></td>
                    <td><?php if ($vvi['statuts'] == 0) {
                      echo "recommander";
                    }else {
                      echo "Obligatoire";
                    }?></td>
                    <td>A faire le : <?= $vvi['date'] ?></td>
                    <?php if ($vvi['Rappel'] != 0) {
                      ?>
                      <td>recommander de le refaire dans <?= $vvi['Rappel'] ?> mois.</td><?php
                    }else{
                      ?><td>pas de recommandation</td> <?php
                    } ?>
                    <td><a href="deletevacuser.php?id=<?= $vvi['id']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce vaccin?')">Supprimer</a></td>
                </tr> <?php
              }
            }
            ?>
    </table>
    <table class="mesvaccins" style="text-align: center;">
        <tr>
            <th style="text-align: center;">Nom du vaccin</th>
            <th style="text-align: center;">Le contenue</th>
            <th style="text-align: center;">Statuts</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Rappel</th>
            <th style="text-align: center;">Supprimer</th>
        </tr>
    <?php

            foreach ($verifVacId as $vvi) {
              if (!empty($vvi['fait']) && $vvi['fait'] == 'yes' && $vvi['Rappel'] != 0) {
                ?><tr>
                    <td><?= $vvi['nom'] ?></td>
                    <td><?= $vvi['content'] ?></td>
                    <td><?php if ($vvi['statuts'] == 0) {
                      echo "recommander";
                    }else {
                      echo "Obligatoire";
                    }?></td>
                    <td>Fais le : <?= $vvi['date'] ?></td>
                    <td>recommander de le refaire dans <?= $vvi['Rappel'] ?> mois.</td>
                    <td><a href="deletevacuser.php?id=<?= $vvi['id']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce vaccin?')">Supprimer</a></td>
                  </tr>
                    <?php
              }
            }
            ?>
        </table>
      <table class="mesvaccins" style="text-align: center;">
        <tr>
            <th style="text-align: center;">Nom du vaccin</th>
            <th style="text-align: center;">Le contenue</th>
            <th style="text-align: center;">Statuts</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Supprimer</th>
        </tr>
        <?php

            foreach ($verifVacId as $vvi) {
              if (!empty($vvi['fait']) && $vvi['fait'] == 'yes' && $vvi['Rappel'] == 0) {
                ?><tr>
                    <td><?= $vvi['nom'] ?></td>
                    <td><?= $vvi['content'] ?></td>
                    <td><?php if ($vvi['statuts'] == 0) {
                      echo "recommander";
                    }else {
                      echo "Obligatoire";
                    }?></td>
                    <td>Fais le : <?= $vvi['date'] ?></td>
                    <td><a href="deletevacuser.php?id=<?= $vvi['id']; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce vaccin?')">Supprimer</a></td>
                  </tr>
                    <?php
              }
            }
  }
            ?>
      </table>

    <?php






}else{
  header('Location: connection.php');
}
include('inc/footer.php');
