<?php
  ob_start();
  $pageTitle = 'Settings';
  session_start();

  include __DIR__ . '/coming-soon.php';

  $content = ob_get_clean();
  include __DIR__ . '/components/layout.php';
?>