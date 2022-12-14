<?php
require_once '../model/modelmagentree.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create($Nom, $codeMarchandise, $typesMarchandise, $nombreSacs, $dateEntree, $numInventaire, $matriculeChauffeur, $dateNav);
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
              <th scope="col">Id Marchandise Entree</th>
              <th scope="col">Libelle du magasin</th>
              <th scope="col">Id Marchandise</th>
              <th scope="col">Types de Marcandise</th>
              <th scope="col">Nombres Sacs</th>
              <th scope="col">Date</th>
              <th scope="col">Numero inventaire</th>
              <th scope="col">Matricule du Chauffeur </th>
              <th scope="col">date arriver du navire </th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->idMagEntree</th>
                    <td>$bill->Nom</td>
                    <td>$bill->codeMarchandise</td>
                    <td>$bill->typesMarchandise</td>
                    <td>$bill->nombreSacs</td>
                    <td>$bill->dateEntree</td>
                    <td>$bill->numInventaire</td>
                    <td>$bill->matriculeChauffeur</td>
                    <td>$bill->dateNav</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"voir detail\" data-id=\"$bill->idMagSortie\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"voir detail\" data-id=\"$bill->idMagSortie\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"voir detail\" data-id=\"$bill->idMagSortie\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
if (isset($_POST['workingId'])) {
    $workingId = (int)$_POST['workingId'];
    echo json_encode($db->getSingleBill($workingId));
}
// Modification des bateau
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $UpdateNom, $UpdatecodeMarhandise, $UpdatetypesMarchandise, $UpdatenombreSacs, $UpdatedateEntree, $UpdatenumInventaire, $UpdatematriculeChauffeur, $UpdatedateNav);
    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationId'])) {
    $informationId = (int)$_POST['informationId'];
    echo json_encode($db->getSingleBill($informationId));
}
//suppression
if (isset($_POST['deleteId'])) {
    $deleteId = (int)$_POST['deleteId'];
    echo ($db->delete($deleteId));
}

// //exportation
// if (isset($_GET['action']) && $_GET['action'] == 'export') {
//     $excelFileName = "Liste des bateaux" . date('YmdHis') . 'xls';
//     header("contein-Type: application/vnd.ms-excel");
//     header("conteint-Disposition: attachement; filename=$excelFileName");

//     $nomcolonne = ['Identifiant', 'Numquai', 'Nom', 'Marque', 'categories', 'chargemaximale', 'chargemine', 'Type'];

//     $data = implode("\t", array_values($nomcolonne)) . "\n";
//     if ($db->countBills() > 0) {
//         $bills = $db->read();
//         foreach ($bills as $bill) {
//             $excelData = [$bill->ID, $bill->NumQuai, $bill->Nombateau, $bill->Marque, $bill->categories, $bill->chargemax, $bill->chargemax, $bill->typeproduit];
//             $data .= implode("\t", $excelData) . "\n";
//         }
//     } else {
//         $data = "Aucun liste trouver...." . "\n";
//     }
//     echo $data;
//     die();
// }
