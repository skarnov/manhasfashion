<!--Banner-->
<div class="banner1">
    <div class="container">
        <h3><a href="<?php echo base_url(); ?>">Home</a> / <span><?php echo $product_details['product_name']; ?></span></h3>
    </div>
</div>
<!--Banner-->
<div class="content">
    <!--Single-->
    <div class="single-wl3">
        <div class="container">
            <div class="single-grids">
                <div class="col-md-9 single-grid">
                    <div clas="single-top">
                        <div class="single-left">
                            <div class="flexslider">
                                <ul class="slides">
                                    <li data-thumb="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['product_image']; ?>">
                                        <div class="thumb-image"> <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['product_image']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                    </li>
                                    <?php if (isset($product_details['meta']['product_image_2'])) { ?>
                                        <li data-thumb="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_2']; ?>">
                                            <div class="thumb-image"> <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_2']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                        </li>
                                    <?php } ?>
                                    <?php if (isset($product_details['meta']['product_image_3'])) { ?>
                                        <li data-thumb="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_3']; ?>">
                                            <div class="thumb-image"> <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_3']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                        </li> 
                                    <?php } ?>
                                    <?php if (isset($product_details['meta']['product_image_4'])) { ?>
                                        <li data-thumb="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_4']; ?>">
                                            <div class="thumb-image"> <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_4']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                        </li> 
                                    <?php } ?>
                                    <?php if (isset($product_details['meta']['product_image_5'])) { ?>
                                        <li data-thumb="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_5']; ?>">
                                            <div class="thumb-image"> <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_details['meta']['product_image_5']; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                        </li> 
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="single-right simpleCart_shelfItem">
                            <h4><?php echo $product_details['product_name']; ?></h4>
<!--                            <p class="price item_price"><?php echo $product_details['product_price']; ?></p>-->
                            <div class="description">
                                <p><span>Description : </span> <?php echo isset($product_details['meta']['description']) ? $product_details['meta']['description'] : ''; ?></p>
                            </div>
<!--                            <div class="color-quality">
                                <h6>Quality :</h6>
                                <div class="quantity"> 
                                    <div class="quantity-select">                           
                                        <div class="entry value-minus1">&nbsp;</div>
                                        <div class="entry value1"><span>1</span></div>
                                        <div class="entry value-plus1 active">&nbsp;</div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="women">
                                <span class="size"><?php echo isset($product_details['meta']['sizes']) ? $product_details['meta']['sizes'] : ''; ?></span>
<!--                                <button type="button" onclick="addToCart(<?php echo $product_details['pk_product_id']; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
                            </div>
<!--                            <div class="social-icon">
                                <a href="#"><i class="icon"></i></a>
                                <a href="#"><i class="icon1"></i></a>
                                <a href="#"><i class="icon2"></i></a>
                            </div>-->
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <!--Product Description-->
        </div>
    </div>
    <!--Single-->
</div>