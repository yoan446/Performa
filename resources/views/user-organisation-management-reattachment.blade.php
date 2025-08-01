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
                    <h5>Organisation Management</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period 2025</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex align-items-start w-100 mb-3 mt-1">
                    <h5 class="fw-bold" style="font-size: 1.5rem;">Reattachement</h5>
                </div>
                <div class="d-flex flex-column align-items-center w-100 mt-1">
                    <div class="mt-2 mb-3 search-bar">
                        <input type="text" class="input-search" placeholder="Search for trades" />
                        <button class="btn-pagination ms-auto">
                            <i class="icon-align-center me-2"></i>
                            Filters
                        </button>
                    </div>
                    <div class="full-card-panel">
                        <div class="w-100 table-responsive pb-0">
                            <table class="table mb-0 align-middle bottom-border border-radius-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="">Username</th>
                                        <th scope="col" class="">Email</th>
                                        <th scope="col" class="">Manager</th>
                                        <th scope="col" class="">Unit</th>
                                        <th scope="col" class="">Comitee</th>
                                        <th scope="col" class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">TSLA BUY</span>
                                            <span>Tesla, Inc</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John.Doe</td>
                                        <td>DASI</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">ARKG BUY</span>
                                            <span>ARK Genomic Revolution ETF</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John.Doe FullName</td>
                                        <td>DASI</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">MTCH SELL</span>
                                            <span>Match Group, Inc,</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John.Doe</td>
                                        <td>DASI</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">TSLA BUY</span>
                                            <span>Tesla, Inc</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John Doe FullName</td>
                                        <td>DQHSE</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">TSLA BUY</span>
                                            <span>Tesla, Inc</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John.Doe</td>
                                        <td>DASI</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-start flex-column">
                                            <span style="color: #000000">TSLA BUY</span>
                                            <span>Tesla, Inc</span>
                                        </td>
                                        <td>John.doefullname@gmail.com</td>
                                        <td>John.Doe</td>
                                        <td>DASI</td>
                                        <td>Johnes.Doe</td>
                                        <td>
                                            <a href="#" class="btn-link">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center w-100 pt-3 ps-4 pe-4 pb-3">
                            <button class="btn-pagination me-2 me-auto">
                                <i class="icon-arrow-left me-2"></i>Previous
                            </button>
                            <div class="d-flex align-items-center">
                                <button class="btn-page btn-page-active">1</button>
                                <button class="btn-page">2</button>
                                <button class="btn-page">3</button>
                                <button class="btn-page">...</button>
                                <button class="btn-page">8</button>
                                <button class="btn-page">9</button>
                                <button class="btn-page">10</button>
                            </div>
                            <button class="btn-pagination ms-auto">
                                Next
                                <i class="icon-arrow-right ms-2"></i>
                            </button>
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
    <script src="{{ asset('js/script_access.js')}}"></script>
</body>
</html>