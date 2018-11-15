<?php include('inc/pdo.php'); ?>
<?php include('inc/fonction.php');



if (!empty($_GET['id'])&&is_numeric($_GET['id'])) {
    $id = $_GET['id'];
        $sql = "DELETE FROM v3_users_vaccins WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id',$id, PDO::PARAM_STR);
        $query->execute();
        header('Location: MesVaccins.php');

}
