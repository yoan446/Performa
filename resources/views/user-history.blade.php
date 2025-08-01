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
                    <h5>Evaluations History</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period {{ now()->year }}</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex flex-row align-items-center w-100 mt-1">
                    <div class="full-card-panel">
                        <div class="d-flex align-items-center w-100 pt-3 ps-4 pe-4 pb-3">
                            <h5 class="mb-0">Objectives</h5>
                            <i class="icon-ellipsis-vertical ms-auto" style="color: #98A2B3 !important"></i>
                        </div>
                        <div class="w-100 table-responsive pb-0">
                            <table class="table mb-0 align-middle bottom-border">
                                <thead>
                                    <tr>
                                        <th scope="col" class="w-25">Self Evaluation</th>
                                        <th scope="col" class="w-25">Manager Evaluation</th>
                                        <th scope="col" class="w-25">Comitee Evaluation</th>
                                        <th scope="col" class="w-25">Period</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Exceed Expectation</td>
                                        <td>Exceed Expectation</td>
                                        <td>Exceed Expectation</td>
                                        <td>2020</td>
                                    </tr>
                                    <tr>
                                        <td>Exceed Expectation</td>
                                        <td>Exceed Expectation</td>
                                        <td>Exceed Expectation</td>
                                        <td>2021</td>
                                    </tr>
                                    <tr>
                                        <td>Meet Expectation</td>
                                        <td>Meet Expectation</td>
                                        <td>Meet Expectation</td>
                                        <td>2022</td>
                                    </tr>
                                    <tr>
                                        <td>Outstanding</td>
                                        <td>Outstanding</td>
                                        <td>Outstanding</td>
                                        <td>2023</td>
                                    </tr>
                                    <tr>
                                        <td>Need Improvement</td>
                                        <td>Need Improvement</td>
                                        <td>Need Improvement</td>
                                        <td>2024</td>
                                    </tr>
                                    <tr>
                                        <td>Significant GAP</td>
                                        <td>Significant GAP</td>
                                        <td>Significant GAP</td>
                                        <td>2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center w-100 pt-3 ps-4 pe-4 pb-3">
                            <h6 class="mb-0">Page 1 of 10</h6>
                            <button class="btn-pagination me-2 ms-auto">Previous</button>
                            <button class="btn-pagination">Next</button>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                ...
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
</body>

</html>