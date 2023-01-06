<?php
require_once '../model/modelengin.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);

    $db->create($numMatricule, $typeEngin, $marque, $chauffeur, $numInventaire, $dateAquis, $marque);
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
              <th scope="col">Numero Inventaire</th>
              <th scope="col">Types engins</th>
              <th scope="col">Marque</th>
              <th scope="col">identifiant du chauffeur</th>
              <th scope="col">date Aquisition</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->numMatricule</th>
                    <td>$bill->numInventaire</th>
                    <td>$bill->typesEngin</td>
                    <td>$bill->marque</td>
                    <td>$bill->chauffeur</td>
                    <td>$bill->dateAquis</td>
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
    $db->update($id, $UpdatetypeEngin, $Updatechauffeur, $UpdatenumInventaire, $UpdatedateAquis, $Updatemarque);

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

?>