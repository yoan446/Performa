document.addEventListener("DOMContentLoaded", function () {
    // Gestionnaire de soumission du formulaire
    const appreciationForm = document.getElementById("appreciationForm");
    const saveBtn = document.getElementById("saveAppreciationBtn");
    const deleteConfirmBtn = document.getElementById("confirmDeleteBtn");

    appreciationForm.addEventListener("submit", function (e) {
        e.preventDefault();
        saveAppreciation();
    });

    deleteConfirmBtn.addEventListener("click", function () {
        const id = document.getElementById("deleteAppreciationId").value;
        deleteAppreciationConfirmed(id);
    });
});

// Ouvre le modal vide pour une nouvelle appréciation
function openAppreciationModal() {
    document.getElementById("appreciationForm").reset();
    document.getElementById("appreciationId").value = "";
    document.getElementById("appreciationModalLabel").innerText = "New Appreciation";
    new bootstrap.Modal(document.getElementById("appreciationModal")).show();
}

// Remplit le formulaire et ouvre le modal pour édition
function editAppreciation(id) {
    fetch(`/api/appreciations/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("appreciationId").value = data.id;
            document.getElementById("code").value = data.code;
            document.getElementById("description").value = data.description;
            document.getElementById("valeur_min").value = data.valeur_min;
            document.getElementById("valeur_max").value = data.valeur_max;
            document.getElementById("cycle_id").value = data.cycle_id;
            document.getElementById("appreciationModalLabel").innerText = "Edit Appreciation";
            new bootstrap.Modal(document.getElementById("appreciationModal")).show();
        })
        .catch(err => console.error("Erreur récupération appréciation:", err));
}

// Sauvegarde ou met à jour une appréciation
function saveAppreciation() {
    const id = document.getElementById("appreciationId").value;
    const url = id ? `/api/appreciations/${id}` : '/api/appreciations';
    const method = id ? 'PUT' : 'POST';

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const appreciationData = {
        code: document.getElementById("code").value,
        description: document.getElementById("description").value,
        valeur_min: document.getElementById("valeur_min").value,
        valeur_max: document.getElementById("valeur_max").value,
        cycle_id: document.getElementById("cycle_id").value,
    };

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(appreciationData)
    })
    .then(response => {
        if (!response.ok) throw new Error("Erreur réseau");
        return response.json();
    })
    .then(data => {
        showNotification("Appreciation saved successfully.");
        document.querySelector("#appreciationModal .btn-close").click();
        reloadAppreciations();
    })
    .catch(error => {
        console.error("Erreur sauvegarde:", error);
        alert("Erreur lors de l'enregistrement de l'appréciation.");
    });
}

// Supprime une appréciation avec confirmation
function deleteAppreciation(id) {
    document.getElementById("deleteAppreciationId").value = id;
    new bootstrap.Modal(document.getElementById("confirmDeleteModal")).show();
}

// Confirme et exécute la suppression
function deleteAppreciationConfirmed(id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/api/appreciations/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
        }
    })
    .then(res => {
        if (res.status === 204) {
            showNotification("Appreciation deleted.");
            document.querySelector("#confirmDeleteModal .btn-close").click();
            reloadAppreciations();
        } else {
            throw new Error("Erreur suppression");
        }
    })
    .catch(error => {
        console.error("Erreur suppression:", error);
        alert("Erreur lors de la suppression.");
    });
}

// Recharge le tableau d’appréciations sans recharger la page
function reloadAppreciations() {
    fetch("/api/appreciations")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("appreciationTableBody");
            tbody.innerHTML = "";

            data.forEach(appreciation => {
                const row = `
                    <tr data-id="${appreciation.id}">
                        <td>${appreciation.code}</td>
                        <td>${appreciation.description}</td>
                        <td>${appreciation.valeur_min}</td>
                        <td>${appreciation.valeur_max}</td>
                        <td>${appreciation.cycle_evaluation?.nom_cycle ?? 'Non défini'}</td>
                        <td>
                            <button class="btn-edit" onclick="editAppreciation(${appreciation.id})">
                                <img src="/images/editing.png" class="edit-class" alt="edit" />
                            </button>
                            <button class="btn-delete" onclick="deleteAppreciation(${appreciation.id})">
                                <img src="/images/delete.png" class="delete-class" alt="delete" />
                            </button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(error => console.error("Erreur de chargement du tableau:", error));
}

// Affiche une notification simple
function showNotification(message) {
    const notif = document.getElementById("notification");
    notif.innerText = message;
    notif.style.display = "block";
    notif.style.backgroundColor = "#28a745";
    notif.style.color = "white";
    notif.style.padding = "10px 20px";
    notif.style.borderRadius = "5px";

    setTimeout(() => {
        notif.style.display = "none";
    }, 3000);
}
