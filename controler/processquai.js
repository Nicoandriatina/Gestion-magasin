$(function () {

    //creation du liste des quai(mankany @bd ian)
    $('#createQuai').on('click', function (e) {
        let formOrder = $('#formOrderQuai')
        if (formOrder[0].checkValidity())
            console.log('data ', formOrder.serialize());
        e.preventDefault();
        $.ajax({
            url: '../controler/processquai.php',
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

    //recuperation du la liste de quai(manao affiche @interface)
    getBills();
    function getBills() {
        $.ajax({
            url: '../controler/processquai.php',
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
    $('body').on('click', '.editBtnQuai', function (e) {
        e.preventDefault();
        console.log(e);
        $.ajax({
            url: '../controler/processquai.php',
            type: 'post',
            data: { workingNumQuai: e.currentTarget.dataset.id },
            success: function (response) {
                console.log(response);

                let billinfo = JSON.parse(response);
                console.log('billinfo', billinfo);
                $('#bill_NumQuai').val(billinfo.NumQuai);
                $('#UpdateCapacite').val(billinfo.Capacite);
                $('#Updateville').val(billinfo.ville);
                let select = document.querySelector('#Updateoccupation');
                let UpdatetypeproduitOption = Array.from(select.options);
                UpdatetypeproduitOption.forEach((o, i) => {
                    if (o.value == billinfo.state) select.selectedIndex = i;
                })
            }
        })
    })


    //Modification du liste de quai
    $('#Update').on('click', function (e) {
        let formOrder = $('#UpdateformOrderQuai')
        if (formOrder[0].checkValidity()) {
            console.log('data ', formOrder.serialize());
            e.preventDefault();
            $.ajax({
                url: '../controler/processquai.php',
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

    //information
    $('body').on('click', '.infoBtnQuai', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controler/processquai.php',
            type: 'post',
            data: { informationNumQuai: this.dataset.id },
            success: function (response) {
                let informations = JSON.parse(response);
                Swal.fire({
                    title: `<strong>Information de la Quai${informations.NumQuai} </strong> `,
                    icon: 'info',
                    html:
                        `Capacite du quai: <b>${informations.Capacite}</b><br>` +
                        `ville d'emplacement du quai: <b>${informations.ville}</b><br>`+
                        `Le quai est elle occupé  :<b>${informations.occupation}</b><br>`,
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
    $('body').on('click', '.deleteBtnQuai', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'vous voulez vraiment supprimer? ' + this.dataset.id,
            text: "cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OUI'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controler/processquai.php',
                    type: 'post',
                    data: { deleteNumQuai: this.dataset.id },
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