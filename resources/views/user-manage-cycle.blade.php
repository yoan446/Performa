<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Performa - Manage Cycles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sansation.css" />
  <link rel="stylesheet" href="css/performa.css" />
  <link rel="stylesheet" href="css/merriweather-sans.css" />
  <link rel="stylesheet" href="css/inter.css" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/style-cycle-evaluation.css" />
</head>
<body>
<div class="d-flex flex-row w-100">
    @include('sidebar')

    <div class="main-content">
    <!-- Header -->
    <div class="header-departement">
        <h1><i class="fas fa-calendar-alt"></i> Gestion des Cycles</h1>
    </div>

    <!-- Barre d'action -->
    <div class="action-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher un cycle..." id="searchCycle">
        </div>
        <button class="btn btn-success" id="btn-open-create">+ Nouveau Cycle</button>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <h3>Liste des Cycles</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Notation Max</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody id="cycle-list"><!-- rempli par JS --></tbody>
        </table>
    </div>
</div>

</div>

<!-- Modal Création / Edition -->
<div class="modal fade" id="cycleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="cycleForm">
            <input type="hidden" id="cycleId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cycleModalLabel">Nouveau Cycle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notemax" class="form-label">Notation Max</label>
                        <input type="number" class="form-control" id="notemax" required >
                    </div>
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date début</label>
                        <input type="date" class="form-control" id="date_debut" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date fin</label>
                        <input type="date" class="form-control" id="date_fin" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/script-cycle-evaluation.js"></script>
</body>
</html>
