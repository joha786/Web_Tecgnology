<?php
header("Content-Type: application/json");

require_once __DIR__ . "/../controller/BookController.php";

$action = $_POST["action"] ?? $_GET["action"] ?? "";
$response = array("status" => "error", "message" => "Invalid request.");

if ($action === "add") {
    $response = addBookController($_POST);
} elseif ($action === "list") {
    $response = listBooksController();
} elseif ($action === "get") {
    $response = getBookController($_GET["id"] ?? 0);
} elseif ($action === "update") {
    $response = updateBookController($_POST);
} elseif ($action === "delete") {
    $response = deleteBookController($_POST["id"] ?? 0);
}

echo json_encode($response);
?>
