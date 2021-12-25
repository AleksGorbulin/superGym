
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout example · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">
<?php include 'inc/head.php'; ?>

    <style>
       .containerCheckout {
         max-width: 960px;
         width: 100%;
         padding-right: 15px;
         padding-left: 15px;
         margin-right: auto;
         margin-left: auto;
        }

      .lh-condensed { line-height: 1.25; }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>



<div class="container">
<?php include 'inc/navbar.php'; ?>
  <?php
error_reporting(E_ALL);
ini_set('display_errors',1);
// Connect to DB
include 'inc/dbconnect.php';
// write a qry to get all the data we need.(name, prodid, item name, itemprice)
// echo "SELECT products.name, products.product_id, products.price, products.product_id,cartitems.qty 
// from products, cartitems
// where cartitems.productid = products.product_id and '$sessid' = cartitems.sessionid";
$getcart=$dbh->prepare("SELECT products.name,  products.product_id, products.desk, products.price, products.product_id,cartitems.qty 
from products, cartitems
where cartitems.productid = products.product_id and '$sessid' = cartitems.sessionid");
$getcart->execute();    
// $getcartrow= $getcart->fetch();
// $totalItemsInCart = count($getcartrow['products.product_id']);
/*array(9) { ["name"]=> string(17) "Platinum Creatine" [0]=> string(17) "Platinum Creatine" 
    ["product_id"]=> string(1) "1" [1]=> string(1) "1" ["price"]=> string(5) "29.99" 
    [2]=> string(5) "29.99" [3]=> string(1) "1" ["qty"]=> string(1) "1" [4]=> string(1) "1" }*/
    

?>
<div class="row mt-5 containerCheckout">
    <div class="col-md-4 order-md-2 mb-4">
    <form class="needs-validation" action="https://sandbox.paypal.com/us/cgi-bin/webscr" method="post" 
         target="paypal" >      
         <!-- name="_xclick" -->
<h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill"><?php echo $itemsInCart; ?></span>
      </h4>
      <ul class="list-group mb-3">
      <input type = "hidden" name = "cmd" value = "_cart" /> 
       <input type = "hidden" name = "business" value = "sb-fzhga1004374@business.example.com" /> 
       <?php
       //this is where will populate what is seen and what is not seen
       $total = 0;
       $itemSerialNumber=0;
       
       while($getcartrow= $getcart->fetch()){
           // var_dump($getcartrow);
        $itemSerialNumber ++;  
        $itemname= $getcartrow['name'];
        $itemnumber= $getcartrow['product_id'];
        $itemquantity = $getcartrow['qty'];
        $itemprice=$getcartrow['price'];
        $itemdesk= $getcartrow['desk'];
        $total+=$itemprice * $itemquantity;
           ?>

        <input type="hidden" name="upload" value="1"/>
        <input type="hidden" name="current_code" value="USD"/>
        <input type = "hidden" name = "item_name_<?php echo $itemSerialNumber; ?>" value = "<?php echo $itemname; ?>" />
        <!-- <input type="hidden" name="item_number_<php echo $itemSerialNumber; ?>" value="<php echo $itemnumber; ?>"/> -->
        <!-- <input type="hidden" name="productid" value="<php echo $itemnumber; ?>"/> -->
        <input type="hidden" name="amount_<?php echo $itemSerialNumber; ?>" value="<?php echo $itemprice; ?>">
        <input type="hidden" name="quantity_<?php echo $itemSerialNumber; ?>" value="<?php echo $itemquantity; ?>">
        <!-- <input type = "hidden" name = "shipping_<?php echo $itemSerialNumber; ?>" value = "SAN DIEGO" />     -->
        <!--  -->
        <!-- <input type = "hidden" name = "cmd" value = "" />
<input type = "hidden" name = "redirect_cmd" value = "_xclick" /> 
 <input type = "hidden" name = "cancel_return" value = "http://mm214.com/somethingcheaper.html" /> 
  <input type = "hidden" name = "return" value = "http://mm214.com/maincart.html" /> 
<input type = "hidden" name = "business" value = "ksecor@aii.edu" /> 
<input type = "hidden" name = "item_name" value = "Mr Microphone" />
<input type = "hidden" name = "amount" value = "13.99" />
<input type = "hidden" name = "item_number" value = "3" />
<input type = "hidden" name = "notify_url" value = "http://mm214.com/somethingcheaper.php" />
<input type = "image" name = "submit" src = "http://mm214.com/buttons/buynow.gif" /> -->
        <!--  -->

        <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><?php echo $itemname; ?></h6>
          <small class="text-muted"><?php echo $itemdesk; ?></small>
        </div>
        <span class="text-muted"><?php echo $itemquantity . ' @ $' .$itemprice; ?></span>
      </li>
      <?php
       }
       ?>
      
      
      

        
        <!--<li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>-->
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong><?php echo $total; ?></strong>
        </li>
      </ul>

      <!-- <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form> -->
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text"  name="last_name" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>



        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="address1" class="form-control" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="coutry" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="state" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="same-address">
          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="save-info">
          <label class="custom-control-label" for="save-info">Save this information for next time</label>
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">
              Security code required
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <!-- <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Continue to checkout"> -->
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
    </div>
  </div>












<!-- <form action="https://sandbox.paypal.com/us/cgi-bin/webscr" method="post" name="_xclick" target="paypal">
Shipping: <br>
First name
<input type="text" name="first_name" />
<br>
Last name
<input type="text" name="last_name" />
<br>
Address 
<textarea name="address1" id="" cols="30" rows="10"></textarea>
City
<input type="text" name="city" id="city"/>
<br>
State
<input type="text" name="state" id="state"/>
<br>
zip
<input type="text" name="zip" id="zip"/>
<br>
Same as Shipping
<input type="checkbox" name="ship" id="" onClick="sameship();" />
<br>
Billing:
First name
<input type="text" name="billfirst_name"/>
<br>
Last name
<input type="text" name="billlast_name"/>
<br>
Address 
<textarea type="text" name="billaddress1"></textarea>
<br>
<span id="citystate" style="display:none">City
<input type="text" name="billcity"/>
<br>
State
<input type="text" name="billstate" />
<br>
</span>
zip:
<input type="text" name="billzip" onblur="makeRequest('state');"/>
<br>
Email:
<input type="text" name="email"/>
<br>
Phone 
<input type="text" name="night_phone_a" />
<br>

<input type = "hidden" name = "cmd" value = "_cart" /> 
<input type = "hidden" name = "business" value = "sb-fzhga1004374@business.example.com" /> 
<input type="hidden" name="upload" value="1"/>
<input type="hidden" name="current_code" value="USD"/>
<input type = "hidden" name = "item_name_1" value = "<php echo $itemname; ?>" />
<input type="hidden" name="item_number_1" value="<php echo $itemnumber; ?>"/>
<input type="hidden" name="amount_1" value="<php echo $itemprice; ?>">
<input type="hidden" name="quantity_1" value="<php echo $itemquantity; ?>">
<input type = "hidden" name = "shipping_1" value = "" /> 
<input type="hidden" name="subtotal" name="subtotal" value="<php echo $itemprice; ?>">
<br> 
Subtotal:<php echo $itemprice; ?>
<input type = "submit" name = "submit" value="Check out"/>
</form> -->