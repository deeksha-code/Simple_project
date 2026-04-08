<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "db.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    // Page number (default = 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Records per page
    $limit = 5;

    // Offset calculation
    $offset = ($page - 1) * $limit;

    // Query with LIMIT and OFFSET
    $stmt = $conn->prepare("SELECT * FROM users LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
?>