<?php 
$query = "SELECT * FROM products LIMIT 3";
$stmt = $dbh->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();
?>      
                           <div class="col-lg-4 col-md-12 mb-4 d-flex justify-content-center">
                                <a href="<?php echo 'product.php?pid=' .$products[0]['product_id'];?>"class="frequentItem first pt-3">
                                    <img src="<?php echo $products[0]['image']; ?>" class="img-fluid " alt="">
                                </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
                                <a href="<?php echo 'product.php?pid=' .$products[1]['product_id'];?>"class="frequentItem pt-3">
                                    <img src="<?php echo $products[1]['image']; ?>" class="img-fluid " alt="">
                                </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
                                <a href="<?php echo 'product.php?pid=' .$products[2]['product_id'];?>"class="frequentItem pt-3">
                                    <img src="<?php echo $products[2]['image']; ?>" class="img-fluid " alt="">
                                </a>
                                </div>
                           