let editingRow = null;

// code pour charger les directions dans le select
document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/directions')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('userDepartment');
            select.innerHTML = '<option value="">Sélectionner un département</option>'; // Reset options

            data.forEach(direction => {
                const option = document.createElement('option');
                option.value = direction.id;
                option.textContent = direction.name;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des directions:', error);
        });
});


document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/directions')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('departmentFilter');
            select.innerHTML = '<option value="">Sélectionner un département</option>'; // Reset options

            data.forEach(direction => {
                const option = document.createElement('option');
                option.value = direction.id;
                option.textContent = direction.name;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des directions:', error);
        });
});


// fonction JS pour pouvoir charger les users dans le tableau dynamiquement
function loadUsers() {
    fetch('/api/users')
        .then(response => response.json())
        .then(users => {
            const tableBody = document.getElementById('userTableBody');
            tableBody.innerHTML = ''; // vide le tableau

            users.forEach(user => {
                const row = document.createElement('tr');

                const statutClass = user.statut_user === 'Actif' ? 'badge-success' : 'badge-danger';
                const statutLabel = user.statut_user || 'Inconnu';

                row.innerHTML = `
                    <td data-user-id="${user.id}">${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.secondname}</td>
                    <td>${user.email}</td>
                    <td>${user.user_job_name ?? ''}</td>
                    <td>${user.direction?.name ?? ''}</td>
                    <td><span class="badge ${statutClass}">${statutLabel}</span></td>
                    <td>${new Date(user.created_at).toLocaleDateString('fr-FR')}</td>
                    <td class="button-class">
                        <button onclick="openModal(this.closest('tr'))" title="Modifier">
                            <img src="/images/editing.png" alt="" class="edit-class">
                        </button>
                        <button onclick="deleteUser(this)" title="Supprimer">
                            <img src="/images/delete.png" alt="" class="delete-class">
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement des utilisateurs :", error);
            showNotification("Impossible de charger les utilisateurs", true);
        });
}

// Appelle la fonction quand la page est chargée
document.addEventListener('DOMContentLoaded', loadUsers);

// Fonction  pour sélectionner une option par son texte
function selectByVisibleText(selectElement, visibleText) {
    Array.from(selectElement.options).forEach(option => {
        option.selected = option.textContent.trim().toLowerCase() === visibleText.trim().toLowerCase();
    });
}

// Fonction pour ouvrir le modal (ajout ou modification)
function openModal(row = null) {
    const modal = document.getElementById('userModal');
    const title = document.getElementById('modalTitle');

    if (row) {
        title.textContent = 'Modifier l\'Utilisateur';

        // Champs texte
         document.getElementById('user_id').value = row.cells[0].textContent.trim();
        document.getElementById('userFirstName').value = row.cells[1].textContent.trim();
        document.getElementById('userLastName').value = row.cells[2].textContent.trim();
        document.getElementById('userEmail').value = row.cells[3].textContent.trim();
        document.getElementById('userPoste').value = row.cells[4].textContent.trim();

        // Sélectionner le département
        const departmentText = row.cells[5].textContent.trim();
        const departmentSelect = document.getElementById('userDepartment');
        selectByVisibleText(departmentSelect, departmentText);

        editingRow = row; // pour conserver la référence
    } else {
        title.textContent = 'Nouvel Utilisateur';
        document.getElementById('userForm').reset();
        editingRow = null;
    }

    modal.classList.add('active');
}


// Fonction pour fermer le modal
function closeModal() {
    const modal = document.getElementById('userModal');
    modal.classList.remove('active');
    document.getElementById('userForm').reset();
    editingRow = null;
}


// Fonction pour supprimer un utilisateur
async function deleteUser(button) {
    if (!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        return; // annule si non confirmé
    }

    // Trouve la ligne <tr> contenant ce bouton
    const row = button.closest('tr');
    if (!row) return;

    // Récupère l'id de l'utilisateur dans un <td> — 
    // adapte ici si ton <td> avec l'id a un attribut spécifique, exemple data-user-id
    // Exemple : <td data-user-id="123">123</td>
    const idTd = row.querySelector('td[data-user-id]');
    if (!idTd) {
        alert("Impossible de récupérer l'ID utilisateur.");
        return;
    }
    const userId = idTd.getAttribute('data-user-id');

    if (!userId) {
        alert("ID utilisateur invalide.");
        return;
    }

    // CSRF token (obligatoire si tu utilises sessions Laravel)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    try {
        const response = await fetch(`/api/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        });

        if (response.ok) {
            row.remove(); // supprime la ligne du tableau
            alert("Utilisateur supprimé avec succès.");
        } else {
            const error = await response.json();
            alert(error.message || "Erreur lors de la suppression.");
        }
    } catch (error) {
        console.error('Erreur réseau :', error);
        alert("Erreur réseau, impossible de supprimer.");
    }
}


// Fermer le modal en cliquant à l’extérieur
window.addEventListener('click', function (event) {
    const modal = document.getElementById('userModal');
    if (event.target === modal) {
        closeModal();
    }
});


//fonction pour sauvegarder le user créer
function saveUser(event) {
    event.preventDefault();

    const roles = Array.from(document.querySelectorAll('input[name="roles[]"]:checked')).map(input => input.value);

    /*  Validation locale : au moins un rôle */
    if (roles.length === 0) {
        alert("Veuillez sélectionner au moins un rôle.");
        return;    // Stoppe la fonction si 0 rôle
    }

    const data = {
        name: document.getElementById('userFirstName').value,
        secondname: document.getElementById('userLastName').value,
        email: document.getElementById('userEmail').value,
        user_job_name: document.getElementById('userPoste').value,
        direction_id: document.getElementById('userDepartment').value,
        statut_user: document.getElementById('userStatus').value,
        password: document.getElementById('userPassword').value,
        roles
    };

    fetch('/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Réponse API :', data);
        if (data.message) {
            showNotification(data.message);
            // Optionnel : vider le formulaire
            document.getElementById('userForm').reset();
            loadUsers();
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification("Une erreur est survenue.", true);
    });
    loadUsers();
}


// fonction qui fait apparaitre une notification
function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.backgroundColor = isError ? '#e3342f' : '#38c172'; // rouge ou vert
    notification.style.display = 'block';
    notification.classList.remove('hide');

    setTimeout(() => {
        notification.classList.add('hide');
        setTimeout(() => {
            notification.style.display = 'none';
        }, 500); // attendre l'animation
    }, 3000); // 3 secondes visibles
}


//script js pour mettre à jour les infos d'un user
document.addEventListener('DOMContentLoaded', () => {
    const updateBtn = document.getElementById('btn-update-user');

    updateBtn.addEventListener('click', function () {
        const userId = document.getElementById('user_id').value;

        const data = {
            name: document.getElementById('first-name').value,
            secondname: document.getElementById('second-name').value,
            email: document.getElementById('email').value,
            user_job_name: document.getElementById('job-name').value,

            // Ajoute d'autres champs ici si nécessaire
        };

        fetch(`/api/users/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            if (response.ok) {
                const result = await response.json();
                alert("✅ Utilisateur mis à jour avec succès !");
                console.log(result);
            } else {
                const error = await response.json();
                alert("❌ Erreur : " + (error.message || 'Mise à jour impossible'));
            }
        })
        .catch(error => {
            console.error(error);
            alert("❌ Une erreur est survenue lors de la mise à jour.");
        });
    });
});