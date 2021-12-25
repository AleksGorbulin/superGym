<?php 
session_start();
$sessid= session_id();
// error_reporting(E_ALL);
// ini_set('display_errors',1);
$total=0;
$itemsInCart = '';
$qty=1;
// Connect to DB
include 'inc/dbconnect.php';
//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

include 'adddeletecart.php';



// Get products from the cart
$getcart=$dbh->prepare("SELECT products.name,  products.product_id,products.image, products.desk, products.price, products.product_id,cartitems.qty 
from products, cartitems
where cartitems.productid = products.product_id and '$sessid' = cartitems.sessionid");
$getcart->execute(); 
$cartitems= $getcart->fetchAll();

?>
            <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" href="index.php">SUPER GYM</a>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Products <span class="sr-only">(current)</span></a
            >
          </li>
                    </ul>
                </div>
                <div>
                <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" id="mainSearch" type="search" placeholder="Search" aria-label="Search" />
                    </form>
                    <ul id="myUL">

                    </ul>
                </div>



                    <ul class="navbar-nav cart-button">
                    <li class="nav-item ">


                                    
                                    <?php if(!empty($cartitems)):?>
                                        <table class="table table-striped cart-dropdown ">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th class="d-md-table-cell">Name</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            
                                            <?php foreach($cartitems as $key=>$cartitem):?>
                                                <tr>
                                                    <td><img src="<?php print $cartitem['image'];?>" width="50"></td>
                                                    <td class="d-sm-none d-md-table-cell">
                                                        <?php echo $cartitem['name'];?>
                                                    </td>
                                                    <td>$
                                                        <?php print $cartitem['price']?>
                                                    </td>
                                                    <td>
                                                        <?php print $cartitem['qty']?>
                                                    </td>
                                                    <!-- <td><a href="index.php?action=empty&sku=<?php print $cartitem['product_id']?>" class="btn btn-info">Delete</a></td> -->
                                                    <td><a href="<?php echo $currentpage; ?>&action=empty&sku=<?php print $cartitem['product_id']?>" class="btn trash-icon"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>
                                                <?php 
                                                // Getting total items in cart
                                                    $itemsInCart+= count($cartitem['name'])*$cartitem['qty'];
                                                 ?>
                                            <?php endforeach; ?>
                                                
                                                    <!-- <php endforeach;?> -->
                                                        <tr>
                                                            <td colspan="5" align="right">
                                                                <!-- <h4>Total:$<php print $total?> -->
                                                                | <a href="checkout.php">Checkout</a>
                                                                </h4></td>
                                                        </tr>
                                        </table>
                                        <?php endif;?>
                                         
                                        <a href="" class="nav-link nav-right waves-effect">                                   
                                            <span class="badge red z-depth-1 mr-1">
                                                 <?php echo $itemsInCart; ?> 
                                            </span>
                                            <i class="fas fa-shopping-cart"></i>
                                            <span class="clearfix d-none d-sm-inline-block"> Cart </span> 
                                        </a>
                                            <!--                  shopping cart end-->
                    </li>
                </ul>

            </nav>

        </div>
        