$(function () {

    //creation du liste dans la bd
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderClient')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processclient.php',
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

    //recuperation du la liste et affichage sur l'interface
    getBills();
    function getBills() {
        $.ajax({
            url: '../controler/processclient.php',
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
    $('body').on('click', '.editBtnClient', function (e) {
        e.preventDefault();
        console.log(e);
        $.ajax({
            url: '../controler/processclient.php',
            type: 'post',
            data: { workingcodeClient: e.currentTarget.dataset.id },
            success: function (response) {
                console.log(response);
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_codeClient').val(billinfo.codeClient);
                $('#UpdateNom').val(billinfo.Nom);
                $('#UpdateAdresse').val(billinfo.Adresse);
            }
        })
    })


    //Modification
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderClient')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processclient.php',
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

    //affichage de l'information
    $('body').on('click', '.infoBtnClient', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processclient.php',
            type: 'post',
            data: { informationcodeClient: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la chauffeur${informations.codeClient} </strong> `,
                    icon: 'info',
                    html:
                        `Nom du client: <b>${informations.Nom}</b><br>` +
                        `Adresse du client: <b>${informations.Adresse}</b><br>`,
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

    //suppression
    $('body').on('click', '.deleteBtnClient', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'vous volez vraiment supprimer? ' + this.dataset.id,
            text: "cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OUI'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controler/processclient.php',
                    type: 'post',
                    data: { deletecodeClient: this.dataset.id },
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted!',
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