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
                    <h5>Welcome back, {{ session('user_name') }} {{ session('user_secondname') }}</h5>
                    <p id="titre-cycle">New Cycle</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div id="notification" style="position: fixed; top: 20px; right: 20px; z-index: 9999;padding: 15px 25px; border-radius: 8px; font-weight: bold; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); "></div>
                <div class="d-flex flex-column align-items-start w-100">
                    <form class="form-perfoma d-flex flex-column align-items-start w-100" onsubmit="saveCycle(event)">
                        @csrf
                        <div class="d-flex flex-column align-items-start w-100">

                        <div class="d-flex flex-row align-items-center w-100">
                                <div class="d-flex flex-column align-items-start part-form">
                                    <h5 class="fw-bold mt-2 mb-4">Cycle Name</h5>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <input class="input-form-control" type="text" name="cycle-name" id="cycle-name" />
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <input type="hidden" name="cycleId" id="cycleId">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center w-100">
                                <div class="d-flex flex-column align-items-start part-form">
                                    <h5 class="fw-bold mt-2 mb-4">Objective Deadline</h5>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label for="startDate">Start Date</label>
                                        <input class="input-form-control" type="date" name="debut-objectif" id="debut-objectif" />
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100">
                                        <label for="endDate">End Date</label>
                                        <input class="input-form-control" type="date" name="fin-objectif" id="fin-objectif" />
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-start part-form ms-auto">
                                    <h5 class="fw-bold mt-2 mb-4">Self Evaluation Deadline</h5>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label for="startDate">Start Date</label>
                                        <input class="input-form-control" type="date" name="debut-auto" id="debut-auto" />
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100">
                                        <label for="endDate">End Date</label>
                                        <input class="input-form-control" type="date" name="fin-auto" id="fin-auto" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center w-100 mt-5">
                                <div class="d-flex flex-column align-items-start part-form">
                                    <h5 class="fw-bold mt-2 mb-4">Manager Evaluation Deadline</h5>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label for="startDate">Start Date</label>
                                        <input class="input-form-control" type="date" name="debut-manager" id="debut-manager" />
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100">
                                        <label for="endDate">End Date</label>
                                        <input class="input-form-control" type="date" name="fin-manager" id="fin-manager" />
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-start part-form">
                                    <h5 class="fw-bold mt-2 mb-4">Comitte Evaluation Deadline</h5>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label for="startDate">Start Date</label>
                                        <input class="input-form-control" type="date" name="debut-comite" id="debut-comite" />
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100">
                                        <label for="endDate">End Date</label>
                                        <input class="input-form-control" type="date" name="fin-comite" id="fin-comite" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center flex-column w-100 mt-5">
                            <button type="submit" class="btn-submit-form" id="btn-create" name="action" value="create">Create</button>
                        </div>

                        <div class="d-flex align-items-center flex-column w-100 mt-5">
                            <button type="submit" class="btn-submit-form" id="btn-update" name="action" value="update" style="display: none;">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script-cycle.js')}}"></script>
    <script>
        if (!localStorage.getItem('selectedCycle')) {
           switchToCreateMode();
        } else {
            document.addEventListener('DOMContentLoaded', function () {
                const cycle = JSON.parse(localStorage.getItem('selectedCycle'));

                if (cycle) {
                    // Nom du cycle
                    document.getElementById('cycle-name').value = cycle.nom || '';

                    // id du cycle
                    document.getElementById('cycleId').value = cycle.id || '';

                    // Objectif : ex. "01/01/2024 au 31/01/2024"
                    const [fixStart, fixEnd] = (cycle.fixation || '').split('au').map(s => s.trim());
                    document.getElementById('debut-objectif').value = formatToDate(fixStart);
                    document.getElementById('fin-objectif').value = formatToDate(fixEnd);

                    // Auto-évaluation
                    const [autoStart, autoEnd] = (cycle.auto_eval || '').split('au').map(s => s.trim());
                    document.getElementById('debut-auto').value = formatToDate(autoStart);
                    document.getElementById('fin-auto').value = formatToDate(autoEnd);

                    // Évaluation Manager
                    const [managerStart, managerEnd] = (cycle.eval_manager || '').split('au').map(s => s.trim());
                    document.getElementById('debut-manager').value = formatToDate(managerStart);
                    document.getElementById('fin-manager').value = formatToDate(managerEnd);

                    // Évaluation Comité
                    const [comiteStart, comiteEnd] = (cycle.eval_comite || '').split('au').map(s => s.trim());
                    document.getElementById('debut-comite').value = formatToDate(comiteStart);
                    document.getElementById('fin-comite').value = formatToDate(comiteEnd);
                }
                switchToUpdateMode();
                // Supprimer après usage
                localStorage.removeItem('selectedCycle');


                // Fonction pour convertir "dd/mm/yyyy" en "yyyy-mm-dd" (pour input type="date")
                function formatToDate(dateStr) {
                    if (!dateStr) return '';
                    const [day, month, year] = dateStr.split('/');
                    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                }
            });
        }


        function switchToUpdateMode() {
            document.getElementById('titre-cycle').textContent = 'Update Cycle';
            document.getElementById('btn-create').style.display = 'none';
            document.getElementById('btn-update').style.display = 'block';
        }

        function switchToCreateMode() {
            document.getElementById('titre-cycle').textContent = 'New Cycle';
            document.getElementById('btn-create').style.display = 'block';
            document.getElementById('btn-update').style.display = 'none';
        }
    </script>
</body>
</html>