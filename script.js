const roleSelect = document.getElementById("role");
const studentFields = document.getElementById("studentFields");
const teacherFields = document.getElementById("teacherFields");
const form = document.getElementById("registrationForm");

roleSelect.addEventListener("change", function () {
    studentFields.classList.add("hidden");
    teacherFields.classList.add("hidden");

    if (this.value === "student") {
        studentFields.classList.remove("hidden");
    } 
    else if (this.value === "teacher") {
        teacherFields.classList.remove("hidden");
    }
});

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const role = roleSelect.value;

    if (!role) {
        alert("Please select a role.");
        return;
    }

    alert(`Registration successful as ${role.toUpperCase()}`);
    
    // TODO: Submit data to backend via fetch/AJAX
});
