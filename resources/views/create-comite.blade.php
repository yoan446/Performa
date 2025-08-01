<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Performa - Comite</title>

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
        <h1><i class="fas fa-users"></i> Manage Committees</h1>
      </div>

      <div class="content-area">
        <div class="action-bar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search for a committee..." />
          </div>
          <button class="btn btn-primary" onclick="openModal()">
            <i class="fas fa-plus"></i> New Committee
          </button>
        </div>

        <!-- Table -->
        <div class="table-container">
          <div class="table-header">
            <h3>List of Committees</h3>
          </div>
          <table id="committeeTable">
            <thead>
              <tr>
                <th>Committee Name</th>
                <th>Cycle</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="committeeTableBody">
              <!-- Les lignes seront injectées dynamiquement -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="committeeModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">New Committee</h3>
      </div>
      <div class="modal-body">
        <form id="committeeForm" onsubmit="saveCommittee(event)">
            <input type="hidden" id="committeeId" name="committeeId" />

            <div class="form-group">
                <label for="committeeName">Committee Name *</label>
                <input type="text" id="committeeName" name="nom_comite" required />
            </div>

            <div class="form-group">
                <label for="committeeCycle">Cycle</label>
                <select id="committeeCycle" name="cycle_id" required>
                    <option value="">-- Select Cycle --</option>
                    @foreach ($cycles as $cycle)
                        <option value="{{ $cycle->id }}">{{ $cycle->nom_cycle }}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn btn-cancel" type="button" onclick="closeModal()">Cancel</button>
                <button class="btn btn-primary" type="submit" id="create-btn">
                <i class="fas fa-save"></i> Save
                </button>
                <button class="btn btn-primary" type="submit" onclick="updateCommittee(event)" id="update-btn" style="display: none;">
                <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/scripts-comite.js"></script>
</body>
</html>
