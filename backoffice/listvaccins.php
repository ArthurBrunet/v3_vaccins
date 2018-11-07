<?php include('../inc/fonction.php'); ?>
<?php include('../inc/pdo.php'); ?>

<!-- Requete pour appeler la table de la vaccination -->


<?php include('inc/headerb.php'); ?>
<h1>Listing des vaccins</h1>
<p>Voici un listing de tout les vaccins figurant sur le site. Il y a bien les vaccins obligatoires comme les vaccins non obligatoires.</p>
<p>Si vous souhaitez ajouter un nouveau alors il vous suffit de <a href="newvaccins.php">Cliquez ici</a> </p>

<table>
    <tr>
        <td>Nom du vaccin</td>
        <td>Numéro de lot</td>
        <td>Voie administrative</td>
        <td>Modification</td>
        <td>Statut</td>
    </tr>
</table>





<?php include('inc/footerb.php'); ?>