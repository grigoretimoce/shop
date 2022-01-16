<?php
  include 'session.php';
  $home_active = ' class="active"';
  include 'header.php';
?>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="hero-container" data-aos="fade-up">
    <h1>Admin-Shop</h1>
    <p>Web application for site database management <em>Shop</em>.</p>
    <div class="<?= $display_btcon ?>">
      <a href="login.php" class="btn-get-started2">Connect</a>
    </div>

    <div  class="<?= $display_btdecon ?>">
      <a href="logoff.php" class="btn-get-started2">Disconnect</a>
    </div>

  </div>
</section><!-- End Hero -->

<main id="main">
</main><!-- End #main -->

</body>
</html>