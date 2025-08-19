document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const notifDiv = document.createElement('div');
    notifDiv.style.display = 'none';
    document.querySelector('.w-100').prepend(notifDiv);

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (response.ok && data.access_token) {
                // Stocker le token
                localStorage.setItem('access_token', data.access_token);

                // Notification succès
                notifDiv.className = 'alert alert-success';
                notifDiv.textContent = 'Connexion réussie !';
                notifDiv.style.display = 'block';

                // Redirection vers le dashboard (où profile.js sera chargé)
                setTimeout(() => {
                    window.location.href = dashboardUrl;
                }, 1000);
            } else {
                notifDiv.className = 'alert alert-danger';
                notifDiv.textContent = data.error || 'Erreur lors de la connexion.';
                notifDiv.style.display = 'block';
            }

        } catch (error) {
            console.error('Erreur réseau :', error);
            notifDiv.className = 'alert alert-danger';
            notifDiv.textContent = 'Impossible de se connecter, veuillez réessayer.';
            notifDiv.style.display = 'block';
        }
    });
});
