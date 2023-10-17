<?php require_once '../connection/connexion.php';
//creation
if (isset($_POST['ajtCli'])) {
    if (!empty($_POST['numCli']) && !empty($_POST['nomCli'])) {

        $numCli = $_POST['numCli'];
        $nomCli = $_POST['nomCli'];

        $reponse = $bd->prepare(' INSERT INTO client(numClient, nom) VALUES(?,?)');
        $reponse->execute(array($numCli, $nomCli));

        header("location: ../index.php");
    }
}

//recherche
if (isset($_POST['search_client'])) {
    if (!empty($_POST['idClient'])) {
        $reponse = $bd->prepare('SELECT numClient,nom FROM client WHERE idClient=? ');
        $reponse->execute(array($_POST['idClient']));
        $data = $reponse->fetch();
        echo $data['numClient'] . ' - ' . $data['nom'];
    } else {
        header("location: ../index.php");
    }

}

//suppresion
if (isset($_POST['delete_client'])) {
    if (!empty($_POST['idClient'])) {
        $idClient = $_POST['idClient'];
        $reponse = $bd->prepare(' DELETE FROM client WHERE idClient=? ');
        $reponse->execute(array($idClient));
        header("location: ../index.php");
    } else {
        header("location: ../index.php");
    }
}
//modification
if (isset($_POST['update_client'])) {
    if (!empty($_POST['idClient'])) {

        $idClient = $_POST['idClient'];
        $numCli = $_POST['numCli'];
        $nomCli = $_POST['nomCli'];

        $reponse = $bd->prepare(' UPDATE client set numClient=?, nom=? WHERE idClient=?');
        $reponse->execute(array($numCli, $nomCli, $idClient));
        header("location: ../index.php");
    } else {
        header("location: ../index.php");
    }

}
?>