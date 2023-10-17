<?php require_once "head.php" ?>
    <div class="row">
        <div class="col-12">
                <div class="alert alert-danger" id="error_form" role="alert" hidden>
                    <strong>Erreur!</strong> <a href="#" class="alert-link">Veuillez renseigner tous les champs</a>
                </div>
                <div class="alert alert-danger" id="error_date" role="alert" hidden>
                    <strong>Erreur!</strong> <a href="#" class="alert-link">La date de d&eacute;but doit etre inf&eacute;rieure &agrave; la date de fin !!</a>
                </div>
            <fieldset class="scheduler-border">
                <legend>Mouvement de stock d'une voiture</legend>
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
                                <label>Choix de la Voiture :</label>
                                <select name="numVoi" id="numVoi" class="form-control" required>
                                    <option value="">Choix N° ...</option>
                                    <?php
                                    //choix Voiture
                                    $reponse = $bd->query('SELECT * from voiture');
                                    while ($donnee = $reponse->fetch()) : ?>
                                        <option value="<?php echo $donnee['idVoiture']; ?>"> <?php echo $donnee['Marque']; ?> </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="button" style="float: right" id="btn_get_list_cmd" name="liste" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Afficher</button>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered" id="table_cmde" width="100%">
                <thead >
                <tr>
                    <th scope="col">N° de vente</th>
                    <th scope="col">Qté</th>
                    <th scope="col">Date de vente</th>
                    <th scope="col">N° de la voiture</th>
                    <th scope="col">N° du client</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $(".form-control").focus( function () {
                $("#error_form").hide();
                $("#error_date").hide();
            });

            $('#table_cmde').DataTable({
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

            $('#btn_get_list_cmd').click( function(e){
                if($("#dateDebut").val() === '' || $("#dateFin").val() === '' || $("#numVoi").val() === '' ) {
                    $("#error_form").show();
                    $("#error_form").removeAttr('hidden');
                    return;
                }
                if(new Date($("#dateDebut").val()).getTime()  >= new Date($("#dateFin").val()).getTime()){
                    $("#error_date").show();
                    $("#error_date").removeAttr('hidden');
                    return;
                }
                $('#table_cmde').DataTable().clear();
                var data_to_send = $('#get_list_cmd').serialize();
                $.ajax({
                    url : 'model/liste.php',
                    type : 'POST',
                    data : {
                        "dateDebut" : $("#dateDebut").val(),
                        "dateFin": $("#dateFin").val(),
                        "numVoi": $("#numVoi").val()
                    },
                    dataType : 'json',
                    success : function(data) {
                        $.each(data, function (i, item) {
                            $('#table_cmde').DataTable().row.add(
                                [item['numVente'],
                                    item['qte'],
                                    item['dateVente'],
                                    item['numVoiture'],
                                    item['nom']
                            ]).draw();
                        });
                        e.preventDefault();
                    }
                });
            });

        });
    </script>

<?php require_once "footer.php" ?>