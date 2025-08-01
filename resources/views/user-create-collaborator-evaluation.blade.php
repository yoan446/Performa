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
</head>

<body>
    <div class="d-flex flex-row w-100">
        @include('sidebar')        <div class="main-content">
            <div class="header">
                <div class="left-header d-flex flex-column">
                    <h5>Collaborator Evaluation (John Doe FullName)</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period 2025</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div id="notification" style="position: fixed; top: 20px; right: 20px; z-index: 9999;padding: 15px 25px; border-radius: 8px; font-weight: bold; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); "></div>
                <div class="d-flex flex-column align-items-start w-100">
                    <div class="form-perfoma d-flex flex-column align-items-start w-100">
                        <div class="d-flex flex-column align-items-start w-100">
                            <div class="d-flex flex-row align-items-start w-100">
                                <div class="d-flex flex-column align-items-start part-form">
                                    <h5 class="fw-bold mt-2 mb-4">Objective Details</h5>

                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="title">Title</label>
                                        <p id="objective-title">--</p>
                                    </div>
                                    <div class="d-flex align-items-start flex-column w-100 mb-3">
                                        <label class="label-form" for="description">Description</label>
                                        <p id="objective-description">
                                            --
                                        </p>
                                    </div>

                                    <div class="d-flex flex-row w-100">
                                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                                            <label class="label-form" for="period">Period</label>
                                            <p id="objective-period">--</p>
                                        </div>
                                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                                            <label class="label-form" for="weight">Weight</label>
                                            <p id="objective-weight">--</p>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row w-100">
                                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                                            <label class="label-form" for="value">Value</label>
                                            <p id="objective-value">--</p>
                                        </div>
                                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                                            <label class="label-form" for="metric">Metric</label>
                                            <p id="objective-metric">--</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-start part-form">
                                    <form id="evaluationForm-manager" class="d-flex flex-column align-items-start gap-3">

                                        @csrf   {{-- toujours utile si tu veux soumettre « classiquement » un jour --}}

                                        <h5 class="fw-bold">Evaluate Objective</h5>

                                        <!-- ID de l’objectif -->
                                        <input type="hidden" name="objectif_id" id="objectif_id" value="">


                                        <!-- ID de l'utilisateur qui est manager-->
                                        <input type="hidden" name="users_id_manager" id="users_id_manager" value="{{ session('user_id') }}">

                                        <!-- SCORE -->
                                        <div class="w-100">
                                            <label class="form-label" for="note_auto_id">Score</label>
                                            <select name="note" id="note_auto_id" class="form-select" required>
                                                <option value="" disabled selected>–– select ––</option>
                                                @foreach($appreciations as $apr)
                                                    <option value="{{ $apr->id }}">{{ $apr->code }} — {{ $apr->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- COMMENTAIRE -->
                                        <div class="w-100">
                                            <label class="form-label" for="commentaire">Comment</label>
                                            <textarea name="commentaire" id="commentaire" rows="3" maxlength="1000" class="form-control" required></textarea>
                                        </div>

                                        <!-- FICHIER -->
                                        <div class="w-100">
                                            <label class="form-label" for="fichier">Attach a file</label>
                                            <input type="file" name="fichier" id="fichier" class="form-control"
                                                accept=".pdf,.doc,.docx,.zip,.png,.jpg,.jpeg">
                                        </div>

                                        <!-- SUBMIT -->
                                        <div class="mt-4 w-100">
                                            <button type="submit_manager" class="btn btn-primary w-100">Evaluate</button>
                                        </div>
                                    </form>
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
    <script src="{{ asset('js/script-evaluation.js')}}"></script>
</body>
</html>