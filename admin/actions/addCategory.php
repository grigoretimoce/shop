<?php
session_start();

function sanitize_input($str) {
  $str = trim($str);
  $str = stripslashes($str);
  $str = htmlspecialchars($str);
  return $str;
}

if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
  $error = '';

  if (empty($_POST['name'])) {
    $error .= '<p>Please enter a category name!</p>';
  }
  else {
    $name = sanitize_input($_POST['name']);
  }

  // check if we have no errors
  if ($error == '') {
    include '../../connect.php';
    // build the INSERT SQL command
    $command = "INSERT INTO categories (name) VALUES (?)";
    //echo "command: " . $command;
    if ($stm = mysqli_prepare($cnx, $command)) {
      mysqli_stmt_bind_param($stm, 's', $name);
      mysqli_stmt_execute($stm);
    }
    else {
      echo "Error at creating the insert command.";
    }
    mysqli_close($cnx);
    // reload "categories.php"
    header('Location: ../categories.php');
  }
  else {
      echo "Error: " . $error;
  }
}
else {
    // user not logged in
    header('Location: ../index.php');
}
?>