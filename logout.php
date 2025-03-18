<?php 
session_start();

if (empty($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if(isset($_POST['btnLogout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}