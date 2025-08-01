// Événement au clic sur une cellule de tableau pour récupérer les données
document.querySelectorAll('.clickable-td').forEach(function (cell) {
  cell.addEventListener('click', function (e) {
    e.preventDefault();

    const tr = e.currentTarget.closest('tr');
    if (!tr) return;

    const dataCells = tr.querySelectorAll('td:not(.clickable-td)');
    if (dataCells.length < 7) return; // S'assurer qu'il y a bien 7 cellules

    // Récupérer l'ID depuis l'attribut data-id de la cellule cachée
    const id = tr.querySelector('td[hidden]').getAttribute('data-id');

    // Récupérer les autres données de la ligne
    const titre       = dataCells[1].innerText.trim().replace(/\n/g, ' | ');  // Correction: titre est dans la 1ère cellule
    const description = dataCells[2].innerText.trim(); // Description dans la 2ème cellule
    const period      = dataCells[3].innerText.trim(); // Période dans la 3ème cellule
    const weight      = dataCells[4].innerText.trim(); // Poids dans la 4ème cellule
    const value       = dataCells[5].innerText.trim(); // Valeur dans la 5ème cellule
    const metric      = dataCells[6].innerText.trim(); // Metric dans la 6ème cellule

    // Stocker ces informations dans un tableau ou objet
    const data = {
      id,
      titre,
      description,
      period,
      weight,
      value,
      metric
    };

    // Stocker les données dans sessionStorage
    sessionStorage.setItem('evaluationData', JSON.stringify(data));

    // Rediriger vers la page de l'évaluation
    window.location.href = '/user-create-self-evaluation';
  });
});

 /**
  * Affiche simplement une alerte (remplace par ton toast/Toastr si besoin)
*/
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


 /**
 * Soumission AJAX de l’évaluation
 */
async function submitEvaluation(event) {
  event.preventDefault();                 // empêche l’envoi « classique »
  const form = event.target;
  const formData = new FormData(form);

  // CSRF Laravel (obligatoire)
  formData.append('_token',document.querySelector('meta[name="csrf-token"]').content
);

try {
    const response = await fetch('/api/evaluations_agent', {
      method: 'POST',
      body: formData
    });

    const data = await response.json();

      if (response.ok) {
        showNotification('Évaluation enregistrée avec succès');
        form.reset();
      } else {
        // API a répondu avec une erreur applicative
        showNotification(data.message || 'Échec de l\'enregistrement', true);
        console.error('Réponse API', data);
      }
      } catch (error) {
        // Erreur réseau ou 500 Laravel non JSON
        showNotification('Erreur serveur ou réseau : ' + error, true);
        console.error('Fetch error', error);
      }
      // Redirige vers une page fixe
      window.location.href = '/dashboard-self-evaluation';
  }



  //fonction pour appeler la fonction pour l'évaluation par le manager
  async function submitEvaluation_manager(event) {
  event.preventDefault();                 // empêche l’envoi « classique »
  const form = event.target;
  const formData = new FormData(form);

  // CSRF Laravel (obligatoire)
  formData.append('_token',document.querySelector('meta[name="csrf-token"]').content
);

try {
    const response = await fetch('/api/evaluations_manager', {
      method: 'POST',
      body: formData
    });

    const data = await response.json();

      if (response.ok) {
        showNotification('Évaluation enregistrée avec succès');
        form.reset();
      } else {
        // API a répondu avec une erreur applicative
        showNotification(data.message || 'Échec de l\'enregistrement', true);
        console.error('Réponse API', data);
      }
      } catch (error) {
        // Erreur réseau ou 500 Laravel non JSON
        showNotification('Erreur serveur ou réseau : ' + error, true);
        console.error('Fetch error', error);
      }
      // Redirige vers une page fixe
      window.location.href = '/collaborator-evaluations';
  }

// Attacher le listener une fois le DOM prêt
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('evaluationForm').addEventListener('submit', submitEvaluation);
});

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('evaluationForm-manager').addEventListener('submit', submitEvaluation_manager);
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
function getObjectifstoEvaluate(element) {
    const userId = element.getAttribute('data-user-id');
    fetchObjectifStats(userId);

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

                const evaluationUrl = `/user-create-collaborator-evaluation`; // Remplacer par l'URL correcte

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
                    <td>
                        <a href="${evaluationUrl}" class="btn-link evaluate-btn" data-id="${obj.id}">Evaluate</a>
                    </td>
                `;
                tbody.appendChild(tr);

                 // Ajouter un événement au bouton Evaluate
                tr.querySelector('.evaluate-btn').addEventListener('click', function (e) {
                    e.preventDefault();  // Empêcher le comportement par défaut du lien

                    // Récupérer les données de l'objectif sélectionné
                    const objectifData = {
                        id: obj.id,
                        titre: obj.titre,
                        description: obj.description,
                        period: `${formatDate(obj.date_debut)} - ${formatDate(obj.date_fin)}`,
                        weight: obj.poids,
                        value: obj.valeur,
                        metric: obj.metric
                    };

                    // Stocker les données dans sessionStorage
                    sessionStorage.setItem('evaluationManager', JSON.stringify(objectifData));

                    // Rediriger vers la page d'évaluation
                    window.location.href = evaluationUrl;
                });
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


// Fonction pour récupérer les paramètres URL sous forme d'objet clé/valeur
function displayEvaluationData() {
  // Récupérer les données du sessionStorage
  const data = JSON.parse(sessionStorage.getItem('evaluationData'));

  if (data) {
    // Afficher les données dans les éléments HTML
    document.getElementById('objectif_id').value = data.id;
    document.getElementById('objective-title').innerText = data.titre;
    document.getElementById('objective-description').innerText = data.description;
    document.getElementById('objective-period').innerText = data.period;
    document.getElementById('objective-weight').innerText = data.weight;
    document.getElementById('objective-value').innerText = data.value;
    document.getElementById('objective-metric').innerText = data.metric;
  } else {
    console.error("Aucune donnée d'évaluation trouvée !");
  }
}


// Fonction pour récupérer les paramètres URL sous forme d'objet clé/valeur
function displayEvaluationDataManager() {
  // Récupérer les données du sessionStorage
  const data = JSON.parse(sessionStorage.getItem('evaluationManager'));

  if (data) {
    // Afficher les données dans les éléments HTML
    document.getElementById('objectif_id').value = data.id;
    document.getElementById('objective-title').innerText = data.titre;
    document.getElementById('objective-description').innerText = data.description;
    document.getElementById('objective-period').innerText = data.period;
    document.getElementById('objective-weight').innerText = data.weight;
    document.getElementById('objective-value').innerText = data.value;
    document.getElementById('objective-metric').innerText = data.metric;
  } else {
    console.error("Aucune donnée d'évaluation trouvée !");
  }
}
// Appel de la fonction pour afficher les données sur la page
displayEvaluationData();
displayEvaluationDataManager();