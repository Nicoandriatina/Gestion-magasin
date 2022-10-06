$(function () {
    $('table').DataTable();

    //creation du liste des bateau
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrder')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: 'process.php',
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
            url: 'process.php',
            type: 'post',
            data: { action: 'fetch' },
            success: function (response) {
                let table = document.querySelector('#orderTable');
                table.innerHTML = response;
            }
        })
    }
    $('body').on('click', '.editBtn', function (e) {
        e.preventDefault();
        $.ajax({
            url: "process.php",
            type: 'post',
            data: { workingId: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_id').val(billinfo.ID);
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
    //Modification du liste de bateaux
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrder')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: 'process.php',
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

    $('body').on('click','.infoBtn', function(e){
        e.preventDefault();
        $.ajax({
            url: "process.php",
            type: 'post',
            data: { informationId: this.dataset.id },
            success: function(response){
                let informations= JSON.parse(response);
                Swal.fire({
                    title: '<strong>Information de la bateaux Numero ${informations.id} </strong>',
                    icon: 'info',
                    html:
                    'Nom du Bateau: <b>$(informations.Nombateau)</b><br>'+
                    'Marque du bateau: <b>"//${informations.Marque}"</b> </br>'+
                    'Categorie du Bateau: <b>${informations.categories}</b><br>'+
                    'charge Maximal du Bateau: <b>${informations.chargemax}</b><br>'+
                    'Charge Minimal du Bateau: <b>${informations.chrgemin}</b><br>'+
                    'types de produit que le  Bateau transporte: <b>${informations.typeproduit}</b><br>',
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
})