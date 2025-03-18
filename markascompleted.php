<?php
include('config.php');

if(!empty($_POST['task_id'])) {
  $task_id = $_POST['task_id'];

  $stmt = $pdo->prepare("UPDATE tasks SET status = 'Completed' WHERE id=:id");
  $stmt->execute([
    ':id' => $task_id
  ]);
  if($stmt) {
    header("Location: index.php");
    exit();
  } else {
    echo "failed to update task";
  }
}
else {
  echo "task_id not found.";
}