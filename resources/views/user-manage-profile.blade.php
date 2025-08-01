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
    <link rel="stylesheet" href="{{ asset('css/Styles.css')}}" />
</head>
<body>
    <div class="d-flex flex-row w-100">
        @include('sidebar')
        <div class="main-content">
            <div class="headers">
            <div class="tools-bar">
                <h3>Edit Profile</h3>
                <div class="icones-img">
                    <div class="img-account"></div>
                </div>
            </div>
        </div>
        
        <div class="body">
            <form action="" method="post" class="form-user-profile" enctype="multipart/form-data">
                <div class="edit-picture">
                    <div class="img-profile"></div>
                    <label for="profile-pic-upload" class="edit-btn"><img src="{{asset('images/pen.png')}}" alt=""></label>
                    <input type="file" id="profile-pic-upload" name="profile_picture" accept="image/*">
                </div>
                
                <div class="form-grid">
                    @php
                        $agentId = session('user_id');
                        $collaborateur = \App\Models\User::where('id', $agentId)->first();
                    @endphp

                    @if ($collaborateur)
                        <div class="input-fill">
                            <input type="hidden" id="user_id" value="{{ session('user_id') }}">
                            <label for="first-name">Prénom</label>
                            <input type="text" name="first_name" id="first-name" required placeholder="Votre prénom" value="{{ $collaborateur->name }}">
                        </div>

                        <div class="input-fill">
                            <label for="second-name">Nom de famille</label>
                            <input type="text" name="second_name" id="second-name" required placeholder="Votre nom" value="{{ $collaborateur->secondname }}">
                        </div>

                        <div class="input-fill">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" name="email" id="email" required placeholder="votre@email.com" value="{{ $collaborateur->email }}">
                        </div>

                        <div class="input-fill">
                            <label for="job-name">Profession</label>
                            <input type="text" name="job_name" id="job-name" placeholder="Votre profession" value="{{ $collaborateur->user_job_name }}">
                        </div>
                    @else
                        <p class="text-danger">Aucun collaborateur trouvé pour cet ID.</p>
                    @endif
                </div>

                
                <fieldset class="password-section">
                    <legend>Changer le mot de passe</legend>
                    <div class="password-grid">
                        <div class="input-fill">
                            <label for="current-password">Mot de passe actuel</label>
                            <input type="password" name="current_password" id="current-password" required placeholder="••••••••">
                        </div>
                        
                        <div class="input-fill">
                            <label for="new-password">Nouveau mot de passe</label>
                            <input type="password" name="new_password" id="new-password" required placeholder="••••••••">
                        </div>
                        
                        <div class="input-fill">
                            <label for="confirm-password">Confirmer le nouveau mot de passe</label>
                            <input type="password" name="confirm_password" id="confirm-password" required placeholder="••••••••">
                        </div>
                    </div>
                </fieldset>
                
                <div class="submit-container">
                    <button type="button" class="submit-btn" id="btn-update-user">Enregistrer les modifications</button>
                </div>

            </form>
        </div>
        </div>
        
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script>
        // Gestion de l'upload d'image
        document.getElementById('profile-pic-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgProfile = document.querySelector('.img-profile');
                    imgProfile.style.backgroundImage = `url(${e.target.result})`;
                    imgProfile.style.backgroundSize = 'cover';
                    imgProfile.style.backgroundPosition = 'center';
                    imgProfile.innerHTML = '';
                };
                reader.readAsDataURL(file);
            }
        });

        // Animation des inputs au focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Validation en temps réel des mots de passe
        const newPassword = document.getElementById('new-password');
        const confirmPassword = document.getElementById('confirm-password');

        function validatePasswords() {
            if (newPassword.value && confirmPassword.value) {
                if (newPassword.value === confirmPassword.value) {
                    confirmPassword.style.borderColor = '#4CAF50';
                } else {
                    confirmPassword.style.borderColor = '#f44336';
                }
            }
        }

        newPassword.addEventListener('input', validatePasswords);
        confirmPassword.addEventListener('input', validatePasswords);
    </script>
    <script src="{{ asset('js/script_access.js')}}"></script>
    <script src="{{ asset('js/scripts-users-mange.js')}}"></script>
</body>
</html>