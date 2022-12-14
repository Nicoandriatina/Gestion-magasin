<?php
require_once '../model/modelclient.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create($Nom,  $Adresse, $statClient, $nifClient);
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
              <th scope="col">Identifiant du client</th>
              <th scope="col">Nom</th>
              <th scope="col">Adresse</th>
              <th scope="col">Numero stat du client</th> </th>
              <th scope="col">Numero fiscal du client</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->codeClient</th>
                    <td>$bill->Nom</td>
                    <td>$bill->Adresse</td>
                    <td>$bill->statClient</td>
                    <td>$bill->nifClient</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtnClient\" title=\"voir detail\" data-id=\"$bill->codeClient\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtnClient\" title=\"voir detail\" data-id=\"$bill->codeClient\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtnClient\" title=\"voir detail\" data-id=\"$bill->codeClient\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
if (isset($_POST['workingcodeClient'])) {
    $workingcodeClient = (int)$_POST['workingcodeClient'];
    echo json_encode($db->getSingleBill($workingcodeClient));
}
// Modification des Chauffeur
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $UpdateNom, $UpdateAdresse, $UpdatestatClient, $UpdatenifClient);
    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationcodeClient'])) {
    $informationcodeClient = (int)$_POST['informationcodeClient'];
    echo json_encode($db->getSingleBill($informationcodeClient));
}
//suppression
if (isset($_POST['deletecodeClient'])) {
    $deletecodeClient = (int)$_POST['deletecodeClient'];
    echo ($db->delete($deletecodeClient));
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
