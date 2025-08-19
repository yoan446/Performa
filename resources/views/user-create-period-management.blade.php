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
    <link rel="stylesheet" href="{{ asset('css/period.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}" />
</head>

<body>
    <div class="d-flex flex-row w-100">
        @include('sidebar')
        <div class="main-content">
            <div id="notification" style="position: fixed; top: 20px; right: 20px; display: none; z-index: 9999;"></div>
            <div class="header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold">Gestion des Périodes</h5>
                <button class="btn btn-primary" id="btn-open-create">+ Nouvelle période</button>
            </div>

            <div class="body mt-4">
                <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                    <th>#</th>
                    <th>Action (url_endpoints)</th>
                    <th>Cycle (nom)</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody id="periodes-list"><!-- rempli par JS --></tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="periodeModal" tabindex="-1" aria-labelledby="periodeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form id="periodeForm">
                    <input type="hidden" id="periodeId">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="periodeModalLabel">Nouvelle période</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="action_id" class="form-label">Action</label>
                        <select class="form-select" id="action_id" name="action_id" required>
                            <option value="" disabled selected>-- Sélectionner une action --</option>
                            @foreach($actions as $action)
                                <option value="{{ $action->id }}">
                                    {{ $action->description}}
                                </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                        <label for="cycle_id" class="form-label">Cycle</label>
                        <select class="form-select" id="cycle_id" name="cycle_id" required>
                            <option value="" disabled selected>-- Sélectionner un cycle --</option>
                            @foreach($cycles as $cycle)
                                <option value="{{ $cycle->id_cycle}}">{{ $cycle->titre }}</option>
                            @endforeach
                        </select>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="btn-save">Enregistrer</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script-cycle.js')}}"></script>
</body>
</html>