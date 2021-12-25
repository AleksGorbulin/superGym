<?php 
//get action string
$action = isset($_GET['action'])?$_GET['action']:"";
$currentpage= $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

//Add to cart
if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {

	//Finding the product by code
	$query = "SELECT * FROM products WHERE sku=:sku";
	$stmt = $dbh->prepare($query);
	$stmt->bindParam('sku', $_POST['sku']);
	$stmt->execute();
	$product = $stmt->fetch();
    
    $productid = $product['product_id'];
    //check the cartitem table to see if sku is in there
$chkquery="SELECT * FROM cartitems WHERE productid ='$productid' and sessionid = '$sessid'"; 
$chkstmt=$dbh->prepare($chkquery); 
$chkstmt->execute(); 
$productincart = $chkstmt->fetch(); 
$id = $productincart['id']; 
$qty = $productincart['qty'] + 1 ;   
if(!empty($id)){ 
    // item in the cart
        // echo 'item in the cart qty= ' .$qty; 
        $upstmt = $dbh->prepare("UPDATE cartitems set qty= '$qty' where productid = '$productid' and 
        sessionid = '$sessid'");
        $upstmt->execute();
     }else{ 
        //  item not in cart
        $qty=1;
         $instmt= $dbh->prepare("INSERT into cartitems(productid,sessionid,
         timeofentry,qty) values('$productid', '$sessid', now(), $qty )");
         $instmt->execute();

          }
    // if it is, we'll write an update statement
    //else write an insert statement
    
    
	$currentQty = $_SESSION['products'][$_POST['sku']]['qty']+1; //Incrementing the product qty in cart
    // echo 'total in cart '. $currentQty;
	$_SESSION['products'][$_POST['sku']] =array('qty'=>$currentQty,'name   '=>$product['name'],'image'=>$product['image'],'price'=>$product['price']);
    $product='';
	// header("Location:". $currentpage);
}

//Empty All
if($action=='emptyall') {
	$_SESSION['products'] =array();
	// header("Location:". $currentpage);
}

//Empty one by one
if($action=='empty') {
	$sku = $_GET['sku'];
    $products = $_SESSION['products'];
    $deleteitem= $dbh->prepare("delete from cartitems where productid = '$sku' and sessionid = '$sessid'");
    $deleteitem->execute();
	unset($products[$sku]);
	$_SESSION['products']= $products;
	// header("Location:" . $currentpage);
}

?>