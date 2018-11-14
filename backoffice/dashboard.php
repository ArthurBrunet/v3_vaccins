<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php 
  if (isadmin()){ ?>




<?php include('inc/headerb.php'); ?>

      <div class="text-center">
          <ul class="stats_box">
              <li>
                  <div class="sparkline bar_week"></div>
                  <div class="stat_text">
                      <strong>2.345</strong>Weekly Visit
                      <span class="percent down"> <i class="fa fa-caret-down"></i> -16%</span>
                  </div>
              </li>
              <li>
                  <div class="sparkline line_day"></div>
                  <div class="stat_text">
                      <strong>165</strong>Daily Visit
                      <span class="percent up"> <i class="fa fa-caret-up"></i> +23%</span>
                  </div>
              </li>
              <li>
                  <div class="sparkline pie_week"></div>
                  <div class="stat_text">
                      <strong>$2 345.00</strong>Weekly Sale
                      <span class="percent"> 0%</span>
                  </div>
              </li>
              <li>
                  <div class="sparkline stacked_month"></div>
                  <div class="stat_text">
                      <strong>$678.00</strong>Monthly Sale
                      <span class="percent down"> <i class="fa fa-caret-down"></i> -10%</span>
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
