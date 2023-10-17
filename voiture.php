<?php require_once "head.php" ?>
    <div class="row">
        <div class="col-12">

            <fieldset class="scheduler-border">
                <legend>Ajout d'une voiture</legend>
                <form action="model/voiture.php" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Numéro de la voiture :</label>
                                <input type="text" required name="numVoi" class="form-control" placeholder="N° Voiture">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Marque :</label>
                                <input type="text" required name="marq" class="form-control" placeholder="Marque">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Prix unitaire :</label>
                                <input type="number" required min="0" name="pu" class="form-control" placeholder="Prix unitaire">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Stock :</label>
                                <input type="number" required min="0" name="stock" class="form-control" placeholder="Stock">
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="float: right" name="add_car" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Sauvegarder</button>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <table class="table table-striped table-bordered" id="table-voiture" width="100%">
                <thead>
                <tr>
                    <th scope="col">Numéro de la voiture</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Nombre de stock</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                <?php
                //recuperation de tous les donnees de la bdd

                $reponse = $bd->query('SELECT * from voiture');

                $i = 0;
                //affichage ligne par ligne
                while ($donnees = $reponse->fetch()) : ?>

                    <tr>
                        <th><?php echo $donnees['numVoiture']; ?></th>
                        <th><?php echo $donnees['Marque']; ?></th>
                        <th><?php echo $donnees['Pu']; ?></th>
                        <th><?php echo $donnees['stock']; ?></th>
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
                                <form method="post" action="model/voiture.php">
                                    <div class="modal-header">
                                        <input name="id_voiture" type="hidden" value="<?php echo $donnees['idVoiture']; ?>">
                                        <label class="modal-title" id="exampleModalLabel">
                                            Voulez vous vraiment supprimer la voiture n°:  <?php echo $donnees['numVoiture']; ?> ?
                                        </label>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="delete_car" class="btn btn-danger btn-sm">Valider</button>
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                            Annuler
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
                                    <h5 class="modal-title" id="exampleModalLabel">Modification d'une voiture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="model/voiture.php">
                                    <div class="modal-body">
                                        <input name="id_voiture" type="hidden" value="<?php echo $donnees['idVoiture']; ?>">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numéro de la voiture :</label>
                                            <input type="text" name="numVoi"
                                                   value="<?php echo $donnees['numVoiture']; ?>"
                                                   class="form-control"
                                                   required
                                                   placeholder="N° Voiture">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nom de la voiture :</label>
                                            <input type="text"
                                                   name="marq"
                                                   required
                                                   value="<?php echo $donnees['Marque']; ?>"
                                                   class="form-control"
                                                   placeholder="Marque">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Prix unitaire :</label>
                                            <input type="number"
                                                   name="pu"
                                                   required
                                                   min="0"
                                                   value="<?php echo $donnees['Pu']; ?>"
                                                   class="form-control"
                                                   placeholder="Prix unitaire">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nombre de stock :</label>
                                            <input type="number"
                                                   name="stock"
                                                   required
                                                   min="0"
                                                   value="<?php echo $donnees['stock']; ?>"
                                                   class="form-control"
                                                   placeholder="Stock">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="update_car" class="btn btn-primary btn-sm">Valider</button>
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endwhile;?>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#table-voiture').DataTable({
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