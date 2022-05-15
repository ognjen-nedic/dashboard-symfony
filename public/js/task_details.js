const editTaskBtn = document.querySelector('#edit-task-btn');
const editDrawer = document.querySelector('.right-side-drawer');
const overlay = document.querySelector('.overlay');

editTaskBtn.addEventListener("click", showEditTask);
overlay.addEventListener("click", closeEditTask);

function showEditTask() {
    editDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeEditTask() {
    editDrawer.classList.remove("active");
    overlay.classList.remove("active");
}