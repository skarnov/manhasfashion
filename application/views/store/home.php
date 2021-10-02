<!--Slider-->
<div class="banner-w3">
    <div class="demo-1">            
        <div id="example1" class="core-slider core-slider__carousel example_1">
            <div class="core-slider_viewport">
                <div class="core-slider_list">
                    <?php foreach ($all_sliders as $v_slider): ?>
                        <div class="core-slider_item">
                            <img src="<?php echo base_url() . 'media_library/images/slider_images/' . $v_slider->setting; ?>" class="img-responsive" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="core-slider_nav">
                <div class="core-slider_arrow core-slider_arrow__right"></div>
                <div class="core-slider_arrow core-slider_arrow__left"></div>
            </div>
            <div class="core-slider_control-nav"></div>
        </div>
    </div>
    <link href="<?php echo base_url(); ?>assets/frontend/css/coreSlider.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/frontend/js/coreSlider.js"></script>
    <script>
        $('#example1').coreSlider({
            pauseOnHover: false,
            interval: 3000,
            controlNavEnabled: true
        });
    </script>
</div>	
<!--End of Slider-->
<div class="content">
    <!--Banner-Bottom-->
    <div class="ban-bottom-w3l">
        <div class="container">
            <?php
            foreach ($all_banners as $v_banner) {

                if ($v_banner->setting_position == 'Right Big') {
                    ?>
                    <div class="col-md-6 ban-bottom">
                        <div class="ban-top">
                            <img src="<?php echo base_url() . 'media_library/images/banner_images/' . $v_banner->setting; ?>" class="img-responsive" alt=""/>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="col-md-6 ban-bottom3">
                <?php
                foreach ($all_banners as $v_banner) {

                    if ($v_banner->setting_position == 'Left Medium') {
                        ?>
                        <div class="ban-top">
                            <img src="<?php echo base_url() . 'media_library/images/banner_images/' . $v_banner->setting; ?>" class="img-responsive" alt=""/>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="ban-img">
                    <?php
                    foreach ($all_banners as $v_banner) {

                        if ($v_banner->setting_position == 'Left Small Right') {
                            ?>
                            <div class=" ban-bottom1">
                                <div class="ban-top">
                                    <img src="<?php echo base_url() . 'media_library/images/banner_images/' . $v_banner->setting; ?>" class="img-responsive" alt=""/>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    foreach ($all_banners as $v_banner) {

                        if ($v_banner->setting_position == 'Left Small Left') {
                            ?>
                            <div class="ban-bottom2">
                                <div class="ban-top">
                                    <img src="<?php echo base_url() . 'media_library/images/banner_images/' . $v_banner->setting; ?>" class="img-responsive" alt=""/>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--End of Banner Bottom-->
    <!--New Arrivals-->
    <div class="new-arrivals-w3agile">
        <div class="container">
            <h2 class="tittle">New Arrivals</h2>
            <div class="arrivals-grids">
                <?php foreach ($new_arrivals as $v_product): ?>
                    <div class="col-md-3 arrival-grid simpleCart_shelfItem">
                        <div class="grid-arr">
                            <div  class="grid-arrival">
                                <figure>		
                                    <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal">
                                        <div class="grid-img">
                                            <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product['product_image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_product['product_name']; ?>">
                                        </div>
                                        <div class="grid-img">
                                            <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product['product_image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_product['product_name']; ?>">
                                        </div>			
                                    </a>		
                                </figure>	
                            </div>
                            <div class="women">
                                <h6><a href="<?php echo base_url(); ?>store/product_details/<?php echo $v_product['pk_product_id']; ?>"><?php echo $v_product['product_name']; ?></a></h6>
                                <span class="size"><?php echo $v_product['meta']['sizes']; ?></span>
<!--                                <p><del><?php echo $v_product['product_old_price']; ?></del> <em class="item_price"><?php echo $v_product['product_price']; ?></em></p>-->
<!--                                <button type="button" onclick="addToCart(<?php echo $v_product['pk_product_id']; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
<!--                                    <button type="button" data-toggle="modal" data-target="#cartModal" onclick="addToCart(<?php echo $v_product['pk_product_id']; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--End of New Arrivals-->
    <!--Accessories-->
    <div class="accessories-w3l">
        <div class="container">
            <h3 class="tittle">20% Discount on</h3>
            <span>TRENDING DESIGNS</span>
            <div class="button">
                <a href="#" class="button1"> Shop Now</a>
            </div>
        </div>
    </div>
    <!--End of Accessories-->
    <!--Best Sellers-->
    <div class="new-arrivals-w3agile">
        <div class="container">
            <h3 class="tittle1">Best Sellers</h3>
            <div class="arrivals-grids">
                <?php foreach ($best_sellers as $v_product): ?>
                    <div class="col-md-3 arrival-grid simpleCart_shelfItem">
                        <div class="grid-arr">
                            <div class="grid-arrival">
                                <figure>		
                                    <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal">
                                        <div class="grid-img">
                                            <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product['product_image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_product['product_name']; ?>">
                                        </div>
                                        <div class="grid-img">
                                            <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product['product_image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_product['product_name']; ?>">
                                        </div>			
                                    </a>		
                                </figure>	
                            </div>
                            <div class="women">
                                <h6><a href="<?php echo base_url(); ?>store/product_details/<?php echo $v_product['pk_product_id']; ?>"><?php echo $v_product['product_name']; ?></a></h6>
                                <span class="size"><?php echo $v_product['meta']['sizes']; ?></span>
<!--                                <p><del><?php echo $v_product['product_old_price']; ?></del> <em class="item_price"><?php echo $v_product['product_price']; ?></em></p>-->
<!--                                <button type="button" onclick="addToCart(<?php echo $v_product['pk_product_id']; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
<!--                                    <button type="button" data-toggle="modal" data-target="#cartModal" onclick="addToCart(<?php echo $v_product['pk_product_id']; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--End of Best Sellers-->
</div>