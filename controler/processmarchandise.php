<?php
require_once '../model/modelmarchandise.php';
$db = new Database();
// creation des liste 
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    extract($_POST);
    $db->create(  $bateau, $libelle, $typesMarchandise, $quantite, $nombreSacs);
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
              <th scope="col">Identifiant du Marchandise</th>
              <th scope="col">Nom du marchandise</th>
              <th scope="col">type du marchandise</th>
              <th scope="col">Quantité</th>
              <th scope="col">transporte par le navire</th>
              <th scope="col">Nombre de sacs</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        ';
        foreach ($bills as $bill) {
            $output .= " 
                <tr>
                    <th scope=\"row\">$bill->codeMarchandise</th>
                    <td>$bill->libelle</td>
                    <td>$bill->typesMarchandise</td>
                    <td>$bill->quantite tonnes </td>
                    <td>$bill->bateau</td>
                    <td>$bill->nombreSacs sacs</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtnMarchandise\" title=\"voir detail\" data-id=\"$bill->codeMarchandise\"> <i class=\"fas fa-info-circle\"></i> </a>
                    <a href=\"#\" class=\"text-primary me-2 editBtnMarchandise\" title=\"voir detail\" data-id=\"$bill->codeMarchandise\"> <i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#UpdateModal'></i> </a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtnMarchandise\" title=\"voir detail\" data-id=\"$bill->codeMarchandise\"> <i class=\"fas fa-trash-alt\"></i> </a>
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
if (isset($_POST['workingcodeMarchandise'])) {
    $workingcodeMarchandise = (int)$_POST['workingcodeMarchandise'];
    echo json_encode($db->getSingleBill($workingcodeMarchandise));
}
// Modification des Chauffeur
if (isset($_POST['action']) && $_POST['action'] == 'Update') {
    extract($_POST);
    $db->update($id, $Updatebateau, $Updatelibelle, $UpdatetypesMarchandise, $Updatequantite, $UpdatenombreSacs);
    echo 'perfect';
}

//info @le icone Info @action
if (isset($_POST['informationcodeMarchandise'])) {
    $informationcodeMarchandise = (int)$_POST['informationcodeMarchandise'];
    echo json_encode($db->getSingleBill($informationcodeMarchandise));
}
//suppression
if (isset($_POST['deletecodeMarchandise'])) {
    $deletecodeMarchandise = (int)$_POST['deletecodeMarchandise'];
    echo ($db->delete($deletecodeMarchandise));
}




?>

