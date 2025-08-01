//fonction pour soit ajouter soit modifier un cycle
function saveCycle(event) {
    event.preventDefault();

    const action = event.submitter?.id; // "btn-create" ou "btn-update"
    const isUpdate = action === 'btn-update';

    const data = {
        nom_cycle: document.getElementById('cycle-name').value,
        debut_fixation: document.getElementById('debut-objectif').value,
        fin_fixation: document.getElementById('fin-objectif').value,
        debut_auto_eval: document.getElementById('debut-auto').value,
        fin_auto_eval: document.getElementById('fin-auto').value,
        debut_eval_manager: document.getElementById('debut-manager').value,
        fin_eval_manager: document.getElementById('fin-manager').value,
        debut_eval_comite: document.getElementById('debut-comite').value,
        fin_eval_comite: document.getElementById('fin-comite').value
    };

    // Si update, ajouter l'ID
    const cycleId = document.getElementById('cycleId').value;
    if (isUpdate && cycleId) {
        data.id = cycleId;
    }

    // Choix de la méthode et de l’URL
    const url = isUpdate ? `/api/cycles/${cycleId}` : '/api/cycles';
    const method = isUpdate ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(async response => {
        const responseData = await response.json();

        if (response.ok && responseData.data?.id) {
            showNotification(isUpdate ? 'Cycle mis à jour avec succès !' : 'Cycle créé avec succès !');
            document.querySelector('.form-perfoma').reset();
            if (isUpdate) {
                //redirection vers manage period
                window.location.href = '/user-manage-period';

                // Remettre en mode création après update
                document.getElementById('btn-update').style.display = 'none';
                document.getElementById('btn-create').style.display = 'block';
                document.getElementById('cycleId').value = '';
                document.getElementById('titre-cycle').textContent = 'Create Cycle';
            }
        } else {
            console.error('Réponse invalide ou incomplète', responseData);
            showNotification(responseData.message || 'Erreur pendant la soumission du cycle', true);
        }
    })
    .catch(error => {
        console.error('Erreur réseau ou serveur :', error);
        showNotification('Une erreur est survenue. Veuillez réessayer.', true);
    });
}


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



//dans le fichier manage period
//fonction pour récuper les donnée de de la ligne et afficher dans le form
function goToCreatePeriod(button) {
    // 1. Récupère l'ID du cycle depuis l'attribut data-id du bouton
    const cycleId = button.getAttribute('data-id');

    // 2. Récupère la ligne (tr) contenant le bouton
    const row = button.closest('tr');

    // 3. Récupère toutes les cellules (td) de la ligne
    const cells = row.querySelectorAll('td');

    // 4. Récupère le contenu texte de chaque cellule
    const cycleData = {
        id: cycleId,
        nom: cells[0]?.innerText.trim(),
        fixation: cells[1]?.innerText.trim(),
        auto_eval: cells[2]?.innerText.trim(),
        eval_manager: cells[3]?.innerText.trim(),
        eval_comite: cells[4]?.innerText.trim()
    };

    // 5. Stocker les infos localement (tu peux aussi utiliser sessionStorage)
    localStorage.setItem('selectedCycle', JSON.stringify(cycleData));

    // 6. Redirection vers la page suivante
    window.location.href = '/user-create-period-management';
    switchToUpdateMode();
}


//fonction pour supprimer un cycle
function deleteCycle(cycleId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce cycle d\'évaluation ?')) {
        fetch(`/api/cycles/${cycleId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then(async response => {
            const data = await response.json();
            if (response.ok) {
                showNotification('Cycle supprimé avec succès !');
                // Supprimer la ligne du tableau (optionnel)
                const row = document.querySelector(`tr[data-cycle-id="${cycleId}"]`);
                if (row) row.remove();
            } else {
                showNotification(data.message || 'Échec de la suppression', true);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la suppression :', error);
            showNotification('Une erreur est survenue. Veuillez réessayer.', true);
        });
    }
}
