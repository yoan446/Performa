// Récupérer les rôles stockés dans le localStorage
function getRolesFromLocalStorage() {
    return JSON.parse(localStorage.getItem('user_roles')) || [];
}

// Fonction pour vérifier si l'utilisateur a l'un des rôles requis
function checkRole(element, roles) {
    const allowedRoles = element.dataset.role?.split(',').map(r => r.trim()) || [];
    return allowedRoles.some(role => roles.includes(role));
}

// Appliquer le filtre à tous les éléments ayant un data-role
function applySidebarRoles() {
    const roles = getRolesFromLocalStorage();

    // Vérifier que les rôles existent
    if (roles.length === 0) {
        console.warn('Aucun rôle trouvé dans le localStorage.');
        return;
    }

    document.querySelectorAll('[data-role]').forEach(el => {
        if (checkRole(el, roles)) {
            el.style.display = '';  // Afficher l'élément
        } else {
            el.style.display = 'none';  // Masquer l'élément
        }
    });
}

// Exécuter après que le DOM est entièrement chargé et que les rôles sont stockés
document.addEventListener('DOMContentLoaded', function() {
    // Appliquer immédiatement les rôles de la sidebar
    applySidebarRoles();
});

// Optionnel : Vérifier régulièrement si les rôles sont mis à jour
// Si tu veux appliquer les rôles au cas où ils seraient mis à jour plus tard, tu peux définir un intervalle
setInterval(applySidebarRoles, 1000); // Appliquer les rôles toutes les secondes
