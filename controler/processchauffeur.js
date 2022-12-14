$(function () {

    //creation du liste dans la bd
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderChauffeur')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processchauffeur.php',
            type: 'post',
            data: formOrder.serialize() + '&action=create',
            success: function (response) {
                $('#creatModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'effectué avec succes',
                })
                formOrder[0].reset();
                getBills();
            }
        })
    })

    //recuperation du la liste et affichage sur l'interface
    getBills();
    function getBills() {
        $.ajax({
            url: '../controler/processchauffeur.php',
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
    //recuperation des elements a modiffier
    $('body').on('click', '.editBtnChauffeur', function (e) {
        e.preventDefault();
        console.log(e);
        $.ajax({
            url: '../controler/processchauffeur.php',
            type: 'post',
            data: { workingIDchauffeur: e.currentTarget.dataset.id },
            success: function (response) {
                console.log(response);
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_IDchauffeur').val(billinfo.IDchauffeur);
                $('#UpdateNom').val(billinfo.Nom);
                $('#UpdateAdresse').val(billinfo.Adresse);
                $('#UpdatematChauffeur').val(billinfo.matChauffeur);
            }
        })
    })


    //Modification
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderChauffeur')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processchauffeur.php',
                type: 'post',
                data: formOrder.serialize() + '&action=Update',
                success: function (response) {
                    $('#UpdateModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Modiffier avec succes',
                    })
                    formOrder[0].reset();
                    getBills();
                }
            })
        }
    })

    //affichage de l'information
    $('body').on('click', '.infoBtnChauffeur', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processchauffeur.php',
            type: 'post',
            data: { informationIDchauffeur: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la chauffeur${informations.IDchauffeur} </strong> `,
                    icon: 'info',
                    html:
                        `Imatriculation du chauffeur: <b>${informations.matChauffeur}</b><br>` +
                        `Nom du chauffeur: <b>${informations.Nom}</b><br>` +
                        `Adresse du chauffeur: <b>${informations.Adresse}</b><br>`,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> ok!',
                    confirmButtonAriaLabel: 'Thumbs up, parfait!',
                })
            }
        })
    })

    //suppression
    $('body').on('click', '.deleteBtnChauffeur', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'vous voulez vraiment supprimer ?' + this.dataset.id,
            text: "cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OUI'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controler/processchauffeur.php',
                    type: 'post',
                    data: { deleteIDchauffeur: this.dataset.id },
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire(
                                'supprimer!',
                                'Votre fichier a bien été supprimé!',
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