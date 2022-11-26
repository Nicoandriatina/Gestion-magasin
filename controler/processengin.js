$(function () {

    //creation du liste 
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderEngins')
        // io ny code teo aloha, ERREUR COPIER COLLER manque "s"
        // let formOrder = $('#formOrderEngin')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processengin.php',
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
            url: '../controler/processengin.php',
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
            url: '../controler/processengin.php',
            type: 'post',
            data: { workingnumMatricule: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_numMatricule').val(billinfo.numMatricule);
                $('#UpdatenumMatricule').val(billinfo.numMatricule);
                $('#UpdatetypeEngin').val(billinfo.chauffeur);
                let select = document.querySelector('#UpdatetypesEngin');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
            }
        })
    })
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderEngin')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processengin.php',
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
            url: '../controler/processengin.php',
            type: 'post',
            data: { informationnumMatricule: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de l'engin Numero ${informations.numMatricule} </strong> `,
                    icon: 'info',
                    html:
                        `Types d'engin <b>${informations.typesEngin}</b><br>` +
                        `L'identifiant du chauffeur: <b>${informations.chauffeur}</b><br>`,
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
                    url: '../controler/processengin.php',
                    type: 'post',
                    data: { deletenumMatricule: this.dataset.id },
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