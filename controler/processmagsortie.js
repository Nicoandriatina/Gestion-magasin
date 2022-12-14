$(function () {

    //creation du liste des bateau
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderMagSortie')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processmagsortie.php',
            type: 'post',
            data: formOrder.serialize() + '&action=create',
            success: function (response) {
                $('#creatModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'ajouter avec succes',
                })
                formOrder[0].reset();
                getBills();
            }
        })
    })
    //recuperation du la liste de bateau
    getBills();
    function getBills() {
        $.ajax({
            url: '../controler/processmagsortie.php',
            type: 'post',
            data: { action: 'fetch' },
            success: function (response) {
                let table = document.querySelector('#orderTable');
                table.innerHTML = response;
                // ajout datatables
                $(document).ready(function () {
                    $('#table').DataTable();
                });
            }
        })
    }

    //modification
    $('body').on('click', '.editBtn', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processmagsortie.php',
            type: 'post',
            data: { workingId: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_idmagSortie').val(billinfo.idMagSortie);
                $('#UpdateNom').val(billinfo.Nom);
                $('#UpdatecodeMarchandise').val(billinfo.codeMarchandise);
                $('#numInventaire').val(billinfo.numInventaire);
                $('#UpdatenombreSacs').val(billinfo.nombreSacs);
                $('#Updatedatesortie').val(billinfo.datesortie);
                $('#UpdatestatClient').val(billinfo.statClient);
                $('#UpdatedateNav').val(billinfo.dateNav);
                let select = document.querySelector('#UpdatetypesMarchandise');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
            }
        })
    })
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderMagSortie')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processmagsortie.php',
                type: 'post',
                data: formOrder.serialize() + '&action=Update',
                success: function (response) {
                    $('#UpdateModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Modifier avec succes',
                    })
                    formOrder[0].reset();
                    getBills();
                }
            })
        }
    })

    //affichage info @icon info @actions
    $('body').on('click', '.infoBtn', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processmagsortie.php',
            type: 'post',
            data: { informationId: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la magasin numero :${informations.idMagEntree} </strong> `,
                    icon: 'info',
                    html:
                        `Libelle du magasin: <b>${informations.Nom}</b><br>` +
                        `Identifiant du marchandise: <b>${informations.codeMarchandise}</b><br>` +
                        `Types de marchandise: <b>${informations.typesMarchandise}</b> </br>` +
                        `Nombres de sacs: <b>${informations.nombreSacs}</b><br>` +
                        `numero d'inventaire: <b>${informations.numInventaire}</b><br>` +
                        `Numero matricule du client: <b>${informations.client}</b><br>`+
                        `Numero Stat du client: <b>${informations.statClient}</b><br>`+
                        `Date et heure du sortie: <b>${informations.dateSortie}</b><br>`,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> super!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                })
            }
        })
    })

    $('body').on('click', '.deleteBtn', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'vous voulez vraiment supprimer?' + this.dataset.id,
            text: "cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK supprimer'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controler/processmagsortie.php',
                    type: 'post',
                    data: { deleteId: this.dataset.id },
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire(
                                'supprimer!',
                                'Votre fichier a bien ??t?? supprim??!',
                                'success'
                            )
                            getBills();
                        }
                    }
                })

            }
        })
    })

})