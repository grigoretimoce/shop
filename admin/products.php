<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Products</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Template Main CSS File -->
  <!-- Vendor CSS Files -->
  
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  
</head>

<?php
  //include 'session.php';
  //$categories_active = ' class="active"';
  //include 'header.php';

  session_start();
  if (isset($_SESSION['connected']))
  {
    include '../connect.php';
    $query = "SELECT code_categ, name FROM categories";
    $sql_result = mysqli_query($cnx, $query) or die("Error: " . mysqli_error($cnx)); // object !!!

    /*
    while ($output = mysqli_fetch_assoc($sql_result)) :
      foreach ($output as $i) { // $output is an array.
        echo $i . "\n";       // $i is the array element (column).
      }
      print "<br>";
    endwhile;
    */
    }
    else {
      header('Location: index.php');  
  }
?>

<main id="main">
<div class="container">

<form action="actions/addProduct.php" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
  <div class="form-row">

    <div class="col-md-6 form-group">
      <select class="custom-select" name="post_code" id="category">
        <option selected>Choose category...</option>
          <?php  while ($rez = mysqli_fetch_assoc($sql_result)): ?>
          <option value="<?= $rez['code_categ']?>"><?= $rez['name']?></option>
          <?php   endwhile;   ?>
      </select>
    </div>

    <div class="col-md-6 form-group">
      <input type="text" class="form-control" name="post_name" id="name" placeholder="Product name">
    </div>

  </div>

  <div class="form-row">
    <div class="col-md-6 form-group">
      <input type="file" class="custom-file-input" name="post_main_photo" id="main_photo">
      <label class="custom-file-label" for="main_photo">Select main photo</label>
    </div>
                
    <div class="col-md-6 form-group">
      <input type="file" class="custom-file-input" name="post_picture1" id="picture1">
      <label class="custom-file-label" for="picture1">Select second photo</label>
    </div>    
  </div>

  <div class="form-row">
    <div class="col-md-6 form-group">
      <input type="text" class="form-control" name="post_title" id="title" placeholder="Product title">
    </div>
                
  </div>
    
  <div class="form-group">
    <textarea class="form-control" name="post_description" rows="5"  placeholder="Description"></textarea>
  </div>
             
  <div class="text-center"><button type="submit">Add product</button></div>
</form>

</div>
</main>