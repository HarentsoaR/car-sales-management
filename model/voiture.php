<?php require_once '../connection/connexion.php';
//creation
if (isset($_POST['add_car'])) {
    if (!empty($_POST['numVoi']) && !empty($_POST['marq']) && !empty($_POST['pu']) && !empty($_POST['stock'])) {
        $numVoi = $_POST['numVoi'];
        $marque = $_POST['marq'];
        $pu = $_POST['pu'];
        $stock = $_POST['stock'];
        $reponse = $bd->prepare(' INSERT INTO voiture(numVoiture, Marque, Pu, stock) VALUES(?,?,?,?)');
        $reponse->execute(array($numVoi, $marque, $pu, $stock));

        header("location: ../voiture.php");
    } else {
        header("location: ../voiture.php");
    }
}
//suppresion
if (isset($_POST['delete_car'])) {
    if (!empty($_POST['id_voiture'])) {
        $idVoi = $_POST['id_voiture'];
        $reponse = $bd->prepare(' DELETE FROM voiture WHERE idVoiture=? ');
        $reponse->execute(array($idVoi));
        header("location: ../voiture.php");
    } else {
        header("location: ../voiture.php");
    }
}
//modification
if (isset($_POST['update_car'])) {
    if (!empty($_POST['id_voiture'])) {
        $idVoiture = $_POST['id_voiture'];
        $numVoi = $_POST['numVoi'];
        $marque = $_POST['marq'];
        $pu = $_POST['pu'];
        $stock = $_POST['stock'];
        $reponse = $bd->prepare(' UPDATE voiture set numVoiture=?, Marque=?, Pu=?, stock=? WHERE idVoiture=?');
        $reponse->execute(array($numVoi, $marque, $pu, $stock, $idVoiture));
        header("location: ../voiture.php");
    } else {
        header("location: ../voiture.php");
    }

}
?>