<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/backend/css/custom.css" rel="stylesheet">
    </head>
    <body class="login">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?php echo base_url(); ?>login/check_admin_login" method="POST" data-toggle="validator" role="form">
                        <h1>Login</h1>
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('exception')): ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('exception'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_error('email'); ?>
                            <input type="text" name="email" required value="<?php echo set_value('email'); ?>" placeholder="Email" data-error="Please Enter Your Username or Email" class="form-control"/>
                            <span  class="help-block with-errors"></span >
                        </div>
                        <div class="form-group">
                            <input type="password" pattern="[0-9a-fA-F]{6,32}" name="password" required value="<?php echo set_value('password'); ?>" placeholder="Password" data-pattern-error="Minimum of 6 Characters" data-error="Please Enter Password to Login" class="form-control"/>
                            <span  class="help-block with-errors"></span >
                        </div>
                        <div class="form-group">
                            <button id="send" type="submit" class="btn btn-dark submit">Login</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator"></div>
                    </form>
                </section>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>
        <!-- Bootstrap Validator -->
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrapValidator.js"></script>
    </body>
</html>