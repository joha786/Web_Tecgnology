<?php
require_once __DIR__ . "/../config/db.php";

function insertBook($title, $author, $category, $availability)
{
    global $conn;

    $title = mysqli_real_escape_string($conn, $title);
    $author = mysqli_real_escape_string($conn, $author);
    $category = mysqli_real_escape_string($conn, $category);
    $availability = mysqli_real_escape_string($conn, $availability);

    $query = "INSERT INTO books (title, author, category, availability)
              VALUES ('$title', '$author', '$category', '$availability')";

    return mysqli_query($conn, $query);
}

function getAllBooks()
{
    global $conn;

    $query = "SELECT * FROM books ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    $books = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    return $books;
}

function getBookById($id)
{
    global $conn;

    $id = (int) $id;
    $query = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($result);
}

function updateBook($id, $title, $author, $category, $availability)
{
    global $conn;

    $id = (int) $id;
    $title = mysqli_real_escape_string($conn, $title);
    $author = mysqli_real_escape_string($conn, $author);
    $category = mysqli_real_escape_string($conn, $category);
    $availability = mysqli_real_escape_string($conn, $availability);

    $query = "UPDATE books
              SET title = '$title',
                  author = '$author',
                  category = '$category',
                  availability = '$availability'
              WHERE id = $id";

    return mysqli_query($conn, $query);
}

function deleteBook($id)
{
    global $conn;

    $id = (int) $id;
    $query = "DELETE FROM books WHERE id = $id";

    return mysqli_query($conn, $query);
}
?>
