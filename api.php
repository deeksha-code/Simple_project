<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Handle preflight (VERY IMPORTANT)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

// GET → fetch users
// if ($method === "GET") {
//     $result = $conn->query("SELECT * FROM users");
//     $data = [];

//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }

//     echo json_encode($data);
// }


if ($method === "GET") {
    $result = $conn->query("SELECT * FROM users");

    if (!$result) {
        echo json_encode(["error" => $conn->error]);
        exit();
    }

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

// POST → insert user
if ($method === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $name = $data->name;
    $email = $data->email;

    $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");

    echo json_encode(["message" => "Inserted"]);
}

// DELETE → delete user
if ($method === "DELETE") {
    $id = $_GET['id'];

    $conn->query("DELETE FROM users WHERE id=$id");

    echo json_encode(["message" => "Deleted"]);
}
?>