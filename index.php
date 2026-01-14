<?php
  include('dashboard.php');

  ob_start();
  include __DIR__ . '/components/header.php';
  include __DIR__ . '/components/task-list.php';
  $content = ob_get_clean();
  include __DIR__ . '/layout.php';
?>