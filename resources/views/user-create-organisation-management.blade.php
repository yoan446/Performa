<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perfoma</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/sansation.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/performa.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/merriweather-sans.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/inter.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/Styles.css')}}" />
</head>
<body>
    <!-- class pour les notifs d'erreur ou de sccès -->
    

    <div class="d-flex flex-row w-100">
        @include('sidebar')
        <div class="main-content">
            <div class="header-users">
                <h1><i class="fas fa-users"></i> Gestion des Utilisateurs</h1>
            </div>

            <div class="content-area">
                <!-- Action Bar -->
                <div class="action-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
                    </div>
                    <div class="filter-box">
                        <select id="statusFilter">
                            <option value="">Tous les statuts</option>
                            <option value="actif">Actifs</option>
                            <option value="inactif">Inactifs</option>
                        </select>
                        <select id="departmentFilter">
                            <!-- générer dynamiquement -->
                        </select>
                    </div>
                    <button class="btn btn-primary" onclick="openModal()">
                        <i class="fas fa-user-plus"></i> Nouvel Utilisateur
                    </button>
                </div>

                <!-- Statistics Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <img src="{{ asset('images/multiple-users-silhouette.png')}}" alt="">
                        </div>
                        <div class="stat-info">
                            <h3 id="totalUsers">{{ $totalUsers }}</h3>
                            <p>Total Utilisateurs</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon ">
                            <img src="{{ asset('images/check.png')}}" alt="">
                        </div>
                        <div class="stat-info">
                            <h3 id="activeUsers">{{ $activeUsers }}</h3>
                            <p>Utilisateurs Actifs</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon inactive">
                            <img src="{{ asset('images/unable.png')}}" alt="">
                        </div>
                        <div class="stat-info">
                            <h3 id="inactiveUsers">{{ $inactiveUsers }}</h3>
                            <p>Utilisateurs Inactifs</p>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <h3>Liste des Utilisateurs</h3>
                        <div class="table-actions">
                            <button class="btn btn-secondary" onclick="exportUsers()">
                                <i class="fas fa-download"></i> Exporter
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="userTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th>Email</th>
                                    <th>Poste</th>
                                    <th>Departement</th>
                                    <th>Statut</th>
                                    <th>Create Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <!-- contenu générer dynamiquement pas JS via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal pour Utilisateur -->
                <div class="modal custom-modal" id="userModal">
                    <div class="modal-content modal-large">
                        <div class="modal-header">
                            <h3 id="modalTitle">Nouvel Utilisateur</h3>
                            <button class="modal-close" onclick="closeModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="notification" class="hide" style="display: none;"></div>
                            <form id="userForm" onsubmit="saveUser(event)">
                                <div class="form-row">
                                    <input type="hidden" id="user_id" required >
                                    <div class="form-group">
                                        <label for="userFirstName">Prénom *</label>
                                        <input type="text" id="userFirstName" required placeholder="Prénom">
                                    </div>
                                    <div class="form-group">
                                        <label for="userLastName">Nom de famille *</label>
                                        <input type="text" id="userLastName" required placeholder="Nom de famille">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="userEmail">Email *</label>
                                        <input type="email" id="userEmail" required placeholder="email@exemple.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="userPoste">Poste *</label>
                                        <input type="text" id="userPoste" required placeholder="Intitulé du poste">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="userDepartment">Département *</label>
                                        <select id="userDepartment" name="userDepartment" required>
                                            <!-- contenu générer dynamiquement -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="userStatus">Statut *</label>
                                        <select id="userStatus" required>
                                            <option value="Actif">Actif</option>
                                            <option value="Inactif">Inactif</option>
                                        </select>
                                    </div>
                                    <div class="checkbox-class">
                                        <label for="user-role">Rôles :</label><br>
                                        @foreach($roles as $role)
                                            <label class="checkbox-inline" style="margin-right: 15px;">
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->nom_role}}
                                            </label>
                                        @endforeach  
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="userPassword">Mot de passe *</label>
                                    <div class="password-input">
                                        <input type="password" id="userPassword"  placeholder=".....">
                                        <button type="button" class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="passwordIcon"></i>
                                        </button>
                                    </div>
                                    <small class="form-help">Le mot de passe doit contenir au moins 8 caractères</small>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

                <!-- Modal de confirmation -->
                <div class="modal custom-modal" id="confirmModal">
                    <div class="modal-content modal-small">
                        <div class="modal-header">
                            <h3 id="confirmTitle">Confirmation</h3>
                        </div>
                        <div class="modal-body">
                            <div class="confirm-content">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p id="confirmMessage">Êtes-vous sûr de vouloir effectuer cette action ?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-cancel" onclick="closeConfirmModal()">Annuler</button>
                            <button class="btn btn-danger" id="confirmButton" onclick="confirmAction()">
                                Confirmer
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/scripts-users-mange.js')}}"></script>
    <script src="{{ asset('js/script_access.js')}}"></script>
</body>

</html>