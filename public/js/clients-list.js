const addClientBtn = document.querySelector('.add-client-button');
console.log(addClientBtn);
const addDrawer = document.querySelector('.right-side-drawer');
const overlay = document.querySelector('.overlay');
const cancelBtn = document.querySelector('.cancel-btn');

addClientBtn.addEventListener("click", showAddClient);
cancelBtn.addEventListener("click", closeAddClient);
overlay.addEventListener("click", closeAddClient);

function showAddClient() {
    addDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeAddClient() {
    addDrawer.classList.remove("active");
    overlay.classList.remove("active");
}