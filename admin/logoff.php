<?php
  session_start();
  session_unset();
  session_destroy();
  // reload "index.php"
  header('Location: index.php');
?>