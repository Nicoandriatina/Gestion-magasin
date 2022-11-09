<?php
require_once '../model/modelquai.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create($Capacite, $ville);
    echo 'perfect';
}
//recuperation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $output = '';
    if ($db->countBills() > 0) {
        $bills = $db->read();
        $output .= '
        <table id="table" class="table table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">Numero du Quai</th>
              <th scope="col">Capacite</th>
              <th scope="col">Ville</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->NumQuai</th>
                    <td>$bill->Capacite</td>
                    <td>$bill->ville</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtnQuai\" title=\"voir detail\" data-id=\"$bill->NumQuai\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtnQuai\" title=\"voir detail\" data-id=\"$bill->NumQuai\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtnQuai\" title=\"voir detail\" data-id=\"$bill->NumQuai\"> <i class=\"fas fa-trash-alt\"></i> </a>
                    </td>
                </tr>
            ";
        }
        $output .= "</tbody></table>";
        echo $output;
    } else {
        echo 'aucune facture pour le moment';
    }
}
//info pour detail de bateux
if (isset($_POST['workingNumQuai'])) {
    $workingNumQuai = (int)$_POST['workingNumQuai'];
    echo json_encode($db->getSingleBill($workingNumQuai));
}
// Modification des bateau
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($NumQuai, $UpdateCapacite, $Updateville);

    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationNumQuai'])) {
    $informationNumQuai = (int)$_POST['informationNumQuai'];
    echo json_encode($db->getSingleBill($informationNumQuai));
}
//suppression
if (isset($_POST['deleteNumQuai'])) {
    $deleteNumQuai = (int)$_POST['deleteNumQuai'];
    echo ($db->delete($deleteNumQuai));
}

// //exportation
// if (isset($_GET['action']) && $_GET['action'] == 'Exporter') {
//     $excelFileName="Liste des bateaux".date('YmdHis').'xls';
//     header("contein-Type: application/vnd.ms-excel");
//     header("conteint-Disposition: attachement; filename=$excelFileName");

//     $nomcolonne = ['Identifiant', 'Nom', 'Marque', 'categories', 'chargemaximale', 'chargemine', 'Type'];

//     $data = implode("\t", array_values($nomcolonne)). "\n";
//     if($db->countBills()>0){
//         $bill= $db->read();  
//         foreach($bills as $bill) {
//             $exceldata = [$bill->id, $bill->Nombateau, $bill->Marque, $bill->categories, $bill->chargemax, $bill->chargemax, $bill->typeproduit];
//             $data .= implode("\t", $exceldata). "\n";

//         } 
//     }else{
//         $data="Aucun liste trouver...." . "\n"; 
//     }
//    echo $data;
//    die();
// }

