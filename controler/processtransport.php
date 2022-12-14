<?php
require_once '../model/modeltransport.php';
$db = new Database();
// creation des liste 
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create(  $dateTransport, $marchandise, $vehicule);
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
              <th scope="col">Numero du transport</th>
              <th scope="col">Date du transport</th>
              <th scope="col">Identifiant du marchandise</th>
              <th scope="col">Identifiant du vehicule</th>
              <th scope="col">Identifiant du Magasin</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->numTransport</th>
                    <td>$bill->dateTransport</td>
                    <td>$bill->marchandise</td>
                    <td>$bill->vehicule </td>
                    
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtnTransport\" title=\"voir detail\" data-id=\"$bill->numTransport\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtnTransport\" title=\"voir detail\" data-id=\"$bill->numTransport\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtnTransport\" title=\"voir detail\" data-id=\"$bill->numTransport\"> <i class=\"fas fa-trash-alt\"></i> </a>
                    </td>
                </tr>
            ";
        }
        $output .= "</tbody></table>";
        echo $output;
    } else {
        echo 'aucune liste pour le moment';
    }
}
//info pour detail de Chauffeur
if (isset($_POST['workingnumTransport'])) {
    $workingnumTransport = (int)$_POST['workingnumTransport'];
    echo json_encode($db->getSingleBill($workingnumTransport));
}
// Modification des Chauffeur
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $UpdatedateTransport, $Updatemarchandise, $Updatevehicule, $Updatemagasin);
    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationnumTransport'])) {
    $informationnumTransport = (int)$_POST['informationnumTransport'];
    echo json_encode($db->getSingleBill($informationnumTransport));
}
//suppression
if (isset($_POST['deletenumTransport'])) {
    $deletenumTransport = (int)$_POST['deletenumTransport'];
    echo ($db->delete($deletenumTransport));
}












// //exportation
// if (isset($_GET['action']) && $_GET['action'] == 'Exporter') {
//     $excelFileName = "Liste des quais" . date('YmdHis') . 'xls';
//     header("contein-Type: application/vnd.ms-excel");
//     header("conteint-Disposition: attachement; filename=$excelFileName");

//     $nomcolonne = ['NumeroQuai', 'Capacite', 'ville'];

//     $data = implode("\t", array_values($nomcolonne)) . "\n";
//     if ($db->countBills() > 0) {
//         $bills = $db->read();
//         foreach ($bills as $bill) {
//             $exceldata = [$bill->NumQuai, $bill->Capacite, $bill->ville];
//             $data .= implode("\t", $exceldata) . "\n";
//         }
//     } else {
//         $data = "Aucun liste trouver...." . "\n";
//     }
//     echo $data;
//     die();
// }
