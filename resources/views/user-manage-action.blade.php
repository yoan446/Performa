<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="">
  <title>Performa - Actions</title>

  <!-- Bootstrap 5 CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Autres styles -->
  <link rel="stylesheet" href="css/sansation.css" />
  <link rel="stylesheet" href="css/performa.css" />
  <link rel="stylesheet" href="css/merriweather-sans.css" />
  <link rel="stylesheet" href="css/inter.css" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/action.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <div class="d-flex flex-row w-100">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="main-content">
      <div id="notification" style="position: fixed; top: 20px; right: 20px; display: none; z-index: 9999;"></div>

      <div class="header-departement">
        <h1><i class="fas fa-tasks"></i> Manage Actions</h1>
      </div>

      <div class="content-area">
        <div class="action-bar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search for an action..." id="searchAction" />
          </div>
          <button type="button" class="btn btn-success" onclick="openActionModal()">
            New Action
          </button>
        </div>

        <!-- Table -->
        <div class="table-container">
          <div class="table-header">
            <h3>List of Actions</h3>
          </div>
          <table id="actionTable" class="table table-striped">
            <thead>
              <tr>
                <th>Description</th>
                <th>Module</th>
                <th>Method</th>
                <th>Endpoint</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="actionTableBody">
              <!-- Les lignes seront injectées dynamiquement -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour créer / modifier une action -->
  <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">New Action</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeActionModal()"></button>
        </div>
        <form id="actionForm" onsubmit="return false;">
          <div class="modal-body">
            <!-- Champ caché pour l'ID lors de la modification -->
            <input type="hidden" id="actionId">

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="actionTitle" class="form-label">Action Title</label>
                <input type="text" class="form-control" id="actionTitle" placeholder="Enter action title" required>
              </div>
              <div class="col-md-6">
                <label for="actionModule" class="form-label">Module</label>
                <input type="text" class="form-control" id="actionModule" placeholder="Module name">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="actionMethod" class="form-label">Method</label>
                <select id="actionMethod" class="form-select">
                  <option value="">Select Method</option>
                  <option value="GET">GET</option>
                  <option value="POST">POST</option>
                  <option value="PUT">PUT</option>
                  <option value="DELETE">DELETE</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="actionEndpoint" class="form-label">Endpoint</label>
                <input type="text" class="form-control" id="actionEndpoint" placeholder="/api/example">
              </div>
            </div>

            <div class="mb-3">
              <label for="actionDescription" class="form-label">Description</label>
              <textarea id="actionDescription" class="form-control" rows="3" placeholder="Description of the action"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="create-btn" class="btn btn-success" onclick="saveAction(event)">Create</button>
            <button type="button" id="update-btn" class="btn btn-primary" onclick="updateAction(event)" style="display: none;">Update</button>
            <button type="button" class="btn btn-danger" id="delete-btn" onclick="deleteAction(document.getElementById('actionId').value)" style="display: none;">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeActionModal()">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/script-action.js"></script>
</body>
</html>
