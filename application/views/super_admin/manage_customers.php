<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>super_admin/add_customer" class="btn btn-info">Add New Customer</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Customers Management</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ($this->session->flashdata('update_customer')): ?>
                            <div class="alert success-message alert-dismissable fade in">
                                <?php echo $this->session->flashdata('update_customer'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-right">Mobile</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_customers as $v_customer): ?>
                                    <tr>
                                        <td>
                                            <?php if ($v_customer->user_image == NULL) { ?>
                                                <img src="<?php echo base_url(); ?>media_library/images/default_images/customer.png" class="img-rounded dataTableImage">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url() . 'media_library/images/user_images/' . $v_customer->user_image; ?>" class="img-rounded dataTableImage">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $v_customer->user_fullname; ?></td>
                                        <td><?php echo $v_customer->user_email; ?></td>
                                        <td class="text-right"><?php echo $v_customer->user_mobile; ?></td>
                                        <td>
                                            <?php
                                            if ($v_customer->user_status == 1) {
                                                ?>
                                                <span class="label label-success">Active</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="label label-danger">Inactive</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropup">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                    Perform Actions
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                    if ($v_customer->user_status == '1') {
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>super_admin/inactivate_customer/<?php echo $v_customer->pk_user_id; ?>"><i class="fa fa-times"></i> Inactivate</a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>super_admin/activate_customer/<?php echo $v_customer->pk_user_id; ?>"><i class="fa fa-check"></i> Activate</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a href="<?php echo base_url(); ?>super_admin/view_customer/<?php echo $v_customer->pk_user_id; ?>"><i class="fa fa-eye"></i> View</a></li>
                                                    <li><a href="<?php echo base_url(); ?>super_admin/edit_customer/<?php echo $v_customer->pk_user_id; ?>"><i class="fa fa-pencil"></i> Edit</a></li>
                                                    <li><a href="<?php echo base_url(); ?>super_admin/delete_customer/<?php echo $v_customer->pk_user_id; ?>" onclick="return check_delete();"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->