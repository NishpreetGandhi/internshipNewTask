<?php
$servername = "localhost";
$username = "root";
$password = "anmol";
$database = "ToDoDB";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($data)) {
        die(json_encode(["error" => "No JSON data received."]));
    }

    if (!isset($data['task']) || empty(trim($data['task']))) {
        die(json_encode(["error" => "Task cannot be empty."]));
    }

    $task = trim($data['task']);

    $stmt = $conn->prepare("INSERT INTO completed_tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "task" => $task, "id" => $stmt->insert_id]);
    } else {
        echo json_encode(["error" => "Database error: " . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>