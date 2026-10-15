// script.js
// Two small features. Each only runs if its page has the right element.

// ---------- Feature 1: check the sign-up form before sending ----------
var form = document.getElementById("signup-form");

if (form) {
    form.addEventListener("submit", function (event) {
        var name     = document.getElementById("student_name").value.trim();
        var email    = document.getElementById("email").value.trim();
        var activity = document.getElementById("activity_id").value;
        var errorBox = document.getElementById("js-error");

        var problem = "";

        if (name == "") {
            problem = "Please type your name.";
        } else if (email.indexOf("@") == -1 || email.indexOf(".") == -1) {
            problem = "Please type a valid email, like name@example.com.";
        } else if (activity == "0") {
            problem = "Please choose an activity.";
        }

        // If something is wrong: stop the form and show the problem
        if (problem != "") {
            event.preventDefault();
            errorBox.textContent = problem;
            errorBox.style.display = "block";
            return;
        }

        // Everything is fine: ask the student to confirm
        if (!confirm("Send your sign-up now?")) {
            event.preventDefault();
        }
    });
}

// ---------- Feature 2: search box on the "Who Joined" page ----------
var searchBox = document.getElementById("search-box");

if (searchBox) {
    searchBox.addEventListener("keyup", function () {
        var typed = searchBox.value.toLowerCase();
        var rows = document.querySelectorAll("#signup-table tbody tr");

        // Show a row only if it contains the typed text
        for (var i = 0; i < rows.length; i++) {
            var rowText = rows[i].textContent.toLowerCase();
            if (rowText.indexOf(typed) != -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
}
