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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> <i class="fas fa-user-secret"></i> SMMC Port Toamasina</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Acceuil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Bateau</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Vehicule</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">chauffeur</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Magasin</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Produit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">client</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
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
            <h5 class="modal-title" id="createModalLabel">Noveau Bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Erreur tato, nisy balise </form> iray nihoatra -->
            <form action="" method="post" id="formOrder">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Nombateau" name="Nombateau">
                <label for="Nombateau">Nom du Bateau</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Marque" name="Marque">
                <label for="Marque">Marque</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="typeproduit" aria-label="typeproduit" name="typeproduit">
                  <option value="Produit métallurgiques">Produit métallurgiques</option>
                  <option value="Produit Alimentaires">Produit Alimentaires</option>
                  <option value="Produit Forestiers">Produit Forestiers</option>
                </select>
                <label for="state">Marchandise</label>
              </div>
              <div class="row g-2">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="categories" name="categories">
                    <label for="categories">categories</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="chargemax" name="chargemax">
                    <label for="chargemax">charge Maximal</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="chargemin" name="chargemin">
                    <label for="chargemin">charge Minimal</label>
                  </div>
                </div>
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
        <h1 class="fs-4 text-center lead text-prymary">Bateaux</h1>
      </div>
    </div>
    <div class="dropdown-divider"> </div>
    <div class="row">
      <div class="col-md-6">
        <h5 class="fw-bold mb-8">Liste des bateaux</h5>
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-end">
          <button class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal"> <i class="fas fa-folder-plus">Nouveau</i> </button>
          <a href="#" class="btn btn-success-btn-sm" id="export"> <i class="fas fa-table">Exporter</i> </a>
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
            <h5 class="modal-title" id="UpdateModalLabel">Modifier bateaux</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post" id="UpdateformOrder">
              <input type="hidden" name="id" id="bill_id">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="UpdateNombateau" name="UpdateNombateau">
                <label for="UpdateNombateau">Nom du Bateau</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="UpdateMarque" name="UpdateMarque">
                <label for="UpdateMarque">Marque</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="Updatetypeproduit" aria-label="Updatetypeproduit" name="Updatetypeproduit">
                  <option value="Produit métallurgiques">Produit métallurgiques</option>
                  <option value="Produit Alimentaires">Produit Alimentaires</option>
                  <option value="Produit Forestiers">Produit Forestiers</option>
                </select>
                <label for="state">Marchandise</label>
              </div>
              <div class="row g-2">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Updatecategories" name="Updatecategories">
                    <label for="Updatecategories">categories</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Updatechargemax" name="Updatechargemax">
                    <label for="Updatechargemax">charge Maximal</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Updatechargemin" name="Updatechargemin">
                    <label for="Updatechargemin">charge Minimal</label>
                  </div>
                </div>
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
  <script src="process.js"></script>
</body>

</html>