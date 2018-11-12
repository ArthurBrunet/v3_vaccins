<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $title ?></title>
    <link rel="stylesheet" href="asset/slicknav.css" />
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>

    <div id="wraper">

    <header id="header">
      <a href="#" class="header-hamburger"></a>
        <div class="logo">
            <img src="asset/images/logose.svg" alt="">
        </div>
        <div class="nav">
          <ul id="menu">
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="<?php if (isLogged()) {
              echo "MesVaccins.php";
            }else {
              echo "connection.php";
            } ?>">Mes vaccins</a></li>
            <li><a href="Quisommesnous.php">Qui sommes-nous?</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <?php if (isLogged()) {
              ?><li><a href="deconnexion.php">Deconnexion</a></li><?php
            }else {
              ?><li><a href="connection.php">Connexion</a></li>
              <li><a href="inscription.php">Inscription</a></li><?php
            } ?>
          </ul>

        </div>

    </div>
    <div class="clear"></div>
    </header>
    <div class="block">
    </div>
