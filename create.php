<?php
session_start();
include('config.php');

  if(isset($_POST['btnAddTask'])) {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['discription']);
    $status = trim($_POST['status'] ?? 'To Start');
    $created_date = $_POST['date'];
    
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, status, created_date) VALUES (:user_id, :title, :description, :status, :created_date)");
    $stmt->execute([    
    ':user_id' => $user_id,
    ':title' => $title,
    ':description' => $description, 
    ':created_date' => $created_date,
    ':status' => $status
    ]);
    header('Location: index.php');
    exit();
  }
?>