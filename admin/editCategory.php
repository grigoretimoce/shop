<?php
  include 'session.php';
  $functii_active = ' class="active"';
  include 'header.php';
?>

<main id="main">
<div class="container">
  <h2 class="text-center" style="padding-top: 120px;">Categories <em>table</em></h2>
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
        $i = 1; // increment
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
      ?>

    </tbody>
  </table> 
</div>

<?php
  // get the category code from the GET request
  $category_code = $_GET["edit"];
  //print "category_code: $category_code <br>"; // debug.
  $query = "SELECT * FROM categories where code_categ = $category_code";
  //print "query: $query <br>"; // debug.

  $query_result = mysqli_query($cnx, $query);
  $result = mysqli_fetch_assoc($query_result);

  // Note: $results is an array!
  //foreach($result as $i) {
  //  echo $i . "\n";
  //}
?>

<div class="container mt-5" style="width: 500px;">
  <form method="post" action="actions/editCategory.php">
    <input type="hidden" name="post_category_code" value="<?= $category_code ?>">
    <div class="form-group">
      <label for="category">Category:</label>
      <input class="form-control" id="category" name="post_category_name" type="text" value="<?= $result['name'] ?>">
    </div>
    <button type="submit" class="btn btn-secondary mb-2 col-xs-3">Modify!</button>
  </form>
</div>

</main>
</body>
</html>