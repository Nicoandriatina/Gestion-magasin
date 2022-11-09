$(function () {
  
    //creation du liste des bateau
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrder')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processnavire.php',
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
            url: '../controler/processnavire.php',
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
            url: '../controler/processnavire.php',
            type: 'post',
            data: { workingId: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_id').val(billinfo.ID);
                $('#UpdatenumQuai').val(billinfo.numQuai);
                $('#UpdateNombateau').val(billinfo.Nombateau);
                $('#UpdateMarque').val(billinfo.Marque);
                $('#Updatecategories').val(billinfo.categories);
                $('#Updatechargemax').val(billinfo.chargemax);
                $('#Updatechargemin').val(billinfo.chargemin);
                let select = document.querySelector('#Updatetypeproduit');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
            }
        })
    })
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrder')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processnavire.php',
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
            url: '../controler/processnavire.php',
            type: 'post',
            data: { informationId: this.dataset.id},
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title:  `<strong>Information de la bateaux Numero ${informations.ID} </strong> `,
                    icon: 'info',
                    html:
                        `Nom du Bateau: <b>${informations.Nombateau}</b><br>` +
                        `Numero du quai: <b>${informations.NumQuai}</b><br>` +
                        `Marque du bateau: <b>${informations.Marque}</b> </br>` +
                        `Categorie du Bateau: <b>${informations.categories}</b><br>` +
                        `charge Maximal du Bateau: <b>${informations.chargemax}</b><br>` +
                        `Charge Minimal du Bateau: <b>${informations.chargemin}</b><br>` +
                        `types de produit que le  Bateau transporte: <b>${informations.typeproduit}</b><br>`,
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
            title: 'vous volez vraiment supprimer' + this.dataset.id,
            text: "cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK supprimer'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controler/processnavire.php',
                    type: 'post',
                    data: { deleteId: this.dataset.id },
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire(
                                'Supprimer!',
                                'suppression avec succes!',
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