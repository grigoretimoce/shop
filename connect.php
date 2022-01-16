<?php
  $cnx = mysqli_connect("localhost", "root", "", "shop");  // user: root, no password
  // testing the connection
  if (mysqli_connect_errno()) {
     die("Failed to connect to MySQL: " . mysqli_connect_error());
  }
  
  // use the utf8 character set
  mysqli_set_charset($cnx, "utf8");
?>