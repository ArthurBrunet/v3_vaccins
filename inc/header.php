<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $title ?></title>
    <link rel="stylesheet" href="asset/slicknav.css" />
    <link rel="stylesheet" href="asset/style.css">
    <!-- <link rel="stylesheet" href="/css/master.css"> -->
    <link rel="icon" type="image/ico" href="asset/images/medical-history.ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>




</head>
<body>

    <div id="wraper">

    <header id="header">
      <div class="center">


      <a href="#" class="header-hamburger"></a>
        <div class="logo">
          <a href="index.php"><img src="asset/images/medical-history.svg" alt=""></a>
        </div>
        <div class="nav">
          <ul id="menu">
            <li><a href="index.php">Accueil</a></li>

            <li><a href="<?php if (isLogged()) {
              echo "MesVaccins.php";
            }else {
              echo "connection.php";
            } ?>">Mes vaccins</a></li>

            <?php if (isLogged()) {
              ?><li><a href="deconnexion.php">Deconnexion</a></li><?php
            }else {
              ?><li><a href="connection.php">Connexion</a></li>

              <li><a href="inscription.php">Inscription</a></li><?php
            } ?>
            <li><?php if (isadmin()) {
              echo '<a href ="backoffice/dashboard.php">Backoffice</a>';
            }else {

            } ?></li>
          </ul>


    <!-- <div class="clear"></div> -->
    </header>
    </div>
    <div class="clear">

    </div>
    <div class="block">
    </div>
