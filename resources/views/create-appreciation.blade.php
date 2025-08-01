<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Performa - Appréciations</title>

  <!-- Styles -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/sansation.css" />
  <link rel="stylesheet" href="css/performa.css" />
  <link rel="stylesheet" href="css/merriweather-sans.css" />
  <link rel="stylesheet" href="css/inter.css" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/Styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
<div class="d-flex flex-row w-100">
  @include('sidebar')

  <div class="main-content">
    <div id="notification" style="position: fixed; top: 20px; right: 20px; display: none; z-index: 9999;"></div>

    <div class="header-departement">
      <h1><i class="fas fa-star-half-alt"></i> Manage Appreciations</h1>
    </div>

    <div class="content-area">
      <div class="action-bar">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search for an appreciation..." />
        </div>
        <button class="btn btn-primary" onclick="openAppreciationModal()">
          <i class="fas fa-plus"></i> New Appreciation
        </button>
      </div>

      <!-- Table -->
      <div class="table-container">
        <div class="table-header">
          <h3>List of Appreciations</h3>
        </div>
        <table id="appreciationTable">
          <thead>
            <tr>
              <th>Code</th>
              <th>Description</th>
              <th>Min Value</th>
              <th>Max Value</th>
              <th>Cycle Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal : Create/Edit Appreciation -->
<div class="modal fade" id="appreciationModal" tabindex="-1" aria-labelledby="appreciationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="appreciationModalLabel">New Appreciation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="appreciationForm">
          <input type="hidden" id="appreciationId" name="id" />

          <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="valeur_min" class="form-label">Valeur min</label>
              <input type="number" class="form-control" id="valeur_min" name="valeur_min" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="valeur_max" class="form-label">Valeur max</label>
              <input type="number" class="form-control" id="valeur_max" name="valeur_max" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="cycle_id" class="form-label">Cycle</label>
            <select class="form-select" id="cycle_id" name="cycle_id" required>
              <option value="">-- Choose a cycle --</option>
              @foreach ($cycles as $cycle)
                <option value="{{ $cycle->id }}">{{ $cycle->nom_cycle }}</option>
              @endforeach
            </select>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="appreciationForm" class="btn btn-primary" id="saveAppreciationBtn">
          Save
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal : Confirm Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p>Are you sure you want to delete this appreciation?</p>
        <input type="hidden" id="deleteAppreciationId">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>

    </div>
  </div>
</div>

<!-- JS scripts -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/scripts-appreciations.js"></script>
</body>
</html>
