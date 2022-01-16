<html>
<body>
<title>Categories</title>

<?php
  include 'session.php';
  $categories_active = ' class="active"';
  include 'header.php';
?>

<main id="main">
<div class="container">
  <h2 class="text-center" style="padding-top: 120px;">Table: <em>Categories</em></h2>
</div>
<div class="container" style="width: 500px;">
  <table class="table mt-5" style="border-bottom: 2px solid #DEE2E6">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category</th>
        <th scope="col" class="text-center">Operations</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM categories ORDER BY name";
        $rows = mysqli_query($cnx, $query) or die("Error: " . mysqli_error($cnx));
        $i = 1;  // increment
        while ($result = mysqli_fetch_assoc($rows)):
      ?>
      <tr>
        <th scope="row"><?= $i ?></th>
        <td class="w-70"><?= $result['name'] ?></td>
        <td class="w-30 text-center">
          <a href="editCategory.php?edit=<?= $result['code_categ'] ?>">
            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
          <a href="actions/deleteCategory.php?delete=<?= $result['code_categ'] ?>">
            <i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
        </td>
      </tr>
      <?php 
        $i++;
        endwhile;
        mysqli_close($cnx);
      ?>
    </tbody>
  </table>
</div>

<div class="container mt-5" style="width: 500px;">
  <form method="post" action="actions/addCategory.php">
    <div class="form-group">
      <label for="category">Category:</label>
      <input class="form-control" id="category" name="name" type="text">
    </div>

    <button type="submit" class="btn btn-secondary mb-2 col-xs-3">Add</button>
  </form>
</div>
</main>
</body>
</html>