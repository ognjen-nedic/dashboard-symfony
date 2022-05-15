const editDeveloperBtn = document.querySelector('.edit-developer-button');
const editDrawer = document.querySelector('.right-side-drawer');
const overlay = document.querySelector('.overlay');
const cancelBtn = document.querySelector('.cancel-btn');

editDeveloperBtn.addEventListener("click", showEditDeveloper);
cancelBtn.addEventListener("click", closeEditDeveloper);
overlay.addEventListener("click", closeEditDeveloper);

function showEditDeveloper() {
    editDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeEditDeveloper() {
    editDrawer.classList.remove("active");
    overlay.classList.remove("active");
}