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
                        <h2>Add New Customer</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <?php if ($this->session->flashdata('save_customer')): ?>
                                    <div class="alert success-message alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $this->session->flashdata('save_customer'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form action="<?php echo base_url(); ?>super_admin/save_customer" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="col-md-6">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Full Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" required value="<?php echo set_value('name'); ?>" data-error="Please Enter Your Full Name" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Profile Picture</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="profile_picture" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Profile Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('email'); ?>
                                            <input type="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required value="<?php echo set_value('email'); ?>" data-pattern-error="Please Enter Valid Email Address" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Mobile</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('mobile'); ?>
                                            <input type="text" pattern= "[0-9]{11}" name="mobile" required value="<?php echo set_value('mobile'); ?>" data-pattern-error="Please Enter 11 Digit Mobile Number" data-error="Please Enter Your Mobile Number" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Password</label>
                                        <div class="col-md-9">
                                            <input type="text" name="password" required value="<?php echo set_value('password'); ?>" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Present Address</label>
                                        <div class="col-md-9">
                                            <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <div class="control-label pull-right">
                                            <button id="send" type="submit" class="btn btn-dark">Save Customer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->