<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performa - Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sansation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/performa.css') }}">
</head>

<body class="bg-background">

    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center px-3">
        <div class="w-100" style="max-width: 400px;">
            <h4 class="mb-2">Connexion</h4>
            <p class="mb-4 text-muted">Ravi de vous revoir, veuillez entrer vos identifiants</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="w-100">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control input-login" placeholder="Entrez votre email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control input-login" placeholder="Entrez votre mot de passe" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-submit">Se connecter</button>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>
