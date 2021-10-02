<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>super_admin/add_category" class="btn btn-info">Add New Category</a>
                    <a href="<?php echo base_url(); ?>super_admin/add_subcategory" class="btn btn-info">Add New Sub Category</a>
                    <a href="<?php echo base_url(); ?>super_admin/add_subcategory_item" class="btn btn-info">Add New Sub Category Item</a>
                    <a href="<?php echo base_url(); ?>super_admin/manage_categories" class="btn btn-success">Manage Categories</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add New Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <?php if ($this->session->flashdata('save_category')): ?>
                                    <div class="alert success-message alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $this->session->flashdata('save_category'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form action="<?php echo base_url(); ?>super_admin/save_category" method="POST" data-toggle="validator" role="form" class="form-horizontal form-label-left">
                                <div class="col-md-8">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Category Name</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('category_name'); ?>
                                            <input type="text" name="category_name" required value="<?php echo set_value('category_name'); ?>" data-error="Enter Category Name" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <div class="control-label pull-right">
                                            <button id="send" type="submit" class="btn btn-dark">Save Category</button>
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