$(function () {

    //creation du liste 
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderTransport')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processtransport.php',
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
            url: '../controler/processtransport.php',
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
    $('body').on('click', '.editBtnTransport', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processtransport.php',
            type: 'post',
            data: { workingcodeMarchandise: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_numTransport').val(billinfo.numTransport);
                $('#UpdatedateTransport').val(billinfo.dateTransport);
                $('#Updatevehicule').val(billinfo.vehicule);
                $('#Updatemagasin').val(billinfo.magasin);
                $('#Updatemarchandise').val(billinfo.marchandise);
                let select = document.querySelector('#Updatemarchandise');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
                
            }
        })
    })
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderTransport')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processtransport.php',
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
    $('body').on('click', '.infoBtnTransport', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processtransport.php',
            type: 'post',
            data: { informationnumTransport: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la marchandise Numero ${informations.numTransport} </strong> `,
                    icon: 'info',
                    html:
                        `Date et heure du transport :<b>${informations.dateTransport}</b><br>` +
                        `Identifiant de la marchandise :<b>${informations.marchandise}</b><br>` +
                        `Identifiant de l'engin de transport: <b>${informations.vehicule}</b><br>` +
                        `Identifiant de la magasin: <b>${informations.magasin} tonnes</b><br>`,
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

    $('body').on('click', '.deleteBtnTransport', function (e) {
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
                    url: '../controler/processtransport.php',
                    type: 'post',
                    data: { deletenumTransport: this.dataset.id },
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