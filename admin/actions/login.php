<?php
  session_start();

  function sanitize($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
  }

  // get the login values from the form (name, password)
  $error = '';

  if (empty($_POST['name'])) {
    $error .= '<p>Please enter the name!</p>';
  } else {
    $name = sanitize($_POST['name']);
  }

  if (empty($_POST['password'])) {
    $error .= '<p>Please enter the password!</p>';
  } else {
    $password = sanitize($_POST['password']);
  }

  if ($error == '') {
    include '../../connect.php';

    $query = "SELECT * FROM admin where name = ? and password = ?";
    if ($statement = mysqli_prepare($cnx, $query)) {
      mysqli_stmt_bind_param($statement, 'ss', $name, $password);
      mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);
      if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['connected'] = true;
        $_SESSION['name'] = $row['name'];
      }
      mysqli_free_result($result);
    }

    mysqli_close($cnx);
    // reload "index.php"
    header('Location: ../index.php');
  } else {
    echo "Erorr: " . $error;
  }
?>