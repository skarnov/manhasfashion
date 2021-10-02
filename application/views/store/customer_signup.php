<!--Main Content-->
<div class="content">
    <!--Register-->
    <div class="cart">
        <div class="cart-area">
            <div class="form-w3agile">
                <h3>Create Account</h3>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('save_customer')): ?>
                    <hr/>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('save_customer'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url(); ?>store/save_customer" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label">Full Name <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" name="name" required value="<?php echo set_value('name'); ?>" data-error="Please Enter Your Full Name">
                                <div class="help-block with-errors text-danger"><?php echo form_error('name'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <div class="help-block with-errors text-danger"><?php echo form_error('email'); ?></div>
                            <div class="key">
                                <input type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required value="<?php echo set_value('email'); ?>" data-error="Please Enter Your Email Address" data-pattern-error="Please Enter Valid Email Address">
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Profile Picture</label>
                            <div class="key">
                                <input type="file" name="profile_picture" style="height: 25px; padding: 1px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Mobile <span class="text-danger">*</span></label>
                            <div class="help-block with-errors text-danger"><?php echo form_error('mobile'); ?></div>
                            <div class="key">
                                <input type="text" pattern= "[0-9]{11}" name="mobile" value="<?php echo set_value('mobile'); ?>" data-pattern-error="Please Enter Valid Mobile Number">
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Password <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="password" name="password" required class="form-control">
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Present Address</label>
                            <div class="key">
                                <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control">
                                <div class="clearfix"></div>
                            </div>     
                        </div>
                    </div>
                    <input type="submit" value="Done">
                </form>
            </div>
        </div>
    </div>
    <!--End of Register-->
</div>
<!--End of Main Content-->