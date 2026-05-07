<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Library Management System</title>
</head>
<body>
    <h1>University Library Management System</h1>

    <h2 id="formTitle">Add Book</h2>
    <p id="message"></p>

    <form id="bookForm">
        <input type="hidden" id="bookId" name="id">

        <label for="title">Book Title</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Author Name</label><br>
        <input type="text" id="author" name="author" required><br><br>

        <label for="category">Category</label><br>
        <input type="text" id="category" name="category" required><br><br>

        <label for="availability">Availability Status</label><br>
        <select id="availability" name="availability">
            <option value="Available">Available</option>
            <option value="Issued">Issued</option>
        </select><br><br>

        <button type="submit" id="submitButton">Add Book</button>
        <button type="button" id="cancelButton" onclick="resetForm()" hidden>Cancel Update</button>
    </form>

    <h2>Book Records</h2>
    <table border="2" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author Name</th>
                <th>Category</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="bookTableBody">
            <tr>
                <td colspan="6">Loading records...</td>
            </tr>
        </tbody>
    </table>

    <script>
        const handlerUrl = "../ajax/book_handler.php";
        const bookForm = document.getElementById("bookForm");
        const message = document.getElementById("message");

        document.addEventListener("DOMContentLoaded", loadBooks);

        bookForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(bookForm);
            const id = document.getElementById("bookId").value;
            formData.append("action", id ? "update" : "add");

            fetch(handlerUrl, {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    showMessage(data.message);
                    if (data.status === "success") {
                        resetForm();
                        loadBooks();
                    }
                })
                .catch(() => showMessage("Request failed."));
        });

        function loadBooks() {
            fetch(handlerUrl + "?action=list")
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById("bookTableBody");
                    tableBody.innerHTML = "";

                    if (!data.books || data.books.length === 0) {
                        tableBody.innerHTML = "<tr><td colspan='6'>No book records found.</td></tr>";
                        return;
                    }

                    data.books.forEach(book => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${escapeHtml(book.id)}</td>
                            <td>${escapeHtml(book.title)}</td>
                            <td>${escapeHtml(book.author)}</td>
                            <td>${escapeHtml(book.category)}</td>
                            <td>${escapeHtml(book.availability)}</td>
                            <td>
                                <button type="button" onclick="editBook(${book.id})">Edit</button>
                                <button type="button" onclick="deleteBook(${book.id})">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(() => {
                    document.getElementById("bookTableBody").innerHTML =
                        "<tr><td colspan='6'>Unable to load records.</td></tr>";
                });
        }

        function editBook(id) {
            fetch(handlerUrl + "?action=get&id=" + encodeURIComponent(id))
                .then(response => response.json())
                .then(data => {
                    if (data.status !== "success") {
                        showMessage(data.message);
                        return;
                    }

                    document.getElementById("bookId").value = data.book.id;
                    document.getElementById("title").value = data.book.title;
                    document.getElementById("author").value = data.book.author;
                    document.getElementById("category").value = data.book.category;
                    document.getElementById("availability").value = data.book.availability;
                    document.getElementById("formTitle").textContent = "Update Book";
                    document.getElementById("submitButton").textContent = "Update Book";
                    document.getElementById("cancelButton").hidden = false;
                })
                .catch(() => showMessage("Unable to fetch book details."));
        }

        function deleteBook(id) {
            if (!confirm("Are you sure you want to delete this book?")) {
                return;
            }

            const formData = new FormData();
            formData.append("action", "delete");
            formData.append("id", id);

            fetch(handlerUrl, {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    showMessage(data.message);
                    loadBooks();
                })
                .catch(() => showMessage("Unable to delete book."));
        }

        function resetForm() {
            bookForm.reset();
            document.getElementById("bookId").value = "";
            document.getElementById("formTitle").textContent = "Add Book";
            document.getElementById("submitButton").textContent = "Add Book";
            document.getElementById("cancelButton").hidden = true;
        }

        function showMessage(text) {
            message.textContent = text || "";
        }

        function escapeHtml(value) {
            const div = document.createElement("div");
            div.textContent = value;
            return div.innerHTML;
        }
    </script>
</body>
</html>
