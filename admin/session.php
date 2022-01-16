<?php 
  session_start();
  if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
    $name = '<i class="fa fa-user-o" aria-hidden="true"></i>' . '  ' . $_SESSION['name'];
    $display_btcon = "d-none";    // the connect button will not be visible
    $display_btdecon = "d-block"; // the connect button will be visible
  } else {
    $name = '<i class="fa fa-user-o" aria-hidden="true"></i>   Disconnect';
    $display_btcon = "d-block";  // the connect button will not be visible
    $display_btdecon = "d-none"; // the connect button will be visible
  }

  $home_active = "";
  $services_active = "";
  $products_active = "";
  $contact_active = "";
  include '../connect.php';
?>