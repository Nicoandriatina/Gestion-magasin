<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
  <title>SMMC Port Toamasina</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg  bg-success">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"> <img src="../images/Logo.png" class="rounded" alt="logo du SMMC"> </i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="../index.html">Acceuil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewnavire.php">Navires</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewengin.php">Engins</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewchauffeur.php">chauffeur</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewtransport.php">Transport</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./viewquai.php">Quai</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewmagentree.php">Magasin Entree</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewmagsortie.php">Magasin Sortie</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewmarchandise.php">Marchandise</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewclient.php">client</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <section class="container py-5">
    <!--create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Ajout d'un nouveau chauffeur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="create" method="post" id="formOrderChauffeur">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="matChauffeur" name="matChauffeur">
                <label for="matChauffeur">Imatriculation du chauffeur</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Nom" name="Nom">
                <label for="Nom">Nom du chauffeur</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Adresse" name="Adresse">
                <label for="Adresse ">L'adresse du chauffeur</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
            <button type="button" class="btn btn-primary" id="create" name="create"> <i class="fas fa-plus"></i> Ajouter</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg8 col-sm mb-5 mx-auto">
        <h1 class="fs-4 text-center lead text-prymary"> Chauffeur </h1>
      </div>
    </div>
    <div class="dropdown-divider"> </div>
    <div class="row">
      <div class="col-md-6">
        <h5 class="fw-bold mb-8">Liste des chauffeur</hh5>
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-end">
          <button class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal"> <i class="fas fa-folder-plus">Nouveau</i> </button>
          <button onclick="HtmlTOExcel('xlsx')" type="exporter" name="exporter" id="exporter" class="btn btn-success-btn-sm"><i class="fas fa-table">Exporter</i></button> 
        </div>
      </div>
    </div>
    <div class="dropdown-divider"> </div>
    <div class="row">
      <div class="table-responsive" id="orderTable">
      </div>
    </div>
    <!-- update Modal -->
    <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="UpdateModalLabel">Modification du liste du chauffeur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="update" method="post" id="UpdateformOrderChauffeur">
              <input type="hidden" name="id" id="bill_IDchauffeur">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="UpdatematChauffeur" name="UpdatematChauffeur">
                <label for="UpdatematChauffeur">Imatriculation du chauffeur</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="UpdateNom" name="UpdateNom">
                <label for="UpdateNom"></label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="UpdateAdresse" name="UpdateAdresse">
                <label for="UpdateAdresse ">L'adresse du chauffeur</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
            <button type="button" class="btn btn-primary" id="Update" name="Update"> <i class="fas fa-sync"></i> Modifier</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../controler/processchauffeur.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script>
    function HtmlTOExcel(type, fun, dl) {
    var elt = document.getElementById('table');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fun || ('student-recored.' + (type || 'xlsx')));
}
  </script>
</body>

</html>