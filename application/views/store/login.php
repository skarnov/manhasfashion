<!--Main Content-->
<div class="content">
    <!--Login-->
    <div class="login">
        <div class="col-md-4">
            <h3>Login</h3>
            <?php if ($this->session->flashdata('exception')): ?>
                <hr>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('exception'); ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>checkout/check_client_login" method="POST">
                <label class="control-label" style="margin-top: 5%;">Email</label>
                <div class="key">
                    <input type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required value="<?php echo set_value('email'); ?>" data-error="Please Enter Your Email Address" data-pattern-error="Please Enter Valid Email Address">
                    <div class="help-block with-errors text-danger"></div>
                    <div class="clearfix"></div>
                </div>
                <label class="control-label">Password</label>
                <div class="key">
                    <input type="password" name="password" required data-error="Please Enter Your Password" class="form-control">
                    <div class="help-block with-errors text-danger"></div>
                    <div class="clearfix"></div>
                </div>
                <p>Don't you have an account? <a href="<?php echo base_url(); ?>store/register" style="font-weight:bolder; color: green;">Create One</a></p><br/>
                <input type="submit" class="btn btn-success" value="Login">
            </form>
        </div>
        <?php if ($this->cart->total_items()): ?>
            <div class="col-md-8">
                <h3>Shopping As Guest</h3>
                <form action="<?php echo base_url(); ?>checkout/save_customer_info" method="POST">
                    <label class="control-label" style="margin-top: 2.5%;">Name</label>
                    <div class="key">
                        <input type="text" name="name" required value="<?php echo set_value('name'); ?>" data-error="Please Enter Your Email Address">
                        <div class="help-block with-errors text-danger"></div>
                        <div class="clearfix"></div>
                    </div>
                    <label class="control-label">Mobile</label>
                    <div class="key">
                        <input type="text" pattern= "[0-9]{11}" name="mobile" required value="<?php echo set_value('mobile'); ?>" data-pattern-error="Please Enter 11 Digit Mobile Number" data-error="Please Enter Your Mobile Number">
                        <div class="help-block with-errors text-danger"><?php echo form_error('mobile'); ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <label class="control-label">Email</label>
                    <div class="key">
                        <input type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required value="<?php echo set_value('email'); ?>" data-error="Please Enter Your Email Address" data-pattern-error="Please Enter Valid Email Address">
                        <div class="help-block with-errors text-danger"><?php echo form_error('email'); ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" class="btn btn-info" value="Done">
                </form>
            </div>
        <?php endif; ?>
    </div>
    <!--End of Login-->
</div>
<!--End of Main Content-->