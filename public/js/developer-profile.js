const editDeveloperBtn = document.querySelector('.edit-developer-button');
const addNewTaskBtn = document.querySelector('.add-new-task-btn');

const editDeveloperDrawer = document.querySelector("#edit-developer-form");
const newTaskDrawer = document.querySelector("#new-task-form");

const overlay = document.querySelector('.overlay');
const cancelBtn = document.querySelector('.cancel-btn');

editDeveloperBtn.addEventListener("click", showEditDeveloper);
addNewTaskBtn.addEventListener("click", showNewTaskDrawer);
overlay.addEventListener("click", closeEditDeveloper);
overlay.addEventListener("click", closeNewTaskDrawer);


function showEditDeveloper() {
    editDeveloperDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeEditDeveloper() {
    editDeveloperDrawer.classList.remove("active");
    overlay.classList.remove("active");

}

function showNewTaskDrawer() {
    newTaskDrawer.classList.add("active");
    overlay.classList.add("active");
}

function closeNewTaskDrawer() {
    newTaskDrawer.classList.remove("active");
    overlay.classList.remove("active");

}