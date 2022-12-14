<?php
require_once '../model/modelchauffeur.php';
$db = new Database();
// creation des liste 
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create($Nom, $Adresse, $matChauffeur);
    echo 'perfect';
}
//recuperation des liste 
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $output = '';
    if ($db->countBills() > 0) {
        $bills = $db->read();
        $output .= '
        <table id="table" class="table table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">Identifiant du chauffeur</th>
              <th scope="col">Imatriculation du chauffeur</th>
              <th scope="col">Nom</th>
              <th scope="col">Adresse</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->IDchauffeur</th>
                    <td>$bill->matChauffeur</td>
                    <td>$bill->Nom</td>
                    <td>$bill->Adresse</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtnChauffeur\" title=\"voir detail\" data-id=\"$bill->IDchauffeur\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtnChauffeur\" title=\"voir detail\" data-id=\"$bill->IDchauffeur\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtnChauffeur\" title=\"voir detail\" data-id=\"$bill->IDchauffeur\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
//info pour detail de la liste
if (isset($_POST['workingIDchauffeur'])) {
    $workingIDchauffeur = (int)$_POST['workingIDchauffeur'];
    echo json_encode($db->getSingleBill($workingIDchauffeur));
}
// update de la liste
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $UpdateNom, $UpdateAdresse, $UpdatematChauffeur);
    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationIDchauffeur'])) {
    $informationIDchauffeur = (int)$_POST['informationIDchauffeur'];
    echo json_encode($db->getSingleBill($informationIDchauffeur));
}
//suppression
if (isset($_POST['deleteIDchauffeur'])) {
    $deleteIDchauffeur = (int)$_POST['deleteIDchauffeur'];
    echo ($db->delete($deleteIDchauffeur));
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
