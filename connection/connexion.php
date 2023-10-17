<?php
try {
    $bd = new PDO('mysql:host=localhost;dbname=vente', 'root', '');
} catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
}
