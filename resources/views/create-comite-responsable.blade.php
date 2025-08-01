<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <!-- CSS Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<div class="d-flex flex-row w-100">
  @include('sidebar')

  <div class="main-content">
    <div id="notification" style="position: fixed; top: 20px; right: 20px; z-index: 9999;padding: 15px 25px; border-radius: 8px; font-weight: bold; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); "></div>

    <div class="header-departement">
      <h1><i class="fas fa-link"></i> Link Committee to Responsibles</h1>
    </div>

    <div class="content-area">
      <div class="action-bar">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="searchCommitteeLink" placeholder="Search for a committee..." />
        </div>
        <button class="btn btn-primary" onclick="openLinkModal()">
          <i class="fas fa-link"></i> Link Committee
        </button>
      </div>

      <!-- Table -->
      <div class="table-container">
        <div class="table-header">
          <h3>Committee - Responsible Links</h3>
        </div>
        @php
          $grouped = $liaisons->groupBy('comite_id');
        @endphp
        <table id="linkCommitteeTable">
          <thead>
            <tr>
              <th>Committee Name</th>
              <th>Responsibles</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="linkCommitteeTableBody">
            @foreach($grouped as $comite_id => $liaisonGroup)
              <tr data-id="{{ $comite_id }}">
                <td>{{ $liaisonGroup->first()->nom_comite }}</td>
                <td>
                  <ul>
                    @forelse($liaisonGroup as $liaison)
                      <li>{{ $liaison->name }} {{ $liaison->secondname }}</li>
                    @empty
                      <li><em>Aucun responsable</em></li>
                    @endforelse
                  </ul>
                </td>
                <td>
                  <button class="btn-edit" onclick="editLink({{ $comite_id }})">
                    <img src="/images/editing.png" class="edit-class" alt="edit link" />
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- ✅ MODAL COMITE - RESPONSABLES -->
    <div class="modal" id="linkCommitteeModal">
      <div class="modal-content">
        <div class="modal-header">
          <h3 id="linkModalTitle">Link Committee to Responsibles</h3>
        </div>
        <div class="modal-body">
          <form id="linkCommitteeForm" onsubmit="saveCommitteeLink(event)">
            <input type="hidden" id="linkId" name="linkId" />

            <!-- Sélection comité -->
            <div class="form-group">
              <label for="linkCommitteeSelect">Committee *</label>
              <select id="linkCommitteeSelect" name="comite_id" class="form-control" required>
                <option value="">-- Select Committee --</option>
                @foreach($comites as $comite)
                    <option value="{{ $comite->id }}">{{ $comite->nom_comite }}</option>
                @endforeach
            </select>

            </div>

            <!-- Sélection utilisateurs -->
            <div class="form-group">
              <label for="responsableSelect">Responsibles *</label>
              <select id="responsableSelect" name="user_ids[]" class="form-control" multiple="multiple" required>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }} {{ $user->secondname }}</option>
                @endforeach
              </select>
              <small class="form-hint">Sélection multiple possible (Ctrl ou Cmd).</small>
            </div>

            <div class="modal-footer">
              <button class="btn btn-cancel" type="button" onclick="closeLinkModal()">Cancel</button>
              <button class="btn btn-primary" type="submit" id="create-link-btn">
                <i class="fas fa-link"></i> Link
              </button>
              <button class="btn btn-primary" type="submit" onclick="updateCommitteeLink(event)" id="update-link-btn" style="display: none;">
                <i class="fas fa-sync-alt"></i> Update Link
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JS scripts -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/scripts-comite-responsable.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
  $('#responsableSelect').select2({
    placeholder: "Sélectionner les responsables du comité",
    allowClear: true,
    dropdownParent: $('#linkCommitteeModal') // 👈 Ajoute cette ligne
  });
});

</script>

</body>
</html>
