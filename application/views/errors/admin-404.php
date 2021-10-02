<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Not Found</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>assets/backend/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/backend/css/custom.css" rel="stylesheet">
    </head>
    <?php
    $admin_id = $this->session->userdata('admin_id');
    $admin_image = $this->session->userdata('admin_image');
    $admin_name = $this->session->userdata('admin_name');
    $notifications_number = $this->session->userdata('notifications_number');
    ?>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo base_url(); ?>super_admin" class="site_title"><i class="fa fa-shopping-basket"></i> <span>Evis Ecommerce</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Menu Profile Quick Info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <?php if ($admin_image == NULL) { ?>
                                    <img src="<?php echo base_url() . 'media_library/images/default_images/admin.png'; ?>" class="img-circle profile_img">
                                <?php } else { ?>
                                    <img src="<?php echo base_url() . 'media_library/images/admin_images' . $admin_image; ?>" class="img-circle profile_img">
                                <?php } ?>
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php echo $admin_name; ?></h2>
                            </div>
                        </div>
                        <!-- End of Menu Profile Quick Info -->
                        <br />
                        <!-- Sidebar Menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li class=""><a href="<?php echo base_url(); ?>super_admin/manage_admins"><i class="fa fa-user-secret"></i> Admins</a></li>
                                    <li class=""><a href="<?php echo base_url(); ?>super_admin/manage_customers"><i class="fa fa-cloud"></i> Customers</a></li>
                                    <li class=""><a href="<?php echo base_url(); ?>super_admin/manage_categories"><i class="fa fa-superscript"></i> Categories</a></li>
                                    <li class=""><a href="<?php echo base_url(); ?>super_admin/manage_products"><i class="fa fa-product-hunt"></i> Products</a></li>
                                    <li class=""><a href="<?php echo base_url(); ?>super_admin/manage_orders"><i class="fa fa-openid"></i> Orders</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End of Sidebar Menu -->
                        <!-- Menu Footer Buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a href="<?php echo base_url(); ?>super_admin/add_customer" data-toggle="tooltip" data-placement="top" title="Add New Customer">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </a>
                            <a href="<?php echo base_url(); ?>super_admin/add_product" data-toggle="tooltip" data-placement="top" title="Add New Product">
                                <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                            </a>
                            <a href="<?php echo base_url(); ?>super_admin/view_admin/<?php echo $admin_id; ?>" data-toggle="tooltip" data-placement="top" title="Profile">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a href="<?php echo base_url(); ?>super_admin/logout" data-toggle="tooltip" data-placement="top" title="Logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- End of Menu Footer Buttons -->
                    </div>
                </div>
                <!-- Top Navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <?php if ($admin_image == NULL) { ?>
                                            <img src="<?php echo base_url() . 'media_library/images/default_images/admin.png'; ?>">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() . 'media_library/images/admin_images' . $admin_image; ?>">
                                        <?php } ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="<?php echo base_url(); ?>super_admin/view_admin/<?php echo $admin_id; ?>"> Profile</a></li>
                                        <li><a href="<?php echo base_url(); ?>super_admin/logout"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-bell"></i>
                                        <?php
                                        if ($notifications_number) {
                                            ?>
                                            <span class="badge bg-red"><?php echo $notifications_number; ?></span>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <?php
                                        foreach ($this->session->userdata('notifications')->result() as $notification) {
                                            ?>
                                            <li>
                                                <a href="<?php echo base_url(); ?>super_admin/view_order/<?php echo $notification->notification; ?>">
    <!--                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                    <span>
                                                        <span>John Smith</span>
                                                        <span class="time">3 mins ago</span>
                                                    </span>-->
                                                    <span class="message">
                                                        <?php echo $notification->notification . '<br>at ' . $notification->created_at; ?>
                                                    </span>
                                                </a>
                                            </li>

                                            <?php
                                        }
                                        ?>
                                            <li>
                                                <div class="text-center">
                                                    <a href="<?php echo base_url(); ?>super_admin/manage_notifications">
                                                        <strong>See All Alerts</strong>
                                                        <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </div>
                                            </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End of Top Navigation -->
                <!-- Page Content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-middle">
                                                    <div class="text-center text-center">
                                                        <h1 class="error-number">404</h1>
                                                        <h2>Sorry but we couldn't find this page</h2>
                                                        <p>This page you are looking for does not exist</p>
                                                    </div>
                                                </div>
                                            </div>             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Page Content -->
                <!-- Footer Content -->
                <footer>
                    <div class="pull-right">
                        &copy; Evis Ecommerce <?php echo date('Y'); ?>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- End of Footer Content -->
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.min.js"></script>
        <!-- Bootstrap Validator -->
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrapValidator.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url(); ?>assets/backend/js/custom.js"></script>
        <script>
            function check_delete()
            {
                var chk = confirm('Are You Want To Delete This');
                if (chk)
                {
                    return true;
                } else
                {
                    return false;
                }
            }
            /* Image Upload */
            $(document).on('click', '.browse', function () {
                var file = $(this).parent().parent().parent().find('.file');
                file.trigger('click');
            });
            $(document).on('change', '.file', function () {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });

            function findSubcategories(Id) {
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>super_admin/ajax_subcategories/" + Id,
                    type: "POST",
                    success: function (data) {
                        $("#subcategories").html(data);
                    }
                });
            }

            function findSubcategoryItems(Id) {
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>super_admin/ajax_subcategory_items/" + Id,
                    type: "POST",
                    success: function (data) {
                        $("#subcategoryItems").html(data);
                    }
                });
            }
        </script>
    </body>
</html>