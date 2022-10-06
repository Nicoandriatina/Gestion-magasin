<?php
require_once 'model.php';
$db = new Database();
// creation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create($Nombateau, $Marque, $categories, $chargemax, $chargemin, $typeproduit);
    echo 'perfect';
}
//recuperation des liste de bateau
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $output = '';
    if ($db->countBills() > 0) {
        $bills = $db->read();
        $output .= '
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nom du bateaux</th>
              <th scope="col">Marque</th>
              <th scope="col">Categories</th>
              <th scope="col">charge maximal</th>
              <th scope="col">charge minimal</th>
              <th scope="col">types de marchandise</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 

                <tr>
                    <th scope=\"row\">$bill->ID</th>
                    <td>$bill->Nombateau</td>
                    <td>$bill->Marque</td>
                    <td>$bill->categories</td>
                    <td>$bill->chargemax</td>
                    <td>$bill->chargemin</td>
                    <td>$bill->typeproduit</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"voir detail\" data-id=\"$bill->ID\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"voir detail\" data-id=\"$bill->ID\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"voir detail\" data-id=\"$bill->ID\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
    $db->update($id, $UpdateNombateau, $UpdateMarque, $Updatecategories, $Updatechargemax, $Updatechargemin, $Updatetypeproduit);

    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationId'])) {
    $informationId = (int)$_POST['informationId'];
    echo json_encode($db->getSingleBill($informationId));
}

