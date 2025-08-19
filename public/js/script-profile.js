document.addEventListener('DOMContentLoaded', async function () {
    const token = localStorage.getItem('access_token');
    if (!token) return console.warn('Aucun token trouvé.');

    let user = JSON.parse(localStorage.getItem('user_profile'));

    try {
        // Si le profil n'est pas en localStorage, le récupérer depuis l'API
        if (!user) {
            const response = await fetch('/api/me', {
                headers: { 'Authorization': 'Bearer ' + token }
            });
            if (!response.ok) throw new Error('Impossible de récupérer le profil utilisateur');

            const userData = await response.json();
            user = {
                id: userData.id,
                name: userData.name,
                secondname: userData.secondname || '',
                email: userData.email,
                manager_id: userData.manager_id || null,
                manager_name: '',
                roles: userData.roles || []
            };

            // Récupérer le manager si présent
            if (user.manager_id) {
                const managerResponse = await fetch(`/api/users/${user.manager_id}`, {
                    headers: { 'Authorization': 'Bearer ' + token }
                });
                if (managerResponse.ok) {
                    const managerData = await managerResponse.json();
                    user.manager_name = managerData.name + ' ' + (managerData.secondname || '');
                } else {
                    user.manager_name = 'Non disponible';
                }
            }

            // Stocker le profil complet dans le localStorage
            localStorage.setItem('user_profile', JSON.stringify(user));
        }

        // Stocker les rôles sous forme de tableau de noms
        if (user.roles?.length) {
            const rolesNames = user.roles.map(role => role.nom_role);
            localStorage.setItem('user_roles', JSON.stringify(rolesNames));
        }

        // Mettre à jour le header
        const usernameSpan = document.getElementById('username');
        const username = document.getElementById('name');
        const managername = document.getElementById('mangername');
        if (usernameSpan) usernameSpan.textContent = user.name + ' ' + (user.secondname || '');
        if (username) username.textContent = user.name + ' ' + (user.secondname || '');
        if (managername) managername.textContent = user.manager_name || 'Non disponible';

        // Mettre à jour la sidebar
        const userNameEl = document.getElementById('user-name');
        const userEmailEl = document.getElementById('user-email');
        if (userNameEl) userNameEl.textContent = user.name + ' ' + (user.secondname || '');
        if (userEmailEl) userEmailEl.textContent = user.email;

    } catch (err) {
        console.error(err);
    }
});
