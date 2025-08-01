let editingId = null;

// Créer un comité
function saveCommittee(event) {
    event.preventDefault();

    const name = document.getElementById('committeeName').value;
    const cycleId = document.getElementById('committeeCycle').value;

    const data = {
        nom_comite: name,
        cycle_id: cycleId
    };

    fetch('/api/comites', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(async response => {
        const resData = await response.json();
        if (response.ok && resData.comite?.id) {
            showNotification('Comité créé avec succès !');

            const tableBody = document.getElementById('committeeTableBody');
            const row = document.createElement('tr');
            row.setAttribute('data-id', resData.comite.id);
            row.innerHTML = `
                <td>${name}</td>
                <td>${cycleId}</td>
                <td>
                    <button class="btn-edit" onclick="editCommittee(${resData.comite.id})">
                        <img src="/images/editing.png" class="edit-class" />
                    </button>
                    <button class="btn-delete" onclick="deleteCommittee(${resData.comite.id})">
                        <img src="/images/delete.png" class="delete-class" />
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
            document.getElementById('committeeForm').reset();
            closeModal();
        } else {
            showNotification(resData.message || 'Échec de la création du comité.', true);
        }

    })
    .catch(error => {
        console.error('Erreur :', error);
        showNotification('Une erreur est survenue. Veuillez réessayer.', true);
    });
}

// Ouvrir modal comité
function openModal(committee = null) {
    const modal = document.getElementById('committeeModal');
    const title = document.getElementById('modalTitle');
    const nameInput = document.getElementById('committeeName');
    const cycleInput = document.getElementById('committeeCycle');
    const hiddenId = document.getElementById('committeeId');

    if (committee) {
        title.textContent = 'Edit Committee';
        nameInput.value = committee.nom_comite;
        cycleInput.value = committee.cycle_id;
        hiddenId.value = committee.id;
        document.getElementById('create-btn').style.display = 'none';
        document.getElementById('update-btn').style.display = 'inline-block';
        editingId = committee.id;
    } else {
        title.textContent = 'New Committee';
        nameInput.value = '';
        cycleInput.value = '';
        hiddenId.value = '';
        editingId = null;
        document.getElementById('create-btn').style.display = 'inline-block';
        document.getElementById('update-btn').style.display = 'none';
    }

    modal.classList.add('active');
}

// Fermer modal
function closeModal() {
    document.getElementById('committeeModal').classList.remove('active');
    document.getElementById('committeeForm').reset();
    editingId = null;
}

// Modifier un comité
function editCommittee(id) {
    const row = document.querySelector(`#committeeTableBody tr[data-id="${id}"]`);
    const name = row.children[0].textContent;
    const cycleId = row.children[1].textContent;
    openModal({ id, nom_comite: name, cycle_id: cycleId });
}

// Supprimer un comité
function deleteCommittee(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce comité ?')) {
        fetch(`/api/comites/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then(async response => {
            const data = await response.json();
            if (response.ok) {
                const row = document.querySelector(`#committeeTableBody tr[data-id="${id}"]`);
                if (row) row.remove();
                showNotification('Comité supprimé avec succès !');
            } else {
                showNotification(data.message || 'Échec de la suppression.', true);
            }
        })
        .catch(error => {
            console.error('Erreur suppression :', error);
            showNotification('Erreur réseau. Réessayez.', true);
        });
    }
}

// Mise à jour comité
function updateCommittee(event) {
    event.preventDefault();

    const id = document.getElementById('committeeId').value;
    const name = document.getElementById('committeeName').value;
    const cycleId = document.getElementById('committeeCycle').value;

    const data = {
        nom_comite: name,
        cycle_id: cycleId
    };

    fetch(`/api/comites/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(async response => {
        const resData = await response.json();
        if (response.ok) {
            showNotification('Comité mis à jour avec succès !');
            const row = document.querySelector(`#committeeTableBody tr[data-id="${id}"]`);
            if (row) {
                row.children[0].textContent = name;
                row.children[1].textContent = cycleId;
            }
            closeModal();
        } else {
            showNotification(resData.message || 'Échec de la mise à jour.', true);
        }
    })
    .catch(error => {
        console.error(error);
        showNotification('Erreur serveur.', true);
    });
}

// Affichage de notifications
function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    if (!notification) return;

    notification.textContent = (isError ? '❌ ' : '✅ ') + message;
    notification.style.backgroundColor = isError ? '#f8d7da' : '#d1e7dd';
    notification.style.color = isError ? '#842029' : '#0f5132';
    notification.style.border = `1px solid ${isError ? '#f5c2c7' : '#badbcc'}`;
    notification.style.display = 'block';

    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000);
}

// Fermer avec ESC ou clic hors modal
document.getElementById('committeeModal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeModal();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});
