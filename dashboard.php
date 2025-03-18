<?php
// session_start();
include('config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
  // Show Tasks
  $user_id = $_SESSION['user_id'];

  $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
  $stmt->execute([$user_id]);
  $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);

  $groupTasks = [
    'To Start' => [], 
    'In Progress' => [],
    'Completed' => []
  ];

  foreach ($tasks as $task) {
    $groupTasks[$task->status][] = $task;
  }