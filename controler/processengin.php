<?php
require_once '../model/modelengin.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);

    $db->create($numMatricule, $typeEngin, $chauffeur);

    // code teo aloha , ERREUR COPIER COLLER plus de "s" sur $typesEngin
    // $db->create( $numMatricule, $typesEngin, $chauffeur);
    echo 'perfect';
}
//recuperation de liste des bateau
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $output = '';
    if ($db->countBills() > 0) {
        $bills = $db->read();
        $output .= '
        <table id="table" class="table table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">Numero matricule</th>
              <th scope="col">types engins</th>
              <th scope="col">identifiant du chauffeur</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->numMatricule</th>
                    <td>$bill->typesEngin</td>
                    <td>$bill->chauffeur</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"voir detail\" data-id=\"$bill->numMatricule\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"voir detail\" data-id=\"$bill->numMatricule\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"voir detail\" data-id=\"$bill->numMatricule\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
//info pour detail de bateux
if (isset($_POST['workingnumMatricule'])) {
    $workingnumMatricule = (int)$_POST['workingnumMatricule'];
    echo json_encode($db->getSingleBill($workingnumMatricule));
}
// Modification des bateau
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $UpdatetypeEngin, $Updatechauffeur);

    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationnumMatricule'])) {
    $informationnumMatricule = (int)$_POST['informationnumMatricule'];
    echo json_encode($db->getSingleBill($informationnumMatricule));
}
//suppression
if (isset($_POST['deletenumMatricule'])) {
    $deletenumMatricule = (int)$_POST['deletenumMatricule'];
    echo ($db->delete($deletenumMatricule));
}

// //exportation
// if (isset($_GET['action']) && $_GET['action'] == 'export') {
//     $excelFileName="Liste des bateaux".date('YmdHis').'xls';
//     header("contein-Type: application/vnd.ms-excel");
//     header("conteint-Disposition: attachement; filename=$excelFileName");

//     $nomcolonne = ['Identifiant','Numquai', 'Nom', 'Marque', 'categories', 'chargemaximale', 'chargemine', 'Type'];

//     $data = implode("\t", array_values($nomcolonne)). "\n";
//     if($db->countBills()>0){
//         $bills= $db->read();  
//         foreach ($bills as $bill) {
//             $excelData = [$bill->ID,$bill->NumQuai ,$bill->Nombateau, $bill->Marque, $bill->categories, $bill->chargemax, $bill->chargemax, $bill->typeproduit];
//             $data .= implode("\t", $excelData). "\n";

//         } 
//     }else{
//         $data="Aucun liste trouver...." . "\n"; 
//     }
//    echo $data;
//    die();
// }
