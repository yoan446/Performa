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
</head>

<body>
    <div class="d-flex flex-row w-100">
        @include('sidebar')
        <div class="main-content">
            <div class="header">
                <div class="left-header d-flex flex-column">
                    <h5>Self Evaluation</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex flex-row align-items-center w-100">
                    <div class="card-panel">
                        <h5 class="">Personals Informations</h5>
                        <div class="divider"></div>
                        <div class="body-panel-card mt-2">
                            <ul class="list-unstyled">
                                <li class="mb-2">Name: {{ session('user_name') }} {{ session('user_secondname') }} </li>
                                <li class="mb-2">Direction: {{ session('user_direction') }}</li>
                                <li class="mb-2">Identifiant: {{ session('user_id') }}</li>
                                <li>Nom Manager: {{ session('user_manager') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-panel ms-auto">
                        <h5 class="">Manager Strategic Objectives</h5>
                        <div class="divider"></div>
                        <div class="body-panel-card mt-2">
                            <ul class="list-unstyled">
                                <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                                <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                                <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                                <li  class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center w-100 mt-5">
                    <div class="full-card-panel">
                        <div class="d-flex align-items-center w-100 pt-3 ps-4 pe-4 pb-3">
                            <h5 class="mb-0">Objectives Evaluation</h5>
                            <i class="icon-ellipsis-vertical ms-auto" style="color: #98A2B3 !important"></i>
                        </div>
                        <div class="w-100 table-responsive pb-0">
                            <table class="table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">titre</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Period</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Metric</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($objectifs as $objectif)
                                        <tr data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" class="clickable">
                                            <td hidden data-id="{{ $objectif->id }}" style="text-align:left;">
                                                
                                            </td>
                                            <td class="d-flex align-items-start flex-column">
                                                <span style="color: #000000">{{ $objectif->titre }}</span>
                                            </td>
                                            <td>
                                                <div class="truncate">
                                                    {{$objectif->description}}
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($objectif->date_debut)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($objectif->fin)->format('M d, Y') }}</td>
                                            <td>{{ $objectif->poids }}</td>
                                            <td>{{ $objectif->valeur }}</td>
                                            <td>{{ $objectif->metric }}</td>
                                            <td class="clickable-td" style="cursor: pointer;">
                                                <span class="btn-link">Evaluate</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Aucun objectif trouvé.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Détais Evaluation</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"aria-label="Close"></button>
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
                                            <label class="label-form" for="period">Appreciation</label>
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
    <script src="{{ asset('js/script_access.js')}}"></script>
    <script src="{{ asset('js/script-evaluation.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll("table tbody tr");

            rows.forEach((row) => {
                row.addEventListener("click", function () {
                    const cells = this.querySelectorAll("td");

                    // On vérifie qu'on ne clique pas sur les boutons (edit/delete)
                    if (event.target.closest("span") || event.target.tagName === "BUTTON") {
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
                        pElements[7].textContent = "No appréciation";
                        pElements[8].textContent = "No comment"; // Comments placeholder
                    }
                });
            });
        });
    </script>

</body>

</html>