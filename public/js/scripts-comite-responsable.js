let editingLinkId = null;

// 🔵 Ouvrir le modal (créer ou modifier un lien)
function openLinkModal(link = null) {
    const modal = document.getElementById('linkCommitteeModal');
    const title = document.getElementById('linkModalTitle');
    const comiteSelect = $('#linkCommitteeSelect');
    const userSelect = $('#responsableSelect');
    const hiddenId = document.getElementById('linkId');

    if (link) {
        title.textContent = 'Edit Committee Link';
        comiteSelect.val(link.comite_id).trigger('change');
        userSelect.val(link.user_ids).trigger('change');
        hiddenId.value = link.id;

        document.getElementById('create-link-btn').style.display = 'none';
        document.getElementById('update-link-btn').style.display = 'inline-block';
        editingLinkId = link.id;
    } else {
        title.textContent = 'Link Committee to Responsibles';
        comiteSelect.val(null).trigger('change');
        userSelect.val(null).trigger('change');
        hiddenId.value = '';

        document.getElementById('create-link-btn').style.display = 'inline-block';
        document.getElementById('update-link-btn').style.display = 'none';
        editingLinkId = null;
    }

    modal.classList.add('active');
}

// 🔴 Fermer le modal

// Fermer modal comite-responsable
function closeLinkModal() {
    document.getElementById('linkCommitteeModal').classList.remove('active');
    document.getElementById('linkCommitteeForm').reset();
    $('#responsableSelect').val(null).trigger('change');
    editingLinkId = null;
}


// ✅ Afficher notification
function showLinkNotification(message, isError = false) {
    const notification = document.getElementById('link-notification');
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

// 🔐 Fermer le modal avec clic extérieur ou Escape
document.getElementById('linkCommitteeModal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeLinkModal();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLinkModal();
});


//fonction pour save un relation comité responsable ou jury
function saveCommitteeLink(event) {
  event.preventDefault();

  const comiteId = $('#linkCommitteeSelect').val();
  const userIds = $('#responsableSelect').val();

  if (!comiteId || userIds.length === 0) {
    alert("Veuillez sélectionner un comité et au moins un responsable.");
    return;
  }

  const url = `/api/comites/${comiteId}/users`;

  const data = {
    user_ids: userIds,
    _token: $('meta[name="csrf-token"]').attr('content')
  };

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    success: function(response) {
      showNotification("Liaison créée avec succès !");
      closeLinkModal();
      // Optionnel : mettre à jour dynamiquement le tableau
    },
    error: function(xhr) {
      console.error(xhr.responseText);
      alert("Une erreur est survenue lors de la création.");
    }
  });
}


//Fonction pour afficher une notif
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


// Ouvre le modal pour modifier les responsables d’un comité
function editLink(comiteId) {
    fetch(`/api/comites/${comiteId}/users`)
        .then(response => response.json())
        .then(users => {
            // Pré-remplir les champs du modal
            document.getElementById('linkModalTitle').textContent = 'Modifier les responsables';
            document.getElementById('linkCommitteeSelect').value = comiteId;
            $('#responsableSelect').val(users.map(user => user.id)).trigger('change');

            document.getElementById('linkId').value = comiteId;
            document.getElementById('create-link-btn').style.display = 'none';
            document.getElementById('update-link-btn').style.display = 'inline-block';
            editingLinkId = comiteId;
            document.getElementById('linkCommitteeModal').classList.add('active');
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des utilisateurs liés :', error);
            showNotification('Erreur lors du chargement des responsables.', true);
        });
}


// Mise à jour d'une association comité-responsables
function updateCommitteeLink(event) {
    event.preventDefault();

    const comiteId = document.getElementById('linkCommitteeSelect').value;
    const userIds = $('#responsableSelect').val();

    fetch(`/api/comites/${comiteId}/users`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ user_ids: userIds })
    })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                showNotification('Liaison mise à jour avec succès.');
                location.reload();
            } else {
                showNotification('Échec de la mise à jour.', true);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la mise à jour :', error);
            showNotification('Erreur lors de la mise à jour.', true);
        });
}

// Supprimer une liaison comité-responsables
function deleteLink(comiteId) {
    if (confirm('Voulez-vous vraiment retirer tous les responsables de ce comité ?')) {
        fetch(`/api/comites/${comiteId}/users`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ user_ids: [] })
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    showNotification('Liaison supprimée avec succès.');
                    location.reload();
                } else {
                    showNotification('Échec de la suppression.', true);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la suppression :', error);
                showNotification('Erreur serveur.', true);
            });
    }
}
