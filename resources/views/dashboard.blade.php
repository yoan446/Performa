<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="d-flex flex-row w-100">
       @include('sidebar')

       <!-- Bouton burger (visible en mobile uniquement) -->
        <button id="burger-btn" class="d-lg-none menu-burger" aria-label="Ouvrir le menu">
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        </button>
        <div class="main-content" id="main-content">
            <div class="header">
                <div class="left-header d-flex flex-column">
                    <h5 >Welcome back,<span id="username" style="font-size:2rem;font-weight:bold;"> {{ session('user_name') }} {{ session('user_secondname') }} </span></h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex flex-row align-items-center w-100" aria-hidden="true">
                    <div class="card-panel">
                        <h5 class="">Personals Informations</h5>
                        <div class="divider"></div>
                        <div class="body-panel-card mt-2">
                            <ul class="list-unstyled">
                                <li class="mb-2">Name: {{ session('user_name') }} {{ session('user_secondname') }} </li>
                                <li class="mb-2">Direction: {{ session('user_direction') }}</li>
                                <!-- <li class="mb-2">Identifiant: {{ session('user_id') }}</li> -->
                                <li>Manager Name: {{ session('user_manager') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-panel ms-auto">
                       <h5 class="">Objectives Dashboard</h5>
                       <div class="divider"></div>
                       <div class="body-panel-card mt-2">
                            <div class="row g-3">
                                <div class="col-lg-6 col-md-6">
                                    <div class="stat-card-user validated">
                                        <span class="stat-number-user">{{ $stats['Validated'] }}</span>
                                        <div class="stat-label-user">Validated</div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="stat-card-user completed">
                                        <span class="stat-number-user">{{ $stats['Completed'] }}</span>
                                        <div class="stat-label-user">Completed</div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="stat-card-user pending">
                                        <span class="stat-number-user">{{ $stats['Pending'] }}</span>
                                        <div class="stat-label-user">Pending Validation</div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="stat-card-user rejected">
                                        <span class="stat-number-user">{{ $stats['Rejected'] }}</span>
                                        <div class="stat-label-user">Rejected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center w-100 mt-5">
                    <div class="card-panel-shortcut">
                        <div class="d-flex align-items-center w-100">
                            <div class="d-flex align-items-center w-25">
                                <img src="{{ asset('images/cible.png') }}" alt="Cible" id="objectif_img">
                            </div>
                            <a href="{{ route('user-create-objective') }}" class="text-decoration-none text-dark" style="all: unset; cursor: pointer;">
                                <div class="d-flex flex-column w-75 item ms-5" style="cursor: pointer;">
                                    <h5 class="mb-0 w-100">Create New Objective</h5>
                                    <p class="w-100 mb-0">Add New Objective and Assign to User</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-panel-shortcut ms-auto">
                        <div class="d-flex align-items-center w-100">
                            <div class="d-flex align-items-center w-25">
                                <img src="{{ asset('images/evaluation.png') }}" alt="evaluation" id="eval_img">
                            </div>
                            <a href="{{ route('dashboard-self-evaluation') }}" class="text-decoration-none text-dark" style="all: unset; cursor: pointer;">
                                <div class="d-flex flex-column w-75 item ms-5" style="cursor: pointer;">
                                    <h5 class="mb-0 w-100">Perform Self Evaluation</h5>
                                    <p class="w-100 mb-0">Submit Self-Evaluation for Objective</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center w-100 mt-5">
                    <div class="full-card-panel">
                        <div class="d-flex align-items-center w-100 p-4">
                            <h5 class="mb-0">Objectives</h5>
                            <i class="icon-ellipsis-vertical ms-auto" style="color: #98A2B3 !important"></i>
                        </div>
                        <div class="w-100 table-responsive pb-0">
                           <table class="table mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Descriptions</th>
                                    <th scope="col">Period</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Value</th>
                                    <th scope="col">Metric</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($objectifs as $objectif)
                                    <tr data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                        <td>{{ $objectif->id }}</td>
                                        <td>{{ $objectif->titre }}</td>
                                        <td>{{ $objectif->description }}</td>
                                        <td>{{ $objectif->date_debut}} - {{ $objectif->date_fin}}</td>
                                        <td>{{ $objectif->poids }}</td>
                                        <td>{{ $objectif->valeur }}</td>
                                        <td>{{ $objectif->metric }}</td>
                                        <td>
                                            @if ($objectif->statut_objectif === 'En Attente de Validation')
                                                <span class="badge bg-warning">En Attente</span>
                                            @elseif ($objectif->statut_objectif === 'Valider')
                                                <span class="badge bg-success">Validé</span>
                                            @elseif ($objectif->statut_objectif === 'Rejeter')
                                                <span class="badge-danger" style="padding:5px; border-radius:15px;width:55px">Rejeté</span>
                                            @else
                                                <span class="badge bg-secondary">Non défini</span>
                                            @endif
                                        </td>
                                        <td class="button-class">
                                            <button title="Modifier" class="btn-modifier" data-id="{{ $objectif->id }}" style="background-color:transparent; border:none;">
                                                <img src="/images/editing.png" alt="" class="edit-class">
                                            </button>

                                            <button title="Supprimer" class="btn-delete" data-id="{{ $objectif->id }}" style="background-color:transparent; border:none;">
                                                <img src="/images/delete.png" alt="" class="delete-class">
                                            </button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No objectives Found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Détais Objectives</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                               <div class="d-flex align-items-start flex-column w-100">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="title">Title</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="description">Description</label>
                                        <p>
                                            
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form"  for="status">Status</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="period">Period</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="weight">Weight</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="period">Value</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="period">Metric</label>
                                        <p></p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="period">Comments</label>
                                        <p></p>
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script-objectifs.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll("table tbody tr");

            rows.forEach((row) => {
                row.addEventListener("click", function () {
                    const cells = this.querySelectorAll("td");

                    // On vérifie qu'on ne clique pas sur les boutons (edit/delete)
                    if (event.target.closest("button") || event.target.tagName === "BUTTON") {
                        return;
                    }

                    // On récupère les <p> du offcanvas dans l'ordre
                    const pElements = document.querySelectorAll("#offcanvasRight .offcanvas-body p");

                    // Injection des données dans l'ordre correspondant
                    if (cells.length >= 8 && pElements.length >= 8) {
                        pElements[0].textContent = cells[1].textContent.trim(); // Title
                        pElements[1].textContent = cells[2].textContent.trim(); // Description
                        pElements[2].textContent = cells[7].textContent.trim(); // Status
                        pElements[3].textContent = cells[3].textContent.trim(); // Period
                        pElements[4].textContent = cells[4].textContent.trim(); // Weight
                        pElements[5].textContent = cells[5].textContent.trim(); // Value
                        pElements[6].textContent = cells[6].textContent.trim(); // Metric
                        pElements[7].textContent = "Pas de commentaire"; // Comments placeholder
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const burgerBtn = document.getElementById('burger-btn');
            const sidebar = document.getElementById('sidebar');

            burgerBtn.addEventListener('click', function () {
                sidebar.classList.toggle('open');
            });
        });
    </script>

</html>