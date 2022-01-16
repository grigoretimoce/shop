<?php
  session_start();
  if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
    $code = $_GET['delete'];
    include '../../connect.php';
    $command = "DELETE FROM categories where code_categ = $code";
    mysqli_query($cnx, $command);
    mysqli_close($cnx);
    // reload "categories.php"
    header('Location: ../categories.php');
  } else {
    // not logged in
    header('Location: ../index.php');
  }
?>