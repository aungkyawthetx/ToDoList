<?php
  session_start();
  include('config.php');

  if (!$_SESSION['user_id']) {
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

  ob_start();
  include __DIR__ . '/components/header.php';
  include __DIR__ . '/components/task-list.php';
  
  $content = ob_get_clean();
  include __DIR__ . '/layout.php';
?>