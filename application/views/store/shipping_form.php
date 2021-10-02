<!--Main Content-->
<div class="content">
    <div class="cart">
        <div class="shipping-form">
            <div class="form-w3agile">
                <form action="<?php echo base_url(); ?>client/save_shipping_info" method="POST" data-toggle="validator" role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Delivery Address</h3>
                            <label class="control-label">Full Name <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" name="delivery_name" required value="<?php echo $customer_info->row()->user_fullname; ?>" data-error="Please Enter Full Name">
                                <div class="help-block with-errors text-danger"><?php echo form_error('delivery_name'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Email</label>
                            <div class="key">
                                <input type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="delivery_email" value="<?php echo $customer_info->row()->user_email; ?>" data-pattern-error="Please Enter Valid Email Address">
                                <div class="help-block with-errors text-danger"><?php echo form_error('delivery_email'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Mobile <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" pattern= "[0-9]{11}" name="delivery_mobile" value="0<?php echo $customer_info->row()->user_mobile; ?>" data-pattern-error="Please Enter Valid Mobile Number">
                                <div class="help-block with-errors text-danger"><?php echo form_error('delivery_mobile'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Delivery Address <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" name="delivery_address" required value="<?php echo $customer_info->row()->user_address; ?>" class="form-control">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h3>Billing Address</h3>
                            <label class="control-label">Full Name <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" name="billing_name" required value="<?php echo $customer_info->row()->user_fullname; ?>" data-error="Please Enter Full Name">
                                <div class="help-block with-errors text-danger"><?php echo form_error('billing_name'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Email</label>
                            <div class="key">
                                <input type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="billing_email" value="<?php echo $customer_info->row()->user_email; ?>" data-pattern-error="Please Enter Valid Email Address">
                                <div class="help-block with-errors text-danger"><?php echo form_error('billing_email'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Mobile <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" pattern= "[0-9]{11}" name="billing_mobile" value="0<?php echo $customer_info->row()->user_mobile; ?>" data-pattern-error="Please Enter Valid Mobile Number">
                                <div class="help-block with-errors text-danger"><?php echo form_error('billing_mobile'); ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <label class="control-label">Billing Address <span class="text-danger">*</span></label>
                            <div class="key">
                                <input type="text" name="billing_address" required value="<?php echo $customer_info->row()->user_address; ?>" class="form-control">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="help-block with-errors text-danger">You can change the Information</div>
                    <input type="submit" value="Done">
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of Main Content-->