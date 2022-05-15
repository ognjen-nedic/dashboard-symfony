const editClientBtn = document.querySelector('.edit-client-button');
const editDrawer = document.querySelector('.right-side-drawer');
const overlay = document.querySelector('.overlay');
const cancelBtn = document.querySelector('.cancel-btn');

editClientBtn.addEventListener("click", showEditClient);
cancelBtn.addEventListener("click", closeEditClient);
overlay.addEventListener("click", closeEditClient);

function showEditClient() {
    editDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeEditClient() {
    editDrawer.classList.remove("active");
    overlay.classList.remove("active");
}