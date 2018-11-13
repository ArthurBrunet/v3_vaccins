<?php include('../inc/pdo.php'); ?>
<?php include('../inc/fonction.php'); ?>
<?php if (isadmin()) { ?>


<?php
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql2 = "SELECT * FROM v3_vac_vaccins AS v, v3_users_vaccins AS u WHERE v.id = u.id_vaccins AND u.id_user = $_GET[id]";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $vacusers = $query2->fetchAll();
    // debug($vacusers);
}else {
    header('Location: ../404.php');
}

?>

<?php include('inc/headerb.php'); ?>
<div class="col-lg-12 ui-sortable">
<table class="table table-bordered table-condensed table-hover table-striped dataTable no-footer">
    <tr>
        <th style="text-align: center;">Vaccins</th>
        <th style="text-align: center;">Date du vaccin</th>
    </tr>
    <?php 
        foreach ($vacusers as $vacuser) {
            $datevaccin = date('d/m/Y', strtotime($vacuser['date']));
            echo('<tr>
                <td style="text-align: center;">'.$vacuser['nom'].'</td>
                <td style="text-align: center;">'.$datevaccin.'</td>
            </tr>');
        }

    ?>
</table>
</div>
<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0">Next</a></li></ul></div>




<?php include('inc/footerb.php'); ?>

 <?php }
 else {
     header('Location: ../403.php');
 } 
 ?>