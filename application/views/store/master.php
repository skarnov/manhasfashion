<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Manha's Fashion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php echo $this->session->userdata('keywords'); ?>" />
        <link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url(); ?>assets/frontend/css/font-awesome.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/frontend/js/jquery.min.js"></script>
        <link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>        

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/frontend/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/frontend/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/frontend/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url(); ?>assets/frontend/favicon/site.webmanifest">

        <script src="<?php echo base_url(); ?>assets/frontend/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/js/responsiveslides.min.js"></script>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>media_library/images/website/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>media_library/images/website/favicon.ico" type="image/x-icon">
        <!-- PRODUCT DETAILS PAGE-->
        <script src="<?php echo base_url(); ?>assets/frontend/js/imagezoom.js"></script>
        <script defer src="<?php echo base_url(); ?>assets/frontend/js/jquery.flexslider.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/flexslider.css" type="text/css" media="screen" />
        <script>
            // Can also be used with $(document).ready()
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
        <!--END OF PRODUCT DETAILS PAGE-->
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-3.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/js/jstarbox.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
        <script type="text/javascript">
            jQuery(function () {
                jQuery('.starbox').each(function () {
                    var starbox = jQuery(this);
                    starbox.starbox({
                        average: starbox.attr('data-start-value'),
                        changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
                        ghosting: starbox.hasClass('ghosting'),
                        autoUpdateAverage: starbox.hasClass('autoupdate'),
                        buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
                        stars: starbox.attr('data-star-count') || 5
                    }).bind('starbox-value-changed', function (event, value) {
                        if (starbox.hasClass('random')) {
                            var val = Math.random();
                            starbox.next().text(' ' + val);
                            return val;
                        }
                    })
                });
            });
        </script>
    </head>
    <?php
    $user_id = $this->session->userdata('user_id');
    $user_image = $this->session->userdata('user_image');
    $user_name = $this->session->userdata('user_name');
    ?>
    <body>
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <!--                    <div class="top-left">
                                            <a href="mailto:sales@eoutlet-bd.com"> <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
                                            <a><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +88 01751 407 068, <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +880 9638107153</a>
                                            <a href="<?php echo base_url(); ?>"> Help  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +88 01751 407 068</a>
                                            
                                            <a href="<?php echo base_url(); ?>store/shopping_cart">
                                                <h3> 
                                                    <div class="total" id="cartTotal">
                                                        <span class="simpleCart_total"></span> (<?php echo $this->cart->total_items(); ?> <span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
                                                    </div>
                                                    <img src="<?php echo base_url(); ?>assets/frontend/images/bag.png" alt="" />
                                                </h3>
                                            </a>
                                        </div>-->
                    <div class="top-right">
                        <!--                        <div class="">
                                                    <div id="cd-search" class="cd-search">
                                                        <form action="#" method="post">
                                                            <input name="Search" type="search" placeholder="Search...">
                                                        </form>
                                                    </div>	
                                                </div>-->
                        <ul>
                            <!--                            <li></li>
                                                        <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>-->
                            <!--                            <li><a href="<?php echo base_url(); ?>store/shopping_cart">Checkout</a></li>
                            <?php if ($user_id) { ?>
                                                                    <li><a href="<?php echo base_url(); ?>client/logout">Logout (<?php echo $user_name; ?>)</a></li>
                            <?php } else { ?>
                                                                    <li><a href="<?php echo base_url(); ?>checkout/login">Login</a></li>
                            <?php } ?>
                                                        <li><a href="<?php echo base_url(); ?>store/register"> Create Account </a></li>-->

                            <li><a href="<?php echo base_url(); ?>store/about"> About </a></li>
                            <li><a href="<?php echo base_url(); ?>store/contact"> Contact </a></li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="heder-bottom">
                <div class="container">
                    <div class="logo-nav">
                        <div class="logo-nav-left">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>media_library/images/website/logo.png" width="100"/></a>
                        </div>
                        <div class="logo-nav-left1">
                            <nav class="navbar navbar-default">
                                <!--                                <div class="navbar-header nav_2">
                                                                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                                                        <span class="sr-only">Toggle navigation</span>
                                                                        <span class="icon-bar"></span>
                                                                        <span class="icon-bar"></span>
                                                                        <span class="icon-bar"></span>
                                                                    </button>
                                                                </div> -->
                                <!--                                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">-->
                                <div class="" id="bs-megadropdown-tabs">
                                    <ul class="nav navbar-nav" style="margin-top: 20px;">

                                        <?php foreach ($all_categories->result() as $v_category) { ?>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $v_category->category_name; ?><b class="caret"></b></a>
                                                <ul class="dropdown-menu multi-column columns-3">
                                                    <div class="row">
                                                        <?php
                                                        foreach ($all_subcategories->result() as $v_subcategory) {
                                                            if ($v_subcategory->category_relation == $v_category->pk_category_id) {
                                                                ?>
                                                                <div class="col-sm-3 multi-gd-img">
                                                                    <ul class="multi-column-dropdown">
                                                                        <a href="<?php echo base_url(); ?>store/category/<?php echo $v_subcategory->pk_category_id; ?>"><h6><?php echo $v_subcategory->category_name; ?></h6></a>
                                                                        <?php
                                                                        foreach ($all_subcategory_items->result() as $v_item) {
                                                                            if ($v_item->category_relation == $v_subcategory->pk_category_id) {
                                                                                ?>
                                                                                <li><a href="<?php echo base_url(); ?>store/product_listing/<?php echo $v_item->pk_category_id; ?>"><?php echo $v_item->category_name; ?></a></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!--                        <div class="logo-nav-right">
                                                    <ul class="cd-header-buttons">
                                                        <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                                                    </ul>
                                                    <div id="cd-search" class="cd-search">
                                                        <form action="#" method="post">
                                                            <input name="Search" type="search" placeholder="Search...">
                                                        </form>
                                                    </div>	
                                                </div>-->
                        <!--                                                <div class="header-right2">
                                                                            <div class="cart box_1">
                                                                                <a href="<?php echo base_url(); ?>store/shopping_cart">
                                                                                    <h3> 
                                                                                        <div class="total" id="cartTotal">
                                                                                            <span class="simpleCart_total"></span> (<?php echo $this->cart->total_items(); ?> <span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
                                                                                        </div>
                                                                                        <img src="<?php echo base_url(); ?>assets/frontend/images/bag.png" alt="" />
                                                                                    </h3>
                                                                                </a>
                                                                                <div class="clearfix"> </div>
                                                                            </div>	
                                                                        </div>-->
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="col-md-12">
                <h2 style="color:red">
                    <?php echo $this->session->flashdata('success'); ?>
                </h2>
            </div>
        <?php endif; ?>
        <?php echo $home; ?>
        <!---Footer--->
        <div class="footer-w3l">
            <div class="container">
                <div class="footer-grids">
                    <div class="col-md-9 footer-grid">
                        <h4>About </h4>
                        <p class="text-justify">Manha's Fashion is an elegant last mile e-commerce solution which provides a platform to offer e-commerce & last-mile fulfillment to the customers. We present tremendous amount of baby & women products with all at incredible prices. We provide customers with a hassle-free and worry-free international shopping experience from buying to delivery. <a href="<?php echo base_url() ?>store/about" style="color:yellowgreen">Read More</a> </p>
                        <div class="text-center" style="margin-top: 20px;">
                            <img src="<?php echo base_url(); ?>media_library/images/website/logo.png" alt="Eoutlet-BD" style="height: 145px;">
                        </div>
                    </div>
                    <!--                    <div class="col-md-3 footer-grid">
                                            <h4>My Account</h4>
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>store/checkout">Checkout</a></li>
                                                <li><a href="<?php echo base_url(); ?>store/login">Login</a></li>
                                                <li><a href="<?php echo base_url(); ?>store/register"> Create Account </a></li>
                                            </ul>
                                        </div>-->
                    <div class="col-md-3 footer-grid foot">
                        <h4>Contacts</h4>
                        <ul>
                            <li>
                                <i class="fa fa-home"></i><p>95/B (5th Floor), Jomoj Road
                                    Joar Shahara
                                    Vatara, Dhaka-1229</p>
                            </li>
                            <li><i class="fa fa-facebook"></i><a href="https://www.facebook.com/Manhas-Fashion-501888590211921" target="_blank">Manha's Fasion</a></li>
<!--                            <li><i class="fa fa-envelope"></i><a href="mailto:sales.eoutletbd@gmail.com">sales.eoutletbd@gmail.com</a></li> 
                            <li><i class="fa fa-phone"></i><a href="tel:+88 01933447144">+88 01933447144</a></li>&nbsp;
                            <li><i class="fa fa-phone"></i><a href="tel:+88 09638813888">+88 09638813888</a></li>&nbsp;
                            <li><i class="fa fa-phone"></i><a href="tel:+88 01751407068">+88 01751407068</a></li>&nbsp;
                            <li><i class="fa fa-phone"></i><a href="tel:+88 09638107153">+88 09638107153</a></li>&nbsp;-->
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!---End of Footer--->
        <!--Copyright-->
        <div class="copy-section">
            <div class="container">
                <div class="copy-left">
                    <p>&copy; <?php echo date('Y'); ?> Manha's Fashion. All Rights Reserved.</p>
                </div>
                <!--                <div class="copy-right">
                                    <img src="<?php echo base_url(); ?>media_library/images/website/bkash.png" alt="" style="height: 31px; width: 64px;"/>
                                    <img src="<?php echo base_url(); ?>media_library/images/website/rocket.png" alt="" style="height: 31px; width: 64px;"/>
                                    <img src="<?php echo base_url(); ?>assets/frontend/images/card.png" alt=""/>
                                </div>-->
                <div class="clearfix"></div>
            </div>
        </div>
        <!--End of Copyright-->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-info">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
                    </div>
                    <div class="modal-body">
                        <div class="news-gr">
                            <div class="col-md-5 new-grid1">
                                <img src="<?php echo base_url(); ?>assets/frontend/images/p5.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="col-md-7 new-grid">
                                <h5>Ten Women's Cotton Viscose fabric Grey Shrug</h5>
                                <h6>Quick Overview</h6>
                                <span>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                                <div class="color-quality">
                                    <div class="color-quality-left">
                                        <h6>Color : </h6>
                                        <ul>
                                            <li><a href="#"><span></span>Red</a></li>
                                            <li><a href="#" class="brown"><span></span>Yellow</a></li>
                                            <li><a href="#" class="purple"><span></span>Purple</a></li>
                                            <li><a href="#" class="gray"><span></span>Violet</a></li>
                                        </ul>
                                    </div>
                                    <div class="color-quality-right">
                                        <h6>Quality :</h6>
                                        <div class="quantity"> 
                                            <div class="quantity-select">                           
                                                <div class="entry value-minus1">&nbsp;</div>
                                                <div class="entry value1"><span>1</span></div>
                                                <div class="entry value-plus1 active">&nbsp;</div>
                                            </div>
                                        </div>
                                        <!--quantity-->
                                        <script>
                                            $('.value-plus1').on('click', function () {
                                                var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) + 1;
                                                divUpd.text(newVal);
                                            });

                                            $('.value-minus1').on('click', function () {
                                                var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) - 1;
                                                if (newVal >= 1)
                                                    divUpd.text(newVal);
                                            });
                                        </script>
                                        <!--quantity-->
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="women">
                                    <span class="size">XL / XXL / S </span>
                                    <p ><del>$100.00</del><em class="item_price"> $70.00 </em></p>
                                    <div class="add">
                                        <button class="btn btn-danger my-cart-btn my-cart-b" data-id="3" data-name="Kabuli Chana" data-summary="summary 3" data-price="2.00" data-quantity="1" data-image="images/of2.png">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Success-->
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-w3agile">
                            <h3>Shopping Cart</h3>

                            <div class="alert alert-success">
                                <p>Success! Please go to <a href="<?php echo base_url() ?>store/shopping_cart">Checkout</a> Page</p>
                            </div>
                            <?php if ($contents = $this->cart->contents()) : ?>
                                <!--                                <form action="#" method="post">
                                                                    <div class="bs-docs-example">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th></th>
                                                                                    <th>Name</th>
                                                                                    <th>QTY</th>
                                                                                    <th>Unit Price</th>
                                                                                    <th>Total Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                <?php
                                foreach ($contents as $v_contents) {
                                    ?>
                                                                                                <tr>
                                                                                                    <td><img src="<?php echo base_url(); ?>media_library/images/product_images/<?php echo $v_contents['image']; ?>" height="50" width="50"</td>
                                                                                                    <td><?php echo $v_contents['name']; ?></td>
                                                                                                    <td class="text-right">
                                                                                                        <form action="<?php echo base_url(); ?>sale/update_cart" method="POST">
                                                                                                            <input type="hidden" value="<?php echo $v_contents['rowid']; ?>" name="rowid"/>
                                                                                                            <input type="text" name="product_quantity" value="<?php echo $v_contents['qty']; ?>" class="btn btn-outline-info form-group productQuantity" title="Write Your Desire Quantity">
                                                                                                            <button type="submit" class="btn btn-info form-group" title="Update"><i class="fa fa-refresh"></i></button>
                                                                                                        </form>
                                                                                                    </td>
                                                                                                    <td>&euro; <?php echo $v_contents['price']; ?></td>
                                                                                                    <td>&euro; <?php echo $v_contents['subtotal']; ?></td>
                                                                                                    <td><a href="<?php echo base_url(); ?>sale/remove/<?php echo $v_contents['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a></td>
                                                                                                </tr>
                                    <?php
                                }
                                ?>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td><strong>Total</strong></td>
                                                                                    <td class="text-right"><strong class="text-danger">&euro; <span id="grandTotal"><?php echo $this->cart->total(); ?></span></strong></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </form>-->
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" type="button" class="btn btn-primary">Continue Shopping</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Cart Success-->
        <script>
            function addToCart(productId)
            {
                if (productId !== 'null')
                {
                    $.ajax({
                        type: "GET",
                        url: '<?php echo base_url(); ?>store/add_to_cart/' + productId,
                        success: function (data) {
                            $("#cartTotal").html(data);
                        }
                    });
                }
            }

            function productSearch(searchText)
            {
                if (searchText !== 'null')
                {
                    $.ajax({
                        type: "GET",
                        url: '<?php echo base_url(); ?>salesman/product_search/' + searchText,
                        success: function (data) {
                            $("#productSearch").html(data);
                        }
                    });
                }
            }

            function productDetails(productId)
            {
                if (productId !== 'null')
                {
                    $.ajax({
                        type: "GET",
                        url: '<?php echo base_url(); ?>salesman/product_details/' + productId,
                        success: function (data) {
                            $("#productDetails").html(data);
                        }
                    });
                }
            }

            function calculateVat()
            {
                var total = '<?php echo $this->cart->total(); ?>';
                var vat = $('#vat').val();
                var vatAmount = (parseInt(total) * (parseInt(vat) / 100)) + parseInt(total);
                $("#grandTotal").html(vatAmount);
                $('#totalVat').val($('#vat').val());
            }

            function findCustomer() {
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>sale/customer_data",
                    data: $("#findCustomer").serialize(),
                    type: "POST",
                    success: function (data) {
                        $("#customerData").html(data);
                        $('#totalVat').val($('#vat').val());
                    }
                });
            }
        </script>
    </body>
</html>