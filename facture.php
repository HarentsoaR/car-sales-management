<?php require_once "head.php" ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" id="error_form" role="alert" hidden>
                <strong>Erreur!</strong> <a href="#" class="alert-link">Veuillez renseigner tous les champs</a>
            </div>
            <fieldset class="scheduler-border">
                <legend>Facture Client</legend>
                <form id="get_list_cmd" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Date de d&eacute;but :</label>
                                <input required
                                       id="dateDebut"
                                       name="dateDebut"
                                       placeholder="YYYY-MM-DD"
                                       class="form-control"
                                       type="date"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Date de fin :</label>
                                <input required
                                       id="dateFin"
                                       name="dateFin"
                                       placeholder="YYYY-MM-DD"
                                       class="form-control"
                                       type="date"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nom du du client :</label>
                                <select name="numCli" id="idCli" required class="form-control">
                                    <option value="">Selectionner le nom du client ...</option>
                                    <?php
                                    //choix Client
                                    $reponse = $bd->query('SELECT * from client');
                                    while ($donnee = $reponse->fetch()) : ?>
                                        <option value="<?php echo $donnee['idClient']; ?>"> <?php echo $donnee['nom']; ?> </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="button" style="float: right" id="btn_get_list_fact" name="liste" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Afficher</button>
                </form>
            </fieldset>
        </div>
    </div>
    <div id="cli_detail" hidden>
        <div class="row" >
            <div class="col-2">
                <label for="exampleInputPassword1">Numero Client :</label>
            </div>

            <div class="col-4">
                <input class="form-control" required
                       id="NumCli"
                       type="text" disabled/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-2">
                <label for="exampleInputPassword1">Total :</label>
            </div>
            <div class="col-4">
                <input class="form-control" required
                       id="TotalCmde"
                       type="text" disabled/>
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered" id="table_facture" width="100%">
                    <thead >
                    <tr>
                        <th scope="col">N° de voiture</th>
                        <th scope="col">Marque</th>
                        <th scope="col">PU</th>
                        <th scope="col">Quantit&eacute;</th>
                        <th scope="col">Montant</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $(".form-control").focus( function () {
                $("#error_form").hide();
            });

            $('#table_facture').DataTable({
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

            $('#btn_get_list_fact').click( function(e){
                if($("#dateDebut").val() === '' || $("#dateFin").val() === '' || $("#idCli").val() === '' ) {
                    $("#error_form").show();
                    $("#error_form").removeAttr('hidden');
                    return;
                }
                $('#table_facture').DataTable().clear();
                $.ajax({
                    url : 'model/facture.php',
                    type : 'POST',
                    data : {
                        "dateDebut" : $("#dateDebut").val(),
                        "dateFin": $("#dateFin").val(),
                        "idCli": $("#idCli").val()
                    },
                    dataType : 'json',
                    success : function(data) {
                        $("#cli_detail").removeAttr('hidden');
                        $tot = 0;
                        $.each(data, function (i, item) {
                            $("#NumCli").val(item['numCli']);
                            $('#table_facture').DataTable().row.add(
                                [item['numVoiture'],
                                    item['marque'],
                                    item['PU'],
                                    item['qte'],
                                    item['qte'] * item['PU']
                                ]).draw();
                            $tot = $tot + item['qte'] * item['PU'];
                        });
                        $("#TotalCmde").val($tot);
                        e.preventDefault();
                    }
                });
            });

        });
    </script>

<?php require_once "footer.php" ?>