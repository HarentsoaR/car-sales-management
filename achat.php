<?php require_once "head.php" ?>
    <div class="row">
        <div class="col-12">
            <?php
                session_start();
                if(isset($_SESSION["error"])):
            ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Erreur!</strong> <a href="#" class="alert-link">Le nombre de stock est insuffisant, veuillez le modifier svp !!</a>
                </div>
            <?php endif;?>
            <fieldset class="scheduler-border">
                <legend>Vente d'une voiture</legend>
                <form action="model/achat.php" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Numéro de vente :</label>
                                <input type="text" required name="numVent" class="form-control" placeholder="Numéro de vente">
                            </div>
                            <div class="form-group">
                                <label>Choix de la Voiture :</label>
                                <select name="numVoi" class="form-control" required>
                                    <option value="">Choix N° ...</option>
                                    <?php
                                    //choix Voiture
                                    $reponse = $bd->query('SELECT * from voiture');
                                    while ($donnee = $reponse->fetch()) : ?>
                                        <option value="<?php echo $donnee['idVoiture']; ?>"> <?php echo $donnee['Marque']; ?> </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nom du du client :</label>
                                <select name="numCli" required class="form-control">
                                    <option value="">Choix N° ...</option>
                                    <?php
                                    //choix Client
                                    $reponse = $bd->query('SELECT * from client');
                                    while ($donnee = $reponse->fetch()) : ?>
                                        <option value="<?php echo $donnee['idClient']; ?>"> <?php echo $donnee['nom']; ?> </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité :</label>
                                <input required type="number" name="qte" class="form-control" placeholder="Qte">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Date de vente :</label>
                                <input required
                                       name="dateV"
                                       placeholder="YYYY-MM-DD"
                                       class="form-control"
                                       type="date"/>
                            </div>
                        </div>
                    </div>

                    <button type="submit" style="float: right" name="ajtVent" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Acheter</button>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered" id="table-vente" width="100%">
                <thead >
                <tr>
                    <th scope="col">N° de vente</th>
                    <th scope="col">Qté</th>
                    <th scope="col">Date de vente</th>
                    <th scope="col">N° de la voiture</th>
                    <th scope="col">Nom du client</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                <?php
                //recuperation de tous les donnees de la bdd
                $reponse = $bd->query('SELECT * FROM vente 
                JOIN voiture ON voiture.idVoiture = vente.idVoiture 
                JOIN client ON client.idClient = vente.idClient');
                $reponse->execute();
                $data =  $reponse->fetchAll();
                $i = 0;
                //affichage ligne par ligne
                foreach ($data as $donnees):?>
                    <tr>
                        <td><?php echo $donnees['numVente']; ?></td>
                        <td><?php echo $donnees['qte']; ?></td>
                        <td><?php echo $donnees['dateVente']; ?></td>
                        <td><?php echo $donnees['numVoiture'].' ('.$donnees['Marque'].')'; ?></td>
                        <td><?php echo $donnees['numClient'].' ('. $donnees['nom'].')'; ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#ll<?php echo $i; ?>"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#jl<?php echo $i; ?>"><i class="fa fa-trash-o"></i>
                            </button>
                            <!--<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#dl<?php echo $i; ?>"><i class="fa fa-share"></i>
                            </button>-->
                        </td>
                    </tr>
                    <div id="jl<?php echo $i; ?>" class="modal fade " role="dialog" aria-labelledby="myLargeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-sm">

                            <div class="modal-content">
                                    <form method="post" action="model/achat.php">
                                        <input name="idVent" type="" value="<?php echo $donnees['idVente']; ?>" hidden>
                                        <input name="idVoi" type="" value="<?php echo $donnees['idVoiture']; ?>" hidden>
                                        <input name="qte" type="" value="<?php echo $donnees['qte']; ?>" hidden>
                                        <div class="modal-header">
                                            <label class="modal-title" id="exampleModalLabel">
                                                Voulez vous supprimer la ligne de vente N° <?= $donnees['numVente'] ?>,
                                                de la voiture N° <?= $donnees['numVoiture'] ?>
                                            </label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button name="suppr_Vent" class="btn btn-danger btn-sm">
                                                Valider
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                Annuler
                                            </button>
                                        </div>

                                    </form>
                            </div>
                        </div>
                    </div>
                    <div id="dl<?php echo $i; ?>" class="modal fade " role="dialog" aria-labelledby="myLargeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Liste de vente entre 2 dates</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="model/achat.php">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date 1:</label>
                                            <input type="date" name="date1" class="form-control" placeholder="YYYY-MM-DD">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Date 2</label>
                                            <input type="date" name="date2" class="form-control" placeholder="YYYY-MM-DD">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="liste" class="btn btn-warning btn-sm">Afficher</button>
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="ll<?php echo $i; ?>" class="modal fade " role="dialog" aria-labelledby="myLargeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modification d'une vente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="model/achat.php">
                                    <input name="idVent" type="hidden" value="<?php echo $donnees['idVente']; ?>">
                                    <input name="oldQte" type="hidden" value="<?php echo $donnees['qte']; ?>">
                                    <input name="idVoiture" type="hidden" value="<?php echo $donnees['idVoiture']; ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Numéro de vente</label>
                                            <input type="text"
                                                   name="numVent"
                                                   required
                                                   value="<?php echo $donnees['numVente']; ?>"
                                                   class="form-control"
                                                   placeholder="N° vente">
                                        </div>
                                        <div class="form-group">
                                            <label>Nom du du client :</label>
                                            <select name="numCli" required class="form-control">
                                                <option value="">Choix N° ...</option>
                                                <?php
                                                //choix Client
                                                $reponse = $bd->query('SELECT * from client');
                                                while ($client = $reponse->fetch()) : ?>
                                                    <option <?= ($client['idClient'] == $donnees['idClient']) ? "selected" : "" ?>
                                                            value="<?php echo $client['idClient']; ?>">
                                                        <?php echo $client['nom']; ?>
                                                    </option>
                                                <?php endwhile;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quantité</label>
                                            <input type="number"
                                                   min="0"
                                                   name="qte"
                                                   required
                                                   value="<?php echo $donnees['qte']; ?>"
                                                   class="form-control" placeholder="Quantité">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Date de la vente</label>
                                            <input type="date"
                                                   name="dateV"
                                                   value="<?php echo $donnees['dateVente']; ?>"
                                                   required
                                                   class="form-control"
                                                   placeholder="YYYY-MM-DD">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button name="modifVent" class="btn btn-primary btn-sm">
                                            Valider
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#table-vente').DataTable({
                responsive: true,
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                    info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "<<",
                        next:       ">>",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                }
            });

        });
    </script>

<?php require_once "footer.php" ?>