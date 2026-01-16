<?php
  ob_start();
  $pageTitle = 'Settings';
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }

  include __DIR__ . '/coming-soon.php';

  $content = ob_get_clean();
  include __DIR__ . '/components/layout.php';
?>