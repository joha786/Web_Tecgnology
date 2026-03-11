// 1. Event listener for form submission

let controls = document.createElement("div");
controls.classList.add("controls");
document.body.appendChild(controls);

document.getElementById('student-form').addEventListener('submit', addStudent);

// ---------- EXTRA UI ELEMENTS ----------

// Search input
let searchInput = document.createElement("input");
searchInput.placeholder = "Search student";
controls.appendChild(searchInput);

// Total students counter
let totalPara = document.createElement("p");
totalPara.textContent = "Total students: 0";
controls.appendChild(totalPara);

// Present / Absent counter
let presentPara = document.createElement("p");
presentPara.innerHTML = "Present: 0<br>Absent: 0";
controls.appendChild(presentPara);

// Sort button
let sortButton = document.createElement("button");
sortButton.textContent = "Sort A-Z";
controls.appendChild(sortButton);

// Highlight first student button
let highlightFirst = document.createElement("button");
highlightFirst.textContent = "Highlight First Student";
controls.appendChild(highlightFirst);

// Highlight button
let changeStyleButton = document.createElement('button');
changeStyleButton.textContent = 'Highlight Students';
controls.appendChild(changeStyleButton);


// Disable Add button if name empty
let addButton = document.querySelector("#student-form button");
addButton.disabled = true;

document.getElementById("student-name").addEventListener("input", function () {
    addButton.disabled = this.value.trim() === "";
});

// ---------- UPDATE COUNTERS ----------
function updateCount() {

    let students = document.querySelectorAll(".student-item");
    totalPara.textContent = "Total students: " + students.length;

    let present = document.querySelectorAll(".present").length;
    let absent = students.length - present;

    presentPara.innerHTML = "Present: " + present + "<br>Absent: " + absent;
}


// 2. Add student function
function addStudent(event) {

    event.preventDefault();

    let studentName = document.getElementById('student-name').value;
    let studentRoll = document.getElementById('student-roll').value;

    if (studentName === '' || studentRoll === '') {
        alert('Please enter a student name and roll');
        return;
    }

    let li = document.createElement('li');
    li.classList.add('student-item');

    let span = document.createElement('span');
    span.textContent = studentRoll;

    let rollSpan = document.createElement('span');
    rollSpan.textContent = ' - ' + studentName;

    // Present checkbox
    let presentCheck = document.createElement("input");
    presentCheck.type = "checkbox";

    presentCheck.addEventListener("change", function () {

        if (presentCheck.checked) {
            li.classList.add("present");
        } else {
            li.classList.remove("present");
        }

        updateCount();
    });

    // Edit button
    let editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.classList.add('btn-edit');

    editButton.addEventListener('click', function () {
        editStudent(span, rollSpan);
    });

    // Delete button
    let deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('btn-delete');

    deleteButton.addEventListener('click', function () {

        if (confirm("Are you sure you want to delete this student?")) {
            deleteStudent(li);
            updateCount();
        }

    });

    // Append elements
    li.appendChild(span);
    li.appendChild(rollSpan);
    li.appendChild(presentCheck);
    li.appendChild(editButton);
    li.appendChild(deleteButton);

    document.getElementById('student-list').appendChild(li);

    document.getElementById('student-name').value = '';
    document.getElementById('student-roll').value = '';

    updateCount();
}


// Delete student
function deleteStudent(studentElement) {
    studentElement.remove();
}


// Edit student
function editStudent(rollElement, nameElement) {

    let newRoll = prompt("Enter new roll:", rollElement.textContent);
    let newName = prompt("Enter new name:", nameElement.textContent.replace(" - ", ""));

    if (newRoll !== null && newRoll !== "") {
        rollElement.textContent = newRoll;
    }

    if (newName !== null && newName !== "") {
        nameElement.textContent = " - " + newName;
    }
}


// Highlight all students
function changeListStyle() {

    let students = document.querySelectorAll('.student-item');

    students.forEach(student => {
        student.classList.toggle('highlight');
    });

}

changeStyleButton.addEventListener('click', changeListStyle);


// SEARCH STUDENT
searchInput.addEventListener("input", function () {

    let search = this.value.toLowerCase();
    let students = document.querySelectorAll(".student-item");

    students.forEach(student => {

        if (student.textContent.toLowerCase().includes(search)) {
            student.style.display = "";
        } else {
            student.style.display = "none";
        }

    });

});


// SORT STUDENTS
sortButton.addEventListener("click", function () {

    let ul = document.getElementById("student-list");
    let items = Array.from(document.querySelectorAll(".student-item"));

    items.sort((a, b) => a.textContent.localeCompare(b.textContent));

    items.forEach(item => ul.appendChild(item));

});


// HIGHLIGHT FIRST STUDENT
highlightFirst.addEventListener("click", function () {

    let students = document.querySelectorAll(".student-item");

    students.forEach(s => s.classList.remove("top-student"));

    if (students.length > 0) {
        students[0].classList.add("top-student");
    }

});