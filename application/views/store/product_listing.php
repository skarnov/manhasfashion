<!--Banner-->
<div class="banner1">
    <div class="container">
        <h3><a href="index.html">Home</a> / <span>Products</span></h3>
    </div>
</div>
<!--End of Banner-->
<!--Content-->
<div class="content">
    <div class="products-agileinfo">
        <h2 class="tittle"><?php echo $category_name->category_name; ?></h2>
        <div class="container">
            <div class="product-agileinfo-grids w3l">
                <div class="col-md-3 product-agileinfo-grid">
                    <div class="categories">
                        <h3>Categories</h3>
                        <ul class="tree-list-pad">
                            <?php foreach ($all_subcategory_items->result() as $v_item): ?>
                            <li>
                                <label onclick="window.location = '<?php echo base_url(); ?>store/product_listing/<?php echo $v_item->pk_category_id; ?>';"><?php echo $v_item->category_name; ?></label>
                            </li>
                             <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="cat-img">
                        <img class="img-responsive " src="images/45.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-9 product-agileinfon-grid1 w3l">
                    <div class="product-agileinfon-top">
                        <div class="col-md-6 product-agileinfon-top-left">
                            <img class="img-responsive " src="images/img1.jpg" alt="">
                        </div>
                        <div class="col-md-6 product-agileinfon-top-left">
                            <img class="img-responsive " src="images/img2.jpg" alt="">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="product-tab">
                                    <?php foreach ($product_listing as $v_product): ?>
                                        <div class="col-md-3 arrival-grid simpleCart_shelfItem">
                                            <div class="grid-arr">
                                                <div  class="grid-arrival">
                                                    <figure>		
                                                        <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal">
                                                            <div class="grid-img">
                                                                <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product->product_image_thumb; ?>" class="img-responsive" alt="<?php echo $v_product->product_name; ?>">
                                                            </div>
                                                            <div class="grid-img">
                                                                <img src="<?php echo base_url() . 'media_library/images/product_images/' . $v_product->product_image_thumb; ?>" class="img-responsive" alt="<?php echo $v_product->product_name; ?>">
                                                            </div>			
                                                        </a>		
                                                    </figure>	
                                                </div>
                                                <div class="women">
                                                    <h6><a href="<?php echo base_url(); ?>store/product_details/<?php echo $v_product->pk_product_id; ?>"><?php echo $v_product->product_name; ?></a></h6>
<!--                                                    <p><del><?php echo $v_product->product_old_price; ?></del> <em class="item_price"><?php echo $v_product->product_price; ?></em></p>-->
<!--                                                    <button type="button" onclick="addToCart(<?php echo $v_product->pk_product_id; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
<!--                                                    <button type="button" data-toggle="modal" data-target="#cartModal" onclick="addToCart(<?php echo $v_product->pk_product_id; ?>);" class="my-cart-b item_add">Add To Cart</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Content-->