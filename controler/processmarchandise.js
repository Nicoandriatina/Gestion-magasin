$(function () {

    //creation du liste 
    $('#create').on('click', function (e) {
        let formOrder = $('#formOrderMarchandise')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processmarchandise.php',
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
            url: '../controler/processmarchandise.php',
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
    $('body').on('click', '.editBtnMarchandise', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processmarchandise.php',
            type: 'post',
            data: { workingcodeMarchandise: this.dataset.id },
            success: function (response) {
                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_codeMarchandiise').val(billinfo.codeMarchandise);
                $('#Updatelibelle').val(billinfo.libelle);
                $('#Updatebateau').val(billinfo.bateau);
                $('#Updatequantite').val(billinfo.quantite);
                $('#UpdatetypesMarchandise').val(billinfo.typesMarchandise);
                let select = document.querySelector('#UpdatetypesMarchandise');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
            }
        })
    })
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderMarchandise')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processmarchandise.php',
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
    $('body').on('click', '.infoBtnMarchandise', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processmarchandise.php',
            type: 'post',
            data: { informationcodeMarchandise: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la marchandise Numero ${informations.codeMarchandise} </strong> `,
                    icon: 'info',
                    html:
                        `Nom de la marchandise :<b>${informations.libelle}</b><br>` +
                        `Type de la marchandise :<b>${informations.typesMarchandise}</b><br>` +
                        `Transporter par le navire: <b>${informations.bateau}</b><br>` +
                        `Quantite de la marchandise: <b>${informations.quantite} tonnes</b><br>`,
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

    $('body').on('click', '.deleteBtnMarchandise', function (e) {
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
                    url: '../controler/processmarchandise.php',
                    type: 'post',
                    data: { deletecodeMarchandise: this.dataset.id },
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