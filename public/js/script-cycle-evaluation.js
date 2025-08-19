const API_BASE_URL = "/api/cycles"; // ton endpoint Laravel
const token = localStorage.getItem('access_token');

async function apiRequest(url, method='GET', data=null){
    const options = { method, headers: { "Content-Type":"application/json", "Authorization": `Bearer ${token}` } };
    if(data) options.body = JSON.stringify(data);
    const res = await fetch(url, options);
    if(!res.ok) throw new Error(await res.text());
    return res.json();
}

async function loadCycles(){
    try {
        const response = await apiRequest(API_BASE_URL);
        const cycles = Array.isArray(response) ? response : response.data || [];
        const tbody = document.querySelector("#cycle-list");
        tbody.innerHTML = "";
        cycles.forEach(c => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${c.id_cycle}</td>
                <td>${c.titre}</td>
                <td>${c.description || "-"}</td>
                <td>${c.notation_max || "-"}</td>
                <td>${c.date_debut.split(' ')[0]}</td>
                <td>${c.date_fin.split(' ')[0]}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick="editCycle(${c.id_cycle})">Modifier</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteCycle(${c.id_cycle})">Supprimer</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    } catch(e){
        console.error("Erreur chargement cycles:", e.message);
    }
}

function openCreateModal(){
    document.getElementById("cycleForm").reset();
    document.getElementById("cycleId").value="";
    document.getElementById("cycleModalLabel").textContent="Nouveau Cycle";
    new bootstrap.Modal(document.getElementById("cycleModal")).show();
}

async function saveCycle(event){
    event.preventDefault();
    const id = document.getElementById("cycleId").value;
    const data = {
        titre: document.getElementById("titre").value,
        description: document.getElementById("description").value,
        notation_max: document.getElementById("notemax").value,
        date_debut: document.getElementById("date_debut").value,
        date_fin: document.getElementById("date_fin").value
    };
    try{
        if(id){
            await apiRequest(`${API_BASE_URL}/${id}`, "PUT", data);
        } else {
            await apiRequest(API_BASE_URL, "POST", data);
        }
        bootstrap.Modal.getInstance(document.getElementById("cycleModal")).hide();
        loadCycles();
    } catch(e){
        alert("Erreur sauvegarde : "+e.message);
    }
}

async function editCycle(id){
    try{
        const c = await apiRequest(`${API_BASE_URL}/${id}`);
        document.getElementById("cycleId").value=c.id_cycle;
        document.getElementById("titre").value=c.titre;
        document.getElementById("description").value=c.description;
        document.getElementById("notemax").value=c.notation_max;
        document.getElementById("date_debut").value=c.date_debut.split(' ')[0];
        document.getElementById("date_fin").value=c.date_fin.split(' ')[0];
        document.getElementById("cycleModalLabel").textContent="Modifier Cycle";
        new bootstrap.Modal(document.getElementById("cycleModal")).show();
    }catch(e){ alert("Erreur chargement cycle : "+e.message); }
}

async function deleteCycle(id) {
    if (!confirm("Voulez-vous vraiment supprimer ce cycle ?")) return;

    try {
        await apiRequest(`${API_BASE_URL}/${id}`, "DELETE");
        loadCycles(); // recharge la liste après suppression
    } catch (e) {
        alert("Erreur suppression : " + e.message);
        console.error(e);
    }
}


document.addEventListener("DOMContentLoaded",()=>{
    loadCycles();
    document.getElementById("btn-open-create").addEventListener("click", openCreateModal);
    document.getElementById("cycleForm").addEventListener("submit", saveCycle);
});