<?php
$servername = "localhost";
$username = "root";
$password = "anmol";
$database = "ToDoDB";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($database);

$sql = "CREATE TABLE IF NOT EXISTS completed_tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="background.jpeg">
    <div class="main">
        <div class="container">
            <h1 class="ToDoEdit">To-Do List</h1>
            <nav>
                <ul>
                    <li><a href="Question2.html">Home</a></li>
                    <li><a href="#">Sign In</a></li>
                </ul>
            </nav>
            <div class="content">
  <div class="addTask">
    <input type="text" class="taskInput" placeholder="Add a new task">
    <button class="addTaskBtn">Add Task</button>
  </div>
  <br>
  <div class="taskList"></div> 
</div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>