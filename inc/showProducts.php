                        <?php foreach($products as $product):?>
                            <div class="col-lg-4 col-md-6 md-4 mb-3 item-container">
                            <div class="card">
                                <a href="<?php echo 'product.php?pid=' .$product['product_id'];?>"class="productImage pt-3"><img src="<?php echo $product['image']; ?>" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php echo 'product.php?pid=' .$product['product_id'];?>"><?php echo strlen($product['name'])>22? $product['name']= substr($product['name'],0,17).'...':$product['name'];?></a>
                                    </h4>
                                    <p class="price">
                                       <span class="mr-1">
                                            <del>$<?php echo round($product['price']*1.7 , 2); ?></del>
                                        </span>
                                        $<?php echo $product['price'] ?>
                                    </p>
                                    <div>
                                    <?php 
                                    $pid=$product['product_id'];
                                    echo '<span class="review-stars" id="response' .$pid.'">';
                                    $avg = $dbh->prepare("select avg(rating) as average from rating where productid= '$pid'");
                                    $avg->execute();
                                    $avgrow=$avg->fetchObject();
                                    $score = $avgrow->average;
                                    for($i=1; $i<=5; $i++){
                                        if($i<=ceil($score)){ 
                                            echo '<i class="fas fa-star full-star"  onclick="sendRequest(\''.$pid.'\',\''.$i.'\');"></i>'; 
                                        }else{
                                            echo '<i class="fas fa-star empty-star"  onclick="sendRequest(\''.$pid.'\',\''.$i.'\');"></i>';
                                        }
                                    }
                                    ?> 
                                    </div>
                                </div>
                                <div class="item-buttons">


<!-- buy now form/button -->
                         <form action = "https://www.sandbox.paypal.com/us/cgi-bin/webscr" method = "post" target = "paypal">
                         <input type = "hidden" name = "cmd" value = "_ext-enter" />
                         <input type = "hidden" name = "redirect_cmd" value = "_xclick" /> 
                         <input type = "hidden" name = "cancel_return" value = "http://mm214.com/somethingcheaper.html" /> 
                         <input type = "hidden" name = "return" value = "http://mm214.com/maincart.html" /> 
                         <input type = "hidden" name = "business" value = "sb-fzhga1004374@business.example.com" /> 
                         <input type = "hidden" name = "item_name" value = "<?php print $product['name']?>" />
                         <input type = "hidden" name = "amount" value = "<?php print $product['price']?>" />
                         <input type = "hidden" name = "item_number" value = "3" />
                         <input type = "hidden" name = "notify_url" value = "sb-fzhga1004374@business.example.com" />
                            
                         <button type = "submit" name = "submit" class="btn btn-outline-danger" >Buy now</button>
                         
                         </form>
                         <form method="post" action="index.php?action=addcart">
                             <p style="text-align:center;color:#04B745;">
                             <button class="btn btn-secondary btn-md my-0 p" type="submit">Add to cart
                                 <i class="fas fa-shopping-cart ml-1"></i>
                             </button>
                                 <input type="hidden" name="sku" value="<?php print $product['sku']?>">
                             </p>
                         </form>
                     </div>
                                <!-- <div class="card-footer">

                                </div> -->
                            </div>
                                </div>

                           
                            <?php endforeach;?>