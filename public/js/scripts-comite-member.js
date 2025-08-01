let editingCommitteeId = null;

// Ouvrir le modal pour ajouter/modifier une liaison
function openMemberModal(comiteId = null, userIds = []) {
    const modal = document.getElementById('linkCommitteeModal');
    const title = document.getElementById('linkModalTitle');
    const committeeSelect = document.getElementById('linkCommitteeSelect');
    const userSelect = $('#evaluatedAgentsSelect'); // jQuery pour Select2

    // Réinitialiser
    document.getElementById('linkCommitteeForm').reset();
    userSelect.val(null).trigger('change');
    document.getElementById('create-link-btn').style.display = comiteId ? 'none' : 'inline-block';
    document.getElementById('update-link-btn').style.display = comiteId ? 'inline-block' : 'none';

    if (comiteId) {
        editingCommitteeId = comiteId;
        committeeSelect.value = comiteId;
        userSelect.val(userIds).trigger('change');
        title.textContent = 'Update Linked Members';
    } else {
        editingCommitteeId = null;
        title.textContent = 'Link Members to Committee';
    }

    modal.classList.add('active');
}

// Fermer le modal
function closeMemberModal() {
    document.getElementById('linkCommitteeModal').classList.remove('active');
    editingCommitteeId = null;
}

// Enregistrer une liaison (nouvelle)
function saveCommitteeMembers(event) {
    event.preventDefault();

    const comiteId = document.getElementById('linkCommitteeSelect').value;
    const userIds = $('#evaluatedAgentsSelect').val();   

    fetch(`/api/comites/${comiteId}/evaluated-agents`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_ids: userIds })
    })
    .then(res => res.json())
    .then(data => {
        showNotification(data.message || "Liaison enregistrée.");
        location.reload();
    })
    .catch(err => {
        console.error(err);
        console.log(userIds);
        showNotification("Erreur lors de l’enregistrement.", true);
    });
}

// Mettre à jour une liaison
function updateCommitteeMembers(event) {
    event.preventDefault();

    const userIds = $('#evaluatedAgentsSelect').val();

    fetch(`/api/comites/${editingCommitteeId}/evaluated-agents`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_ids: userIds })
    })
    .then(res => res.json())
    .then(data => {
        showNotification(data.message || "Mise à jour effectuée.");
        location.reload();
    })
    .catch(err => {
        console.error(err);
        showNotification("Erreur lors de la mise à jour.", true);
    });
}

// Ouvrir le modal de modification
function editMemberLink(comiteId) {
    fetch(`/api/comites/${comiteId}/evaluated-agents`)
    .then(res => res.json())
    .then(users => {
        const userIds = users.map(user => user.id);
        openMemberModal(comiteId, userIds);
    })
    .catch(err => {
        console.error(err);
        showNotification("Impossible de charger les membres.", true);
    });
}

// Supprimer tous les agents d’un comité
function deleteMemberLink(comiteId) {
    if (confirm("Supprimer tous les agents liés à ce comité ?")) {
        fetch(`/api/comites/${comiteId}/evaluated-agents`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_ids: [] })
        })
        .then(res => res.json())
        .then(data => {
            showNotification("Agents supprimés du comité.");
            location.reload();
        })
        .catch(err => {
            console.error(err);
            showNotification("Erreur lors de la suppression.", true);
        });
    }
}

// Notification (succès ou erreur)
function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.backgroundColor = isError ? '#f8d7da' : '#d1e7dd';
    notification.style.color = isError ? '#842029' : '#0f5132';
    notification.style.border = `1px solid ${isError ? '#f5c2c7' : '#badbcc'}`;
    notification.style.display = 'block';

    setTimeout(() => {
        notification.style.display = 'none';
    }, 4000);
}

// Fermer modal ESC ou clic extérieur
document.getElementById('linkCommitteeModal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeMemberModal();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeMemberModal();
});
