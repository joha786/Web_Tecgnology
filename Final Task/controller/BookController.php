<?php
require_once __DIR__ . "/../model/BookModel.php";

function addBookController($data)
{
    if (isset($data["title"])) {
        $title = trim($data["title"]);
    } else {
        $title = "";
    }
    if (isset($data["author"])) {
        $author = trim($data["author"]);
    } else {
        $author = "";
    }
    if(isset($data["category"])) {
        $category = trim($data["category"]);
    } else {
        $category = "";
    }
    if (isset($data["availability"])) {
        $availability = trim($data["availability"]);
    } else {
        $availability = "Available";
    }

    if ($title === "" || $author === "" || $category === "") {
        return array("status" => "error", "message" => "All fields are required.");
    }

    if (!isValidAvailability($availability)) {
        return array("status" => "error", "message" => "Invalid availability status.");
    }

    if (insertBook($title, $author, $category, $availability)) {
        return array("status" => "success", "message" => "Book added successfully.");
    }

    return array("status" => "error", "message" => "Unable to add book.");
}

function listBooksController()
{
    return array("status" => "success", "books" => getAllBooks());
}

function getBookController($id)
{
    $book = getBookById($id);

    if ($book) {
        return array("status" => "success", "book" => $book);
    }

    return array("status" => "error", "message" => "Book not found.");
}

function updateBookController($data)
{
    $id = $data["id"] ?? 0;
    $title = trim($data["title"] ?? "");
    $author = trim($data["author"] ?? "");
    $category = trim($data["category"] ?? "");
    $availability = trim($data["availability"] ?? "Available");

    if ($id == 0 || $title === "" || $author === "" || $category === "") {
        return array("status" => "error", "message" => "All fields are required.");
    }

    if (!isValidAvailability($availability)) {
        return array("status" => "error", "message" => "Invalid availability status.");
    }

    if (updateBook($id, $title, $author, $category, $availability)) {
        return array("status" => "success", "message" => "Book updated successfully.");
    }

    return array("status" => "error", "message" => "Unable to update book.");
}

function deleteBookController($id)
{
    if ($id == 0) {
        return array("status" => "error", "message" => "Invalid book id.");
    }

    if (deleteBook($id)) {
        return array("status" => "success", "message" => "Book deleted successfully.");
    }

    return array("status" => "error", "message" => "Unable to delete book.");
}

function isValidAvailability($availability)
{
    return in_array($availability, array("Available", "Issued"));
}
?>
