<div class="row propgramms mt-5">
                <div class="col-md-12 programms-header mb-3 mt-3 ">
                    <h2> Fitness programms</h2></div>
               

                    <div class="col-lg-4 col-md-6 md-4  mb-3">
                    <a href="product.php?pid=10"class="fitness-card-link">    
                    <div class="card h-100 fitness-program yoga">
                            <div class="card-body-fitness">
                                    <h4 class="card-title">
                                        <?php echo 'Yoga'; ?>
                                    </h4>
                                    <h5>
                                       <span class="mr-1 oldPrice">
                                            <del>$<?php echo round(10 *1.7 , 2); ?></del>
                                        </span>
                                        $<?php echo '10/month'; ?>
                                    </h5>
                                    <p class="card-text"><?php echo 'Deepen your practice through traditional yoga flow.'; ?></p>
                            </div>

                    </div>
                </a>
                </div>
                <div class="col-lg-4 col-md-6 md-4 mb-3">
                        <div class="card h-100 fitness-program bodybuilder">
                            <a href="product.php?pid=9"class="productImage pt-3">
                                <!-- <img src="<php echo 'image/bodybuilder.jpg'; ?>" alt=""> -->
                            </a>
                            <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php echo 'product.php?pid=' .$product['product_id'];?>"><?php echo 'Bodybuilding'; ?></a>
                                    </h4>
                                    <h5>
                                       <span class="mr-1 oldPrice">
                                            <del>$<?php echo round(20 *1.7 , 2); ?></del>
                                        </span>
                                        $<?php echo '20/month'; ?>
                                    </h5>
                                    <p class="card-text"><?php echo 'Challenge yourself with targeted workouts for your arms, core'; ?></p>
                            </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 md-4 mb-3">
                        <div class="card h-100 fitness-program">
                            <a href="product.php?pid=8"class="productImage pt-3">
                                <img src="<?php echo 'image/cycling.jpg'; ?>" alt="">
                            </a>
                            <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php echo 'product.php?pid=' .$product['product_id'];?>"><?php echo 'Lose weight'; ?></a>
                                    </h4>
                                    <h5>
                                       <span class="mr-1 oldPrice">
                                            <del>$<?php echo round(25 *1.7 , 2); ?></del>
                                        </span>
                                        $<?php echo '25/month'; ?>
                                    </h5>
                                    <p class="card-text"><?php echo 'Build your full body endurance with high-intensity draining drills.'; ?></p>
                            </div>

                    </div>
                </div>


            </div>