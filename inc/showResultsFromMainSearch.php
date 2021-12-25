<?php foreach($products as $product):?>
    <li><a href="<?php echo 'product.php?pid=' .$product['product_id'];?>"><?php echo $product['name'];?></a></li>
                        
                            <?php endforeach;?>