<!DOCTYPE html>
<html lang="en">
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
    <style>
        .cycle-table {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
        }
        
        .cycle-table-header {
            background: #14689E;
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }
        
        .cycle-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .cycle-table th {
            background: #f8f9fa;
            color: #14689E;
            padding: 15px 12px;
            font-weight: 600;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        
        .cycle-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .cycle-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .btn-edit {
            background-color: #8DC640;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            margin-right: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-edit img{
            position: relative;
            width: 25px;
            height:25px:
        }
        
        .btn-edit:hover {
            background-color: #7db835;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-delete img{
            position: relative;
            width: 25px;
            height:25px:
        }
        
        .btn-delete:hover {
            background-color: #c82333;
        }
        
        .phase-dates {
            font-size: 11px;
            color: #666;
            margin-top: 2px;
        }
        
        .cycle-name {
            font-weight: 600;
            color: #14689E;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .no-cycles {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        @media (max-width: 768px) {
            .cycle-table th,
            .cycle-table td {
                padding: 10px 8px;
                font-size: 12px;
            }
            
            .btn-edit,
            .btn-delete {
                padding: 4px 8px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex flex-row w-100">
        @include('sidebar')
        <div class="main-content">
            <div class="header">
                <div class="left-header d-flex flex-column">
                    <h5>Welcome back, {{ session('user_name') }} {{ session('user_secondname') }}</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex flex-column align-items-start w-100">
                    <div id="notification" style="position: fixed; top: 20px; right: 20px; z-index: 9999;padding: 15px 25px; border-radius: 8px; font-weight: bold; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); "></div>
                    <!-- Interface de gestion des cycles d'évaluation -->
                    <div class="cycle-table w-100">
                        <div class="cycle-table-header">
                            <h5 class="mb-0">Gestion des Cycles d'Évaluation</h5>
                        </div>
                        
                        <div class="table-responsive">
                           <table>
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Nom du Cycle</th>
                                    <th style="width: 18%;">Fixation des Objectifs</th>
                                    <th style="width: 18%;">Auto-évaluation</th>
                                    <th style="width: 18%;">Évaluation Manager</th>
                                    <th style="width: 18%;">Évaluation Comité</th>
                                    <th style="width: 8%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cycles as $cycle)
                                    <tr data-cycle-id="{{ $cycle->id }}">
                                        <td>
                                            <div class="cycle-name">{{ $cycle->nom_cycle }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($cycle->debut_fixation)->format('d/m/Y') }}</div>
                                            <div class="phase-dates">au {{ \Carbon\Carbon::parse($cycle->fin_fixation)->format('d/m/Y') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($cycle->debut_auto_eval)->format('d/m/Y') }}</div>
                                            <div class="phase-dates">au {{ \Carbon\Carbon::parse($cycle->fin_auto_eval)->format('d/m/Y') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($cycle->debut_eval_manager)->format('d/m/Y') }}</div>
                                            <div class="phase-dates">au {{ \Carbon\Carbon::parse($cycle->fin_eval_manager)->format('d/m/Y') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($cycle->debut_eval_comite)->format('d/m/Y') }}</div>
                                            <div class="phase-dates">au {{ \Carbon\Carbon::parse($cycle->fin_eval_comite)->format('d/m/Y') }}</div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-edit" onclick="goToCreatePeriod(this)" data-id="{{ $cycle->id }}" style="background-color:transparent; border:none;">
                                                    <img src="/images/editing.png" alt="" class="edit-class">
                                                </button>
                                                <button class="btn-delete" onclick="deleteCycle({{ $cycle->id }})" style="background-color:transparent; border:none;">
                                                    <img src="/images/delete.png" alt="" class="delete-class">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; font-style: italic;">Aucun cycle défini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script-cycle.js')}}"></script>
</body>
</html>