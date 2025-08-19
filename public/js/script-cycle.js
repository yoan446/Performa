// ===============================
// Variables globales
// ===============================
const API_BASE_URL = "/api/periodes-actions"; // Laravel resource
const token = localStorage.getItem('access_token');

if (!token) {
  console.error("Aucun token trouvé. L'utilisateur doit se connecter.");
}

// ===============================
// Utilitaire fetch avec JWT
// ===============================
async function apiRequest(url, method = "GET", data = null) {
  const options = {
    method,
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
  };
  if (data) options.body = JSON.stringify(data);

  const response = await fetch(url, options);
  if (!response.ok) {
    const err = await response.json().catch(() => ({}));
    throw new Error(err.message || "Erreur API");
  }
  return response.json();
}

// ===============================
// Chargement des périodes
// ===============================
async function loadPeriodes() {
  try {
    const response = await apiRequest(API_BASE_URL);
    const periodes = Array.isArray(response) ? response : response.data || [];

    const tbody = document.querySelector("#periodes-list");
    tbody.innerHTML = "";

    periodes.forEach((periode) => {
      const tr = document.createElement("tr");

      tr.innerHTML = `
        <td>${periode.id}</td>
        <td>${periode.action?.description || "-"}</td>
        <td>${periode.cycle?.titre || "-"}</td>
        <td>${periode.date_debut}</td>
        <td>${periode.date_fin}</td>
        <td style="display:flex">
          <button class="btn-edit" onclick="editPeriode(${periode.id})">Modifier</button>
          <button class="btn-delete" onclick="deletePeriode(${periode.id})">Supprimer</button>
        </td>
      `;

      tbody.appendChild(tr);
    });
  } catch (error) {
    console.error("Erreur chargement périodes :", error.message);
  }
}


// ===============================
// Ajout / Edition de période
// ===============================
async function savePeriode(event) {
  event.preventDefault();

  const id = document.querySelector("#periodeId").value;
  const data = {
    id_action: document.querySelector("#action_id").value,
    cycle_id: document.querySelector("#cycle_id").value,
    date_debut: document.querySelector("#date_debut").value,
    date_fin: document.querySelector("#date_fin").value,
  };

  try {
    if (id) {
      // Edition
      await apiRequest(`${API_BASE_URL}/${id}`, "PUT", data);
    } else {
      // Création
      await apiRequest(API_BASE_URL, "POST", data);
    }

    document.querySelector("#periodeForm").reset();
    bootstrap.Modal.getInstance(document.querySelector("#periodeModal")).hide();
    loadPeriodes();
  } catch (error) {
    alert("Erreur sauvegarde : " + error.message);
    console.log(data);
  }
}

// ===============================
// Pré-remplissage formulaire Edition
// ===============================
async function editPeriode(id) {
  try {
    const periode = await apiRequest(`${API_BASE_URL}/${id}`);

    // remplir le formulaire
    document.querySelector("#periodeId").value = periode.id;           // important pour édition
    document.querySelector("#action_id").value = periode.id_action;
    document.querySelector("#cycle_id").value = periode.cycle_id;
    document.querySelector("#date_debut").value = periode.date_debut;
    document.querySelector("#date_fin").value = periode.date_fin;

    // changer le titre du modal
    document.getElementById("periodeModalLabel").textContent = "Modifier la période";

    // ouvrir le modal
    new bootstrap.Modal(document.querySelector("#periodeModal")).show();
  } catch (error) {
    alert("Erreur chargement période : " + error.message);
  }
}


// ===============================
// Suppression période
// ===============================
async function deletePeriode(id) {
  if (!confirm("Voulez-vous vraiment supprimer cette période ?")) return;

  try {
    await apiRequest(`${API_BASE_URL}/${id}`, "DELETE");
    loadPeriodes();
  } catch (error) {
    alert("Erreur suppression : " + error.message);
  }
}

// ===============================
// Initialisation
// ===============================
document.addEventListener("DOMContentLoaded", () => {
  loadPeriodes();
  document.querySelector("#periodeForm").addEventListener("submit", savePeriode);
  const btnCreate = document.getElementById("btn-open-create");
  if (btnCreate) {
    btnCreate.addEventListener("click", openCreateModal);
  }
});


//==============================
//fonction pour ouvrir le modal
//==============================
function openCreateModal() {
  document.getElementById("periodeForm").reset(); // réinitialise le formulaire
  document.getElementById("periodeId").value = "";  // vide l'id pour création
  document.getElementById("periodeModalLabel").textContent = "Nouvelle période";
  new bootstrap.Modal(document.getElementById("periodeModal")).show();
}