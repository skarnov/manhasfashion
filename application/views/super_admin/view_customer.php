<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">                    
                    <a href="<?php echo base_url(); ?>super_admin/add_customer" class="btn btn-info">Add New Customer</a>
                    <a href="<?php echo base_url(); ?>super_admin/manage_customers" class="btn btn-success">Manage Customers</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo $customer_info->user_fullname; ?>'s Profile</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="x_content">
                                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                    <div class="profile_img">
                                        <div id="crop-avatar">
                                            <?php if ($customer_info->user_image == NULL) { ?>
                                                <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>media_library/images/default_images/customer.png"/>
                                            <?php } else { ?>
                                                <img class="img-responsive avatar-view" src="<?php echo base_url() . 'media_library/images/user_images/' . $customer_info->user_image; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <br/>
                                    <ul class="list-unstyled user_data">
                                        <li><span class="glyphicon glyphicon-phone"></span> <?php echo isset($customer_info->user_mobile) ? $customer_info->user_mobile : 'N/A'; ?></li>
                                        <li><span class="glyphicon glyphicon-map-marker"></span> <?php echo isset($customer_info->user_address) ? $customer_info->user_address : 'N/A'; ?></li>
                                    </ul>
                                    <a href="<?php echo base_url(); ?>super_admin/edit_customer/<?php echo $customer_info->pk_user_id; ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Update Profile</a>
                                    <br />
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="col-md-12">
                                        <h4 class="x_title">Personal Information</h4>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled profile_details">
                                                <li><strong>Full Name:</strong> <?php echo isset($customer_info->user_fullname) ? $customer_info->user_fullname : 'N/A'; ?></li>
                                                <li><strong>Email:</strong> <?php echo isset($customer_info->user_email) ? $customer_info->user_email : 'N/A'; ?></li>
                                                <li><strong>NIF Number:</strong> <?php echo isset($customer_info->user_nif_number) ? $customer_info->user_nif_number : 'N/A'; ?></li>
                                            </ul>
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
</div>
<!-- End of Page Content -->