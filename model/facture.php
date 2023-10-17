<?php require_once '../connection/connexion.php';
//liste voiture vendu entre deux date
if (isset($_POST['dateDebut']) AND isset($_POST['dateFin']) AND isset($_POST['idCli'])) {

    $date1 = date('Y-m-d', strtotime($_POST['dateDebut']));
    $date2 = date('Y-m-d', strtotime($_POST['dateFin']));
    $idCli = $_POST['idCli'];
    $query = $bd->prepare("SELECT voiture.numVoiture AS numVoiture, voiture.Marque AS marque, voiture.Pu AS PU, 
              vente.qte AS qte, client.numClient AS numCli
              FROM voiture JOIN vente ON voiture.idVoiture = vente.idVoiture 
                JOIN client ON client.idClient = vente.idClient 
                WHERE dateVente >= ? AND dateVente <= ?  AND client.idClient = ?");
    $query->execute(array($date1, $date2, $idCli));
    $reponse = $query->fetchAll();
    echo json_encode($reponse);

}

?>