<?php
  session_start();
  if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
    $code = $_POST['post_category_code'];
    $name = $_POST['post_category_name'];
    include '../../connect.php';
    $command = "UPDATE categories set name = '$name' where code_categ = $code";
    mysqli_query($cnx, $command);
    mysqli_close($cnx);
    // reload "categories.php"
    header('Location: ../categories.php');
  } else {
    // not logged in
    header('Location: ../index.php');
  }
?>