
//fonction pour créer un objectif
function saveObjectif(event) {
        event.preventDefault();

        // Récupération des données du formulaire
        const data = {
            titre: document.getElementById('titre').value,
            description: document.getElementById('description').value,
            metric: document.getElementById('metric').value,
            valeur: parseInt(document.getElementById('valeur').value),
            poids: parseInt(document.getElementById('poids').value),
            date_debut: document.getElementById('date_debut').value,
            date_fin: document.getElementById('date_fin').value,
            statut_objectif: 'En Attente de Validation',
            agent_id: parseInt(document.getElementById('agent_id').value),
            manager_id: parseInt(document.getElementById('manager_id').value)
        };

        // Appel AJAX avec fetch
        fetch('/api/objectifs', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            const data = await response.json();

            if (response.ok &&  data.data?.id) {
                showNotification('Objectif créé avec succès');
                document.querySelector('.form-perfoma').reset();
            } else {
                console.error('Réponse invalide ou incomplète', data);
                showNotification(data.message || 'Échec de la création de l\'objectif', true);
            }
        })
        .catch(error => {
            console.error('Erreur réseau ou serveur :', error);
            showNotification('Une erreur est survenue. Veuillez réessayer.', true);
        });
    }

//afficher des messages
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


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-modifier').forEach(button => {
        button.addEventListener('click', function () {
            // Redirige vers une page fixe
            window.location.href = '/user-create-objective';
        });
    });
});


//mettre à jour un objectif
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-modifier').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');

            const data = {
                id: cells[0].textContent.trim(), 
                titre: cells[1].textContent.trim(),
                description: cells[2].textContent.trim(),
                periode: cells[3].textContent.trim(),
                poids: cells[4].textContent.trim(),
                valeur: cells[5].textContent.trim(),
                metric: cells[6].textContent.trim(),
                statut_objectif: cells[7].textContent.trim()
            };

            // Stocker les données dans localStorage
            localStorage.setItem('objectifEnCours', JSON.stringify(data));
        });
    });
});

function activerModeEdition(objectif) {
    // Mettre à jour le titre du formulaire
    const formTitle = document.getElementById('formTitle');
    if (formTitle) {
        formTitle.textContent = "Edit Objective";
    }

    // Cacher le bouton "Create" et afficher "Update"
    const btnCreate = document.getElementById('create');
    const btnUpdate = document.getElementById('update');

    if (btnCreate) btnCreate.style.display = "none";
    if (btnUpdate) btnUpdate.style.display = "block";

    // Remplir les champs du formulaire avec les données fournies
    document.getElementById('objectifid').value = objectif.id || '';
    document.getElementById('titre').value = objectif.titre || '';
    document.getElementById('description').value = objectif.description || '';
    document.getElementById('metric').value = objectif.metric || '';
    document.getElementById('valeur').value = objectif.valeur || '';
    document.getElementById('poids').value = objectif.poids || '';
    document.getElementById('date_debut').value = objectif.date_debut || '';
    document.getElementById('date_fin').value = objectif.date_fin || '';
}

document.addEventListener('DOMContentLoaded', () => {
    const btnUpdate = document.getElementById('update');
    if (btnUpdate) {
        btnUpdate.addEventListener('click', function (e) {
            e.preventDefault(); // évite le rechargement de la page
            updateObjectif();
        });
    }
});
function updateObjectif() {
    const id = document.getElementById('objectifid').value;

    const data = {
        titre: document.getElementById('titre').value,
        description: document.getElementById('description').value,
        metric: document.getElementById('metric').value,
        valeur: parseInt(document.getElementById('valeur').value),
        poids: parseInt(document.getElementById('poids').value),
        date_debut: document.getElementById('date_debut').value,
        date_fin: document.getElementById('date_fin').value,
        statut_objectif: 'En Attente de Validation',
        agent_id: parseInt(document.getElementById('agent_id').value),
        manager_id: parseInt(document.getElementById('manager_id').value),
    };

    fetch(`/api/objectifs/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(response => {
        if (response?.id) {
            showNotification('Objectif mis à jour avec succès');
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1);
            document.getElementById('objectifForm').reset();
            
        } else {
            showNotification('Échec de la mise à jour', true);
        }
    })
    .catch(error => {
        console.error(error);
        showNotification('Une erreur est survenue.', true);
    });
}



//supprimer un objectif
document.addEventListener('DOMContentLoaded', () => {
    // Cible tous les boutons de suppression
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const objectifId = this.getAttribute('data-id');
            if (confirm("Êtes-vous sûr de vouloir supprimer cet objectif ?")) {
                destroyObjectif(objectifId);
            }
        });
    });
});

// Fonction pour supprimer l'objectif via fetch
function destroyObjectif(id) {
    fetch(`/api/objectifs/${id}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            showNotification('Objectif supprimé avec succès');
            //rafraîchir la page ou retirer la ligne du tableau
            setTimeout(() => window.location.reload(), 1);
        } else {
            return response.json().then(data => {
                throw new Error(data.message || 'Erreur de suppression');
            });
        }
    })
    .catch(error => {
        console.error(error);
        showNotification('Échec de la suppression', true);
    });
}


//pour faire apparaitre la div pour le commentaire
document.querySelector('.btn-reject').addEventListener('click', function () {

    const tbody = document.getElementById('objectifs-body');
    if (tbody.rows.length > 0) {
       const div = document.getElementById('section-commentaire');
        if (div) {
            div.style.display = div.style.display === 'none' ? 'block' : 'none';
        }
    } else {
        // Le tbody est vide
        alert('Bien vouloir choisir un collaborateur 😊');
    }
    
});

