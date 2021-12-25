<?php
// error_reporting(E_ALL);
// ini_set('display_errors',1);
// Setting session start
session_start();
$sessid= session_id();
// phpinfo();
//var_dump($_SESSION);
//print_r($_SESSION);
$total=0;
$itemsInCart = '';
$qty=1;
include 'inc/dbconnect.php';

// if($dbh) echo 'connected to DB';
//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

// include 'adddeletecart.php';
 //Get all Products
$query = "SELECT * FROM products WHERE catid !='7'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();






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
        <title>Best Prices for protein, creatine and more</title>

        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45563912-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45563912-4');
</script>

    </head>

    <body>
        <div class="container">
        <?php include 'inc/navbar.php';?>

            <div class="row hero-images">
                <div class="col-md-6  d-none d-md-block d-lg-block d-xl-block">
                <h1>Help yourself to achieve more results.</h1>    
                </div>
                <div class="col-md-6 hero-image-2">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a hrefs="product.php?pid=4">
                                <img src="image/hero.jpg" class="d-block w-100" alt="..." />
                                <div class="carousel-caption ">
                                </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="product.php?pid=3">
                                <img src="image/protein.jpg" class="d-block w-100" alt="..." />
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="product.php?pid=2">
                                <img src="image/engn.jpg" class="d-block w-100" alt="..." />
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                                </a>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <i class="fas fa-angle-left"></i>

                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"><i class="fas fa-angle-right"></i>

              <span class="sr-only">Next</span>
            </a>
                    </div>
                </div>
            </div>
            <!-- end hero images -->
            <!-- beginning products -->
            <div class="row products mt-5">
            <div class="col-lg-3 col-md-12  col-md-pull-12 col-sm-pull-12">
                    <!-- <div class=""> -->
                    <div class="list-group position-sticky sticky-top filter-menu">
                    <input type="text" class="form-control list-group-item" id="usr" placeholder="Search Filter" />
                    <?php
                                // select id, category from categories
                                $getcat = $dbh->prepare("SELECT id, category from categories");
                                $getcat->execute();
                                while($getcatrow = $getcat->fetch()){
                                    $catid= $getcatrow['id'];
                                    $catname=$getcatrow['category'];
                                    // echo '<li><a class="categories" href="index.php?catid='. $catid . '">'.$catname .'</a>
                                    echo '<a class="categories list-group-item" href="#" 
                                    data-catid="'.$catid .'" onclick="return false">'.$catname .'</a>
                                    ';
                                }
                            ?>
                    </div>
                </div>
                <div class="col-lg-9  col-md-push-9">
                    <!-- Products Section -->
                    <div class="row" id="prods">
                                <?php include 'inc/showProducts.php';?>
                    </div>
                </div>

            </div>
            <!-- end products -->
                        <!-- beginning programms content -->
                        <!-- <php include 'inc/mainPageProgramms.php';> -->
            <!-- end programms content -->
            <!-- beginning app adverticement -->
            <div class="row justify-content-center app-container">
                <div class="col-md-12 app-container-right">
                    <div class="app-container-text-block">
                        <p><span> Get Motivated</span> <span>read athletes stories</span></p>
                        
                    </div>
                </div>
            </div>
            <!-- end app adverticement -->

            <!-- beginning blog -->
            <div class="row blog-container">
                <div class="col-md-3 blog">
                    <div class="blog-image">
                    </div>
                    <div class="blog-text"></div>
                </div>
                <div class="col-md-3 blog">
                    <div class="blog-image"></div>
                    <div class="blog-text"></div>
                </div>
                <div class="col-md-3 blog">
                    <div class="blog-image"></div>
                    <div class="blog-text"></div>
                </div>
                <div class="col-md-3 blog">
                    <div class="blog-image"></div>
                    <div class="blog-text"></div>
                </div>
            </div>
            <!-- end blog -->
            <!-- beginning contact information  -->
            <div class="row">
                <div class="col-md-4 contact">
                    <div class="contact-item contact-money-back">
                        <div class="money-back-header">
                            <i class="fas fa-money-bill-alt"></i>
                            <span> Money back Guarantee</span>
                        </div>
                        <div class="money-back-body">
                            <span>
                  <i class="fas fa-question-circle"></i>
                  <span>Details</span>
                            </span>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 contact">
                    <div class="contact-item contact-military">
                        <span>Military Discounts</span>
                    </div>
                </div>
                <div class="col-md-4 contact">
                    <div class="contact-item contact-support">
                        <div class="phone-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="phone-number-container">Customer support 24/7
                        </div>
                    </div>
                </div>
                <div class="information row">
                    <div class="need-help col-md-4" style="display:flex; justify-content:center;">
                    <div style="text-align:left;">
                        <h4>NEED HELP?</h4>
                        <p>Help Center</p>
                        <p>Email Support</p>
                        <p>Live char</p>
                        <p>Gift Certificates</p>
                        <p>Send Us Feedback</p>
                        </div>
                    </div>
                    <div class="orders col-md-4" style="display:flex; justify-content:center;">
                    <div style="text-align:left;">
                        <h4>ORDERS </h4>
                        <p>Order status</p>
                        <p>Return/Exchanges</p>
                        <p>Shipping Support</p>
                        </div>
                    </div>
                    <div class="connect col-md-4" style="display:flex; justify-content:center;">
                    <div style="text-align:left;">
                        <h4>CONNECT WITH US</h4>
                        <p><i class="fab fa-facebook-square social-media"></i>
                            <i class="fab fa-youtube social-media"></i>
                            <i class="fab fa-twitter-square social-media"></i>
                            <i class="fab fa-instagram-square social-media"></i>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end contact information  -->
        </div>
        <!-- include footer -->
        <?php include 'inc/footer.php'; ?>
    </body>

    </html>