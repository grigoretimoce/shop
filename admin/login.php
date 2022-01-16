<?php  
  include 'session.php';
  $home_active = ' class="active"';
  include 'header.php';
?>

<html>
<body>
<main id="main">
  <div class="container" style="padding-top: 150px;">
    <div class="section-title col-12">
      <h2>Connecting to Database</h2>
    </div>

    <div class="form d-block mx-auto" style="width: 500px;">
      <form action="actions/login.php" method="post">
        <div class="form-row">
          <div class="col-sm-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
          </div>
          <div class="col-sm-6 form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>
        </div>
                                  
        <div class="text-center"><button type="submit">Login</button></div>
      </form>
    </div>
  </div>
</main><!-- End #main -->
</body>
</html>