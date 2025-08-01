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
                    <h5>Welcome back, {{ session('user_name') }} {{ session('user_secondname') }} </h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div id="notification" style="position: fixed; top: 20px; right: 20px; z-index: 9999;padding: 15px 25px; border-radius: 8px; font-weight: bold; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); "></div>
                <div class="d-flex flex-column align-items-start w-100">
                    <h5 class="mt-3 mb-5 fw-bold" id="formTitle">Create New Objective</h5>
                   <form class="form-perfoma d-flex flex-column align-items-start w-100" onsubmit="saveObjectif(event)" id="objectifForm">
                        @csrf

                        <!-- Titre -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="titre">Title</label>
                            <input class="input-form-control" type="text" name="titre" id="titre" />
                        </div>

                        <!-- Description -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="description">Description</label>
                            <textarea class="textarea-form-control" name="description" id="description"></textarea>
                        </div>

                        <!-- Metric -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="metric">Metric</label>
                            <select class="input-form-control" name="metric" id="metric">
                                <option value="Pourcentage">Pourcentage</option>
                                <option value="Nombre">Nombre</option>
                                <option value="Score">Score</option>
                                <option value="Temps">Temps</option>
                            </select>
                        </div>

                        <!-- Valeur -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="valeur">Value</label>
                            <input class="input-form-control" type="number" name="valeur" id="valeur"  />
                        </div>

                        <!-- Poids -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="poids">Weight</label>
                            <input class="input-form-control" type="number" name="poids" id="poids" />
                        </div>

                        <!-- Période -->
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="start_date">Période</label>
                            <div class="d-flex w-100 gap-2">
                                <div class="d-flex flex-column w-50">
                                    <label for="date_debut">Date de début</label>
                                    <input type="date" id="date_debut" name="date_debut" class="input-form-control">
                                </div>
                                <div class="d-flex flex-column w-50">
                                    <label for="date_fin">Date de fin</label>
                                    <input type="date" id="date_fin" name="date_fin" class="input-form-control">
                                </div>
                            </div>
                        </div>

                        <!-- manager_id et agent_id (automatiquement depuis l'utilisateur connecté) -->
                        <input type="hidden" name="manager_id" id="manager_id" value="{{ session('user_managerid') }}">
                        <input type="hidden" name="agent_id" id="agent_id" value="{{ session('user_id') }}">
                        <input type="hidden" name="objectifid" id="objectifid" value="">

                        <div class="d-flex align-items-center flex-column w-50 mt-5">
                            <button type="submit" class="btn-submit-form" id="create">Create</button>
                        </div>
                        <div class="d-flex align-items-center flex-column w-50 mt-5">
                            <button type="submit" class="btn-submit-form" style="display:none;" id="update">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script-objectifs.js')}}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const objectifBrut = localStorage.getItem('objectifEnCours');
        if (objectifBrut) {
            const objectif = JSON.parse(objectifBrut);
            activerModeEdition(objectif);
            localStorage.removeItem('objectifEnCours');
        }
    });
    </script>

</body>
</html>