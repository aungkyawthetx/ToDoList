<?php
require 'config.php';

if (isset($_POST['task_id'], $_POST['title'])) {
  $stmt = $pdo->prepare(
    "UPDATE tasks SET title = :title WHERE id = :id"
  );
  $stmt->execute([
    'title' => trim($_POST['title']),
    'id' => $_POST['task_id']
  ]);
}

header("Location: index.php");
exit;
