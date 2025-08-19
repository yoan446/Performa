let editingId = null;

// ==========================
// Ouvrir modal action
// ==========================
function openActionModal(action = null) {
    const modalEl = document.getElementById('actionModal');
    const modal = new bootstrap.Modal(modalEl);

    const title = document.getElementById('modalTitle');
    const titleInput = document.getElementById('actionTitle');
    const moduleInput = document.getElementById('actionModule');
    const methodInput = document.getElementById('actionMethod');
    const endpointInput = document.getElementById('actionEndpoint');
    const descInput = document.getElementById('actionDescription');
    const hiddenId = document.getElementById('actionId');

    if (action) {
        title.textContent = 'Edit Action';
        titleInput.value = action.titre;
        moduleInput.value = action.nom_module || '';
        methodInput.value = action.method || '';
        endpointInput.value = action.url_endpoints || '';
        descInput.value = action.description || '';
        hiddenId.value = action.id;
        document.getElementById('create-btn').style.display = 'none';
        document.getElementById('update-btn').style.display = 'inline-block';
    } else {
        title.textContent = 'New Action';
        titleInput.value = '';
        moduleInput.value = '';
        methodInput.value = '';
        endpointInput.value = '';
        descInput.value = '';
        hiddenId.value = '';
        document.getElementById('create-btn').style.display = 'inline-block';
        document.getElementById('update-btn').style.display = 'none';
        console.log(typeof bootstrap);

    }

    modal.show(); // ouverture propre avec Bootstrap
}


// ==========================
// Fermer modal action
// ==========================
function closeActionModal() {
    document.getElementById('actionModal').style.display = 'none';
    document.getElementById('actionForm').reset();
    editingId = null;
}

// ==========================
// Charger toutes les actions
// ==========================
async function loadActions() {
    const token = localStorage.getItem('access_token');
    if (!token) return;

    try {
        const res = await fetch('/api/actions', {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!res.ok) throw new Error('Erreur lors du chargement des actions');

        let data = await res.json();
        if (data.data && Array.isArray(data.data)) data = data.data;
        if (!Array.isArray(data)) data = [data];

        const tbody = document.getElementById('actionTableBody');
        tbody.innerHTML = '';

        data.forEach(action => {
            const tr = document.createElement('tr');
            tr.setAttribute('data-id', action.id);
            tr.innerHTML = `
                <td>${action.description}</td>
                <td>${action.nom_module || '-'}</td>
                <td>${action.method || '-'}</td>
                <td>${action.url_endpoints || '-'}</td>
                <td>
                    <button class="btn-edit" onclick="editAction(${action.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-delete" onclick="deleteAction(${action.id})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    } catch (err) {
        console.error(err);
    }
}

// ==========================
// Créer une action
// ==========================
async function saveAction(e) {
    e.preventDefault();
    const token = localStorage.getItem('access_token');
    if (!token) return;

    const data = {
        description: document.getElementById('actionTitle').value,
        nom_module: document.getElementById('actionModule').value,
        method: document.getElementById('actionMethod').value,
        url_endpoints: document.getElementById('actionEndpoint').value
    };

    try {
        const res = await fetch('/api/actions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!res.ok) throw new Error('Erreur lors de la création');

        closeActionModal();
        loadActions();
    } catch (err) {
        console.error(err);
    }
}

// ==========================
// Modifier une action
// ==========================
function editAction(id) {
    const row = document.querySelector(`#actionTableBody tr[data-id="${id}"]`);
    const action = {
        id,
        titre: row.children[0].textContent,
        nom_module: row.children[1].textContent,
        method: row.children[2].textContent,
        url_endpoints: row.children[3].textContent,
    };
    openActionModal(action);
}

// ==========================
// Supprimer une action
// ==========================
async function deleteAction(id) {
    if (!confirm('Voulez-vous supprimer cette action ?')) return;

    const token = localStorage.getItem('access_token');
    if (!token) return;

    try {
        const res = await fetch(`/api/actions/${id}`, {
            method: 'DELETE',
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!res.ok) throw new Error('Erreur suppression');

        const row = document.querySelector(`#actionTableBody tr[data-id="${id}"]`);
        if (row) row.remove();
    } catch (err) {
        console.error(err);
    }
}

// ==========================
// Mettre à jour une action
// ==========================
async function updateAction(e) {
    e.preventDefault();
    if (!editingId) return;
    const token = localStorage.getItem('access_token');
    if (!token) return;

    const data = {
        description: document.getElementById('actionTitle').value,
        nom_module: document.getElementById('actionModule').value,
        method: document.getElementById('actionMethod').value,
        url_endpoints: document.getElementById('actionEndpoint').value
    };

    try {
        const res = await fetch(`/api/actions/${editingId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        if (!res.ok) throw new Error('Erreur mise à jour');

        closeActionModal();
        loadActions();
    } catch (err) {
        console.error(err);
    }
}

// ==========================
// Notifications simples
// ==========================
function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    notification.textContent = (isError ? '❌ ' : '✅ ') + message;
    notification.style.backgroundColor = isError ? '#f8d7da' : '#d1e7dd';
    notification.style.color = isError ? '#842029' : '#0f5132';
    notification.style.border = `1px solid ${isError ? '#f5c2c7' : '#badbcc'}`;
    notification.style.display = 'block';
    setTimeout(() => { notification.style.display = 'none'; }, 5000);
}

// ==========================
// Initialisation
// ==========================
document.addEventListener('DOMContentLoaded', loadActions);

// ==========================
// Fermer modal clic hors modal ou ESC
// ==========================
window.onclick = function(e) {
    const modal = document.getElementById('actionModal');
    if (e.target === modal) closeActionModal();
};
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeActionModal();
});
