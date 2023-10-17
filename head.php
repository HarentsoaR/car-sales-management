<?php require_once 'connection/connexion.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gestion_vente</title>
    <link rel="stylesheet" href="web/css/bootstrap.min.css" >
    <link rel="stylesheet" href="web/css/dataTables.bootstrap4.min.css" >
    <link rel="stylesheet" href="web/css/sb2-css.css" >
    <link rel="stylesheet" href="web/css/style.css" >
    <link rel="stylesheet" href="web/css/font/css/font-awesome.css" >
    <link rel="stylesheet" href="web/css/date/bootstrap-datetimepicker.min.css" >
    <script src="web/js/jquery-3.3.1.min.js"></script>
    <script src="web/js/bootstrap.min.js"></script>
    <script src="web/js/jquery.dataTables.min.js"></script>
    <script src="web/js/dataTables.bootstrap4.min.js"></script>
    <script src="web/js/date/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <a class="navbar-brand" href="#">Gestion des ventes des voitures</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Clients<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="voiture.php">Voitures<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="achat.php">Ventes<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listage.php">Etat de stock<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="facture.php">Facture<span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main role="main" class="container-fluid mt-md-5"><br>

