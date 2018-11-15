<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php 
  if (isadmin()){ ?>
<?php
    $sql = "SELECT COUNT('id') FROM v3_vac_users ";
      $query = $pdo->prepare($sql);
      $query->execute();
      $nmbusers = $query->fetchColumn();

      $sql2 = "SELECT COUNT('id') FROM v3_vac_vaccins";
      $query2 = $pdo->prepare($sql2);
      $query2->execute();
      $nmbvaccins = $query2->fetchColumn();

?>



<?php include('inc/headerb.php'); ?>
      <div class="text-center" style="margin-top: 100px;">
          <p style="color: #333bff; font-size: 1.5em;">Bienvenue sur votre Back-Office du carnet de vaccination. Vous pourrez gérer à partir de cette partie, la liste des vaccins disponibles sur le site et effectué des modifications si besoin est.
              <br>Vous avez également une partie utilisateur pour modifier les emails ou rôles si à l'avenir vous avez d'autres personnes à mettre administrateurs. </p>
          <p style="font-size: 1.4em; color: #333bff">Sur cette première page, vous avez les statistiques principales avec le nombre d'inscrits et le nombre de vaccins répertorié.</p>
      </div>

      <div class="text-center" style="padding-top: 100px;">
          <ul class="stats_box">
              <li>
                  <div class="sparkline bar_week"><img src="../backoffice/asset/images/images.png" alt="" class="media-object img-thumbnail user-img" style="width: 60px; height: 60px; margin-top: -5px;"></div>
                  <div class="stat_text">
                      <strong>Nombre d'inscrit <br>sur le site</strong>
                      <br><span class="percent down"><br><?= $nmbusers ?></span>
                  </div>
              </li>
              <li>
                  <div class="sparkline line_day"><img src="../backoffice/asset/images/vaccins.jpg" alt="" class="media-object img-thumbnail user-img" style="width: 60px; height: 60px; margin-top: -5px;"></div>
                  <div class="stat_text">
                      <strong>Nombre de vaccins <br> sur le site</strong>
                      <br><span class="percent up"><br><?= $nmbvaccins ?></span>
                  </div>
              </li>
          </ul>
      </div>





<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>
