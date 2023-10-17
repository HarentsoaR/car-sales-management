<?php require_once "head.php" ?>
    <div class="row">
        <div class="col-6">
            <fieldset class="scheduler-border">
                <legend>Ajout d'un client</legend>
                <form action="model/client.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numéro du client :</label>
                        <input type="text" required name="numCli" class="form-control" placeholder="N° du client">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nom du client :</label>
                        <input type="text" required name="nomCli" class="form-control" placeholder="Nom du client">
                    </div>
                    <button style="float: right" type="submit" name="ajtCli" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Sauvegarder</button>
                    <div class='test'></div>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered" id="table-client" width="100%">
                <thead>
                <tr>
                    <th scope="col">Numéro du client</th>
                    <th scope="col">Nom du client</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                //recuperation de tous les donnees de la bdd
                $reponse = $bd->query('SELECT * from client');
                $i = 0;
                //affichage ligne par ligne
                while ($donnees = $reponse->fetch()) :?>
                    <tr>
                        <td><?php echo $donnees['numClient']; ?></td>
                        <td><?php echo $donnees['nom']; ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#ll<?php echo $i; ?>"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#jl<?php echo $i; ?>"><i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                    <div id="jl<?php echo $i; ?>" class="modal fade " role="dialog" aria-labelledby="myLargeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="model/client.php">
                                    <div class="modal-header">
                                        <label class="modal-title" id="exampleModalLabel">
                                            Voulez vous vraiment supprimer le client :
                                            <strong><?php echo $donnees['nom']; ?>Num <?php echo $donnees['numClient']; ?></strong></label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-footer">
                                        <input name="idClient" type="hidden" value="<?php echo $donnees['idClient']; ?>">
                                        <button name="delete_client" class="btn btn-danger btn-sm">Valider</button>
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Annuler</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Modification d'un client</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="model/client.php">

                                    <input name="idClient" type="hidden" value="<?php echo $donnees['idClient']; ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numéro du client :</label>
                                            <input type="text"
                                                   name="numCli"
                                                   required
                                                   value="<?php echo $donnees['numClient']; ?>"
                                                   class="form-control"
                                                   placeholder="N° du client">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nom du client :</label>
                                            <input type="text"
                                                   name="nomCli"
                                                   required
                                                   value="<?php echo $donnees['nom']; ?>"
                                                   class="form-control" placeholder="Nom du client">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="update_client" class="btn btn-primary">Valider</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#table-client').DataTable({
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
<?php require_once 'footer.php' ?>