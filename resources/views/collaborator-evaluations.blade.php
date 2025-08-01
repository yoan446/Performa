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
        <div class="main-content">
            <div class="header">
                <div class="left-header d-flex flex-column">
                    <h5>Collaborator Evaluations</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100 mt-3">
                <div class="d-flex flex-row align-items-center w-100">
                    <div class="card-panel-obj">
                        <div class="header-card d-flex align-items-center flex-row w-100 ps-4 pe-4">
                            <h5 class="w-75 fw-bold">List of Collaborators</h5>
                            <h5 class="ms-auto w-25 fw-bold">Status</h5>
                        </div>
                        @php
                            $managerId = session('user_id');
                            $collaborateurs = \App\Models\User::where('manager_id', $managerId)->get();
                        @endphp

                        @forelse ($collaborateurs as $collaborateur)
                            <div class="item-card d-flex align-items-center w-100 ps-4 pe-4" data-user-id="{{ $collaborateur->id }}" onclick="getObjectifstoEvaluate(this);" style="cursor: pointer;">
                                <div class="w-75">{{ $collaborateur->name }} {{ $collaborateur->secondname }}</div>
                                <div class="w-25">{{ $collaborateur->statut_user ?? 'Inconnu' }}</div>
                            </div>
                        @empty
                            <div class="item-card d-flex align-items-center w-100 ps-4 pe-4">
                                <div class="w-100 text-center text-muted">Aucun collaborateur trouvé.</div>
                            </div>
                        @endforelse

                    </div>
                    <div class="card-panel-obj ms-auto">
                        <div class="header-card d-flex align-items-center flex-row w-100 ps-4 pe-4">
                            <h5 class="w-100 fw-bold">Collaborators Statistics</h5>
                        </div>
                        <div class="item-card d-flex align-items-center w-100 ps-4 pe-4">
                            <div class="w-75 ps-4">Complete</div>
                            <span class="stats-users-obj" id="complete"></span>
                        </div>
                        <div class="item-card d-flex align-items-center w-100 ps-4 pe-4">
                            <div class="w-75 ps-4">Pending Validation</div>
                            <span class="stats-users-obj" id="Pending"></span>
                        </div>
                        <div class="item-card d-flex align-items-center w-100 ps-4 pe-4">
                            <div class="w-75 ps-4">Rejected</div>
                            <span class="stats-users-obj" id="Rejected"></span>
                        </div>
                        <div class="item-card d-flex align-items-center w-100 ps-4 pe-4">
                            <div class="w-75 ps-4">Validated</div>
                            <span class="stats-users-obj" id="Validated"></span>
                        </div>
                    </div>
                </div>
               
                <div class="d-flex flex-row align-items-center w-100 mt-5">
                    <div class="full-card-panel">
                        <div class="d-flex align-items-center w-100 pt-3 ps-4 pe-4 pb-3">
                            <h5 class="mb-0">Evaluation</h5>
                            <i class="icon-ellipsis-vertical ms-auto" style="color: #98A2B3 !important"></i>
                        </div>
                        <div class="w-100 table-responsive pb-0">
                            <table class="table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Period</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Metric</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="objectifs-body">
                                    <!-- contenu généré dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Détails Evaluation</h5>
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
    <script src="{{ asset('js/script_access.js')}}"></script>
    <script src="{{ asset('js/script-evaluation.js')}}"></script>
    <script>
        const evaluationUrl = "{{ route('user-create-collaborator-evaluation') }}";
    </script>

</body>
</html>