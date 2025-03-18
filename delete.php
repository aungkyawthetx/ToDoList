<?php
session_start();
include('config.php');

if (!empty($_GET['id'])) {
    $task_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Unable to delete task.";
    }
} else {
    echo "Invalid request.";
}
?>
