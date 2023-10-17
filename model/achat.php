<?php require_once '../connection/connexion.php';

//creation
if (isset($_POST['ajtVent'])) {

    if (!empty($_POST['qte']) && !empty($_POST['dateV']) && !empty($_POST['numVoi']) && !empty($_POST['numCli']) && !empty($_POST['numVent'])) {
        //var_dump('ato'); die;
        $qte = $_POST['qte'];
        $dateV = date('Y-m-d', strtotime($_POST['dateV']));
        $numVoi = $_POST['numVoi'];
        $numCli = $_POST['numCli'];
        $numVent = $_POST['numVent'];

        $donnees = $bd->query('SELECT * FROM voiture  WHERE idVoiture =' . $numVoi);
        $donnees->execute();
        $r = $donnees->fetch();
        if ($r['stock']) {
            if ((int)$r['stock'] < (int)$qte) {
                session_start();
                $_SESSION["error"] = "error";
                header("location: ../achat.php");
            } else {
                $reponse = $bd->prepare(' INSERT INTO vente(qte, dateVente, idVoiture, idClient, numVente) VALUES(?,?,?,?,?)');
                $stock = (int)$r['stock'] - (int)$qte;
                $updateStock = $bd->prepare(' UPDATE voiture set stock=? WHERE idVoiture=?');
                $reponse->execute(array($qte, $dateV, $numVoi, $numCli, $numVent));
                $updateStock->execute(array($stock, $numVoi));
                session_start();
                unset($_SESSION['error']);
                header("location: ../achat.php");
            }
        }
    } else {
        header("location: ../achat.php");
    }

}

//liste voiture vendu entre deux date
if (isset($_POST['liste'])) {

    if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $reponse = $bd->prepare('SELECT qte, dateVente, numVoiture,numClient FROM vente WHERE dateVente > date1 = ? AND dateVente < date2=? ');
        $reponse->execute(array($date1, $date2));
        header("location: ../achat.php");
    } else {
        header("location: ../achat.php");
    }

}


//suppresion
if (isset($_POST['suppr_Vent'])) {
    if (!empty($_POST['idVent'])) {
        $idVent = $_POST['idVent'];
        $idVoi = $_POST['idVoi'];
        $qte = $_POST['qte'];
        $reponse = $bd->prepare(' DELETE FROM vente WHERE idVente=? ');
        $reponse->execute(array($idVent));

        $donnee = $bd->query('SELECT * FROM vente 
                RIGHT JOIN voiture ON voiture.idVoiture = vente.idVoiture  WHERE voiture.idVoiture =' . $idVoi);
        $donnee->execute();
        $r = $donnee->fetch();

        $stock = (int)$r['stock'] + (int)$qte;
        $updateStock = $bd->prepare(' UPDATE voiture set stock=? WHERE idVoiture=?');
        $updateStock->execute(array($stock, $idVoi));
        header("location: ../achat.php");
    } else {
        header("location: ../achat.php");
    }
}
//modification
if (isset($_POST['modifVent'])) {
    if (!empty($_POST['idVent'])) {
        $idVent = $_POST['idVent'];
        $qte = $_POST['qte'];
        $numCli = $_POST['numCli'];
        $idVoiture = $_POST['idVoiture'];
        $dateV = date('Y-m-d', strtotime($_POST['dateV']));
        $numVent = $_POST['numVent'];
        $oldQte = $_POST['oldQte'];

        $donnees = $bd->query('SELECT * FROM vente 
                RIGHT JOIN voiture ON voiture.idVoiture = vente.idVoiture  WHERE voiture.idVoiture =' . $idVoiture);
        $donnees->execute();
        $r = $donnees->fetch();

        if ($r['stock']) {
            $stock_old = (int)$r['stock'] + (int)$oldQte;
            if ($stock_old < (int)$qte) {
                session_start();
                $_SESSION["error"] = "error";
                header("location: ../achat.php");
            } else {
                $reponse = $bd->prepare(' UPDATE vente set qte=?, dateVente=?, numVente=?, 	idClient=? WHERE idVente=?');
                $reponse->execute(array($qte, $dateV, $numVent, $numCli, $idVent));

                $stock = $stock_old - (int)$qte;
                $updateStock = $bd->prepare(' UPDATE voiture set stock=? WHERE idVoiture=?');
                $updateStock->execute(array($stock, $idVoiture));
                session_start();
                unset($_SESSION['error']);
                header("location: ../achat.php");
            }
        }

        header("location: ../achat.php");
    } else {
        header("location: ../achat.php");
    }

}
?>