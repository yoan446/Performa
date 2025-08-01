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
                    <h5>Welcome back, John Doe</h5>
                    <p>Evaluation status</p>
                </div>
                <div class="right-header d-flex ms-auto">
                    <button class="btn-period">Period 2025</button>
                </div>
            </div>
            <div class="body d-flex flex-column align-items-center w-100">
                <div class="d-flex flex-column align-items-start w-100">
                    <h5 class="mt-3 mb-5 fw-bold">Create New User</h5>
                    <form class="form-perfoma d-flex flex-column align-items-start w-100">
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="title">Username</label>
                            <input class="input-form-control" type="text" name="title" id="title" />
                        </div>
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="email">Email</label>
                            <input class="input-form-control" type="email" name="email" id="email" />
                        </div>
                        <div class="d-flex align-items-start flex-column w-50 mb-3">
                            <label for="profile">Profile</label>
                            <input class="input-form-control" type="text" name="profile" id="profile" />
                        </div>
                        <div class="d-flex align-items-center flex-column w-50 mt-5">
                            <button class="btn-submit-form">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/script_access.js')}}"></script>
</body>

</html>