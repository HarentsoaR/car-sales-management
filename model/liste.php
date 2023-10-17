<?php require_once '../connection/connexion.php';

//liste voiture vendu entre deux date
if (isset($_POST['dateDebut']) AND isset($_POST['dateFin']) AND isset($_POST['numVoi'])) {

    $date1 = date('Y-m-d', strtotime($_POST['dateDebut']));
    $date2 = date('Y-m-d', strtotime($_POST['dateFin']));
    $voiture = $_POST['numVoi'];


    $query = $bd->prepare("SELECT vente.numVente AS numVente, vente.qte AS qte, vente.dateVente AS dateVente, 
              voiture.numVoiture AS numVoiture, client.nom AS nom
              FROM vente JOIN voiture ON voiture.idVoiture = vente.idVoiture 
                JOIN client ON client.idClient = vente.idClient 
                WHERE dateVente >= ? AND dateVente <= ?  AND voiture.idVoiture = ?");
    $query->execute(array($date1, $date2, $voiture));
    $reponse = $query->fetchAll();
    echo json_encode($reponse);

}

?>