<?php
// error_reporting(E_ALL);
// ini_set('display_errors',1);

$pid = $_GET['pid'];
// Connect to DB
include 'inc/dbconnect.php';
// sql query to get the right product
// $query = "SELECT products.product_id, products.name, products.sku, products.price, products.image, products.desk, products.catid from 
// products WHERE products.product_id = ?";
// $stmt = $dbh->prepare($query);
// $stmt->bindParam(1,$pid);
// $stmt->execute();
// $product = $stmt->fetch();
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="js/dropdown.js"></script>
        <link rel="stylesheet" href="css/fontawesome/css/all.css" />
        <link rel="stylesheet" href="css/style.css" />
        <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="js/main.js" type="text/javascript"></script>
  <title></title>
</head>
<body>



  <!--Main layout-->
  <!-- <main class="mt-5 pt-4"> -->
    <div class="container dark-grey-text ">
    <?php include 'inc/navbar.php'; ?>
      <!--Grid row-->
      <div class="row wow fadeIn mt-5">

        <!--Grid column-->
        <div class="col-md-6 mb-4 text-center">
            <?php  
            // sql query to get the right product
$query = "SELECT products.product_id, products.name, products.sku, products.price, products.image, products.desk, products.catid from 
products WHERE products.product_id = ?";
$stmt = $dbh->prepare($query);
$stmt->bindParam(1,$pid);
$stmt->execute();
$product = $stmt->fetch();

// sql query to get product categories from table productCategories
$query = "SELECT * from productCategories
 WHERE productCategories.product_id = ?";
$stmt = $dbh->prepare($query);
$stmt->bindParam(1,$pid);
$stmt->execute();
$productCategore = $stmt->fetchAll();
// var_dump($productCategore);
// echo 'product categorie'. $productCategore[1];

            ?>
          <!-- <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/14.jpg" class="img-fluid" alt=""> -->
          <img src="<?php echo $product['image']; ?>" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
            <?php 
            foreach($productCategore as $value):
            ?>
              <a href="">
                <span class="badge purple mr-1"><?php echo $value['cat_name'];?></span>
              </a>
              <?php endforeach; ?>
            </div>

            <p class="lead">
              <span class="mr-1 oldPrice">
                <del>$<?php echo round($product['price']*1.7 , 2); ?></del>
              </span>
              <span>$<?php echo $product['price']; ?></span>
            </p>

            <p class="lead font-weight-bold"><?php echo $product['name']; ?></p>

            <p><?php echo $product['desk']; ?></p>
              <form method="POST" class="d-flex justify-content-left"
              action="<?php echo $_SERVER['PHP_SELF'];?>?action=addcart&pid=<?php echo $pid ?>">

                             <p style="text-align:center;color:#04B745;">
                             <button class="btn btn-secondary btn-md my-0 p" type="submit">Add to cart
                                 <i class="fas fa-shopping-cart ml-1"></i>
                             </button>
                                 <input type="hidden" name="sku" value="<?php print $product['sku']?>">
                             </p>
              </form>

            <!-- </form> -->

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Frequently bought together</h4>

          <p>Check out items that are most popular or were bought together with
            <?php echo $product['name']; ?>
          </p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">
      <?php include 'inc/frequentPurchases.php'; ?>
      </div>
      <!--Grid row-->

    </div>
  <!-- </main> -->
  <!--Main layout-->
  <!-- include footer -->
  <?php include 'inc/footer.php'; ?>
  

</body>
</html>