//afficher les stats des objectifs
function fetchObjectifStats(userId) {
    const statsURL = `/api/objectif/statistique/${userId}`;

    fetch(statsURL)
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de la récupération des statistiques");
            return response.json();
        })
        .then(stats => {
            const data = stats.data;

            // Vérifie que le conteneur existe
            const panel = document.querySelector('.card-panel-obj');
            if (!panel) throw new Error("Conteneur .card-panel-obj introuvable");

            document.getElementById('complete').textContent = data.Completed ?? 0;
            document.getElementById('Pending').textContent = data.Pending ?? 0;
            document.getElementById('Rejected').textContent = data.Rejected ?? 0;
            document.getElementById('Validated').textContent = data.Validated ?? 0;
        })
        .catch(error => {
            console.error("Erreur lors du chargement des statistiques :", error);
            alert("❌ Une erreur est survenue lors du chargement des statistiques.");
        });
}


//afficher les objectifs au clic sur un agent
function getObjectifs(element) {
    const userId = element.getAttribute('data-user-id');
    fetchObjectifStats(userId);
    document.getElementById('current-agent-id').value = userId;
    document.getElementById('agent-id').value = userId;

    fetch(`/api/users/${userId}/objectifs`)
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de la récupération des objectifs");
            return response.json();
        })
        .then(objectifs => {
            const tbody = document.getElementById('objectifs-body');
            tbody.innerHTML = ''; // Effacer le contenu précédent

            if (objectifs.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">Aucun objectif trouvé.</td></tr>'; 
                return;
            }

            objectifs.forEach(obj => {
                const tr = document.createElement('tr');
                tr.setAttribute('data-bs-toggle', 'offcanvas');
                tr.setAttribute('data-bs-target', '#offcanvasRight');

                // Génère le bon badge selon le statut
                let statutClass = '';
                let statutLabel = '';

                switch (obj.statut_objectif) {
                    case 'Valider':
                        statutClass = 'status-success';
                        statutLabel = 'Success';
                        break;
                    case 'Rejeter':
                        statutClass = 'status-decline';
                        statutLabel = 'Declined';
                        break;
                    case 'En Attente de Validation':
                        statutClass = 'status-processing';
                        statutLabel = 'Processing';
                        break;
                    default:
                        statutClass = 'status-processing';
                        statutLabel = 'Unknown';
                        break;
                }

                tr.innerHTML = `
                    <td class="d-flex align-items-start flex-column">
                        <span style="color: #000000">${obj.titre}</span>
                    </td>
                    <td>${obj.description}</td>
                    <td>${formatDate(obj.date_debut)} - ${formatDate(obj.date_fin)}</td>
                    <td>${obj.poids}</td>
                    <td>${obj.valeur}</td>
                    <td>${obj.metric}</td>
                    <td>
                        <div class="${statutClass} ms-auto me-auto">
                            <div class="${statutClass.split('-')[1]}"></div>
                            ${statutLabel}
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
    .catch(error => {
        console.error(error);
        alert("❌ Impossible de charger les objectifs.");
    });
}




// Fonction pour formater la date
function formatDate(dateStr) {
    const date = new Date(dateStr);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return date.toLocaleDateString('en-GB', options); // Exemple: Jan 20, 2025
}




//fonction pour valider un objectif
function ValiderObjectif(agentId) {
    fetch(`/api/agents/${agentId}/objectifs/valider-tous`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        showNotification(data.message || 'Objectifs validés avec succès.');
        setTimeout(() => {
            location.reload(); // Rafraîchit la vue après la notification
        }, 1000);
    })
    .catch(error => {
        showNotification(error.message || 'Une erreur est survenue lors de la validation.', true);
        console.error(error);
    });
}



function ValiderObjectifFromElement(element) {
    const agentId =  document.getElementById('current-agent-id').value;
    if (!agentId) {
        alert("Identifiant utilisateur non trouvé.");
        return;
    }

    ValiderObjectif(agentId); // appel ta fonction existante
}

document.getElementById('form-rejet').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi classique du formulaire

    const commentaire = document.getElementById('justify').value;
    const agentId = document.getElementById('agent-id').value;
    const userid = document.getElementById('manager-id').value;

    if (!commentaire.trim()) {
        showNotification('Veuillez entrer un commentaire.', true);
        return;
    }

    fetch(`/api/objectifs/${agentId}/rejeter/${userid}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ commentaire })
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            // Cas d’erreur (validation, règle métier, etc.)
            showNotification(data.message || 'Une erreur est survenue.', true);
        } else {
            // Cas de succès
            showNotification(data.message || 'Objectifs rejetés avec succès.');
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(error => {
        console.error('Erreur lors du rejet des objectifs :', error);
        showNotification('Une erreur réseau est survenue.', true);
    });
});



document.querySelectorAll('.objectif-row').forEach(row => {
    row.addEventListener('click', function (event) {
        // Évite que les clics sur les boutons dans la ligne déclenchent l'ouverture
        if (event.target.closest('button')) return;

        // Récupérer toutes les <td> de la ligne
        const tds = this.querySelectorAll('td');

        // Assigner le texte des td aux éléments de détail
        document.getElementById('detail-titre').textContent = tds[1].textContent.trim();
        document.getElementById('detail-description').textContent = tds[2].textContent.trim();
        document.getElementById('detail-periode').textContent = tds[3].textContent.trim();
        document.getElementById('detail-poids').textContent = tds[4].textContent.trim();
        document.getElementById('detail-valeur').textContent = tds[5].textContent.trim();
        document.getElementById('detail-metric').textContent = tds[6].textContent.trim();

        // Pour le statut, récupérer le texte à l’intérieur du badge (span)
        const statutSpan = tds[7].querySelector('span');
        document.getElementById('detail-statut').textContent = statutSpan ? statutSpan.textContent.trim() : '';

    });
});



