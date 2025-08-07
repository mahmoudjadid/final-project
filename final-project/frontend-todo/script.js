const taskContainer = document.querySelector(".task-container");
const taskInput = document.getElementById("taskInput");
const taskNumberInput = document.getElementById("taskNumber");

// Store tasks in an array (in to do list)
let tasks = [];

function renderTasks() {
    // Clear container
        taskContainer.innerHTML = "<h2 style='text-align: center;'>To Do List</h2>";

    // Show all tasks with numbers
    tasks.forEach((task, index) => {
        const p = document.createElement("p");
        p.textContent = `${index + 1}. ${task.text}`;
        if (task.done) {
            p.classList.add("done");
        }
        taskContainer.appendChild(p);
    });
}

function addtask() {
    const text = taskInput.value.trim();
    if (text === "") {
        alert("Please enter a task.");
        return;
    }
    tasks.push({ text: text, done: false });
    taskInput.value = "";
    renderTasks();
}

function deletetask() {
    const index = parseInt(taskNumberInput.value) - 1;
    if (isNaN(index) || index < 0 || index >= tasks.length) {
        alert("Invalid task number.");
        return;
    }
    tasks.splice(index, 1);
    taskNumberInput.value = "";
    renderTasks();
}

function edittask() {
    const index = parseInt(taskNumberInput.value) - 1;
    if (isNaN(index) || index < 0 || index >= tasks.length) {
        alert("Invalid task number.");
        return;
    }
    const newText = prompt("Edit your task:", tasks[index].text);
    if (newText && newText.trim() !== "") {
        tasks[index].text = newText.trim();
        renderTasks();
    }
}

function markdone() {
    const index = parseInt(taskNumberInput.value) - 1;
    if (isNaN(index) || index < 0 || index >= tasks.length) {
        alert("Invalid task number.");
        return;
    }
    tasks[index].done = !tasks[index].done;
    renderTasks();
}

function toggleTheme() {
    const body = document.getElementById("theme");
    body.classList.toggle("dark-theme");
    body.classList.toggle("light-theme");
}

