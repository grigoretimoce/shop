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

    if ($_POST['post_code'] == 'Choose category...') {
      $error .= '<p>Please enter a category code!</p>';
    }
    else {
      $code = sanitize_input($_POST['post_code']);
    }

    if (empty($_POST['post_name'])) {
      $error .= '<p>Please enter a product name!</p>';
    }
    else {
      $name = sanitize_input($_POST['post_name']);
    }

    // if the lenght of the uploaded file is zero, fail.
    if (strlen($_FILES["post_main_photo"]["name"]) == 0)  {
      $error .= '<p>Please enter the main photo!</p>'.PHP_EOL;
    } else {
      $main_photo_name = $_FILES["post_main_photo"]["name"];
      $name_tmp = $_FILES["post_main_photo"]["tmp_name"];
      $extension = pathinfo($main_photo_name, PATHINFO_EXTENSION);

      print "main_photo_name: $main_photo_name <br>";
      print "name_tmp: $name_tmp <br>";
      print "extension: $extension <br>";
    }

    if (empty($_POST['post_picture1'])) {
      //$error .= '<p>Please enter product picture 1!</p>';
    }
    else {
      $picture1 = $_POST['post_picture1'];
    }

    if (empty($_POST['post_title'])) {
      $error .= '<p>Please enter a product title!</p>';
    }
    else {
      $title = sanitize_input($_POST['post_title']);
    }

    if (empty($_POST['post_description'])) {
      $error .= '<p>Please enter a product description!</p>';
    }
    else {
      $description = sanitize_input($_POST['post_description']);
    }

    // check if we have no errors
    if ($error == '') {
      include '../../connect.php'; // used for getting the $cnx variable (MySQL connection parameters)

      // initial name for each photo.
	    $photo_init = 'temp.png';

      // build the INSERT SQL command
      $command = "INSERT INTO products (code_categ, name, picture_main, title, description) VALUES (?, ?, ?, ?, ?)";
      if ($statement = mysqli_prepare($cnx, $command)) {
        mysqli_stmt_bind_param($statement, 'sssss', $code, $name, $photo_init, $title, $description);
        mysqli_stmt_execute($statement);

        // get the primary key id, which is the product code.
        $product_code = mysqli_insert_id($cnx);
        print "product_code: $product_code <br>";

        // create the new product directory.
        mkdir("../../assets/img/products/product-$product_code", 0770);

        print "main_photo_name: $main_photo_name <br>";
        // we need to move the file $name_tmp to ../../assets/img/products/product-$product_code".
        // then, rename it to $main_photo_name.
        rename("$name_tmp", "../../assets/img/products/product-$product_code/$main_photo_name");

        // update the file name in the DB.
        $update = "UPDATE products set picture_main='$main_photo_name' where code_product=$product_code";
        //print "update query: $update <br>"; // debug.
        mysqli_query($cnx, $update) or die("DB update failed!");
      }
      else {
        echo "Error at creating the insert command.";
      }
      mysqli_close($cnx);
      // reload "products.php"
      //header('Location: ../products.php');
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