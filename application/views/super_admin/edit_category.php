<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>super_admin/add_category" class="btn btn-info">Add New Category</a>
                    <a href="<?php echo base_url(); ?>super_admin/manage_categories" class="btn btn-success">Manage Categories</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit The Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <form action="<?php echo base_url(); ?>super_admin/update_category" method="POST" data-toggle="validator" role="form" class="form-horizontal form-label-left">
                                <div class="col-md-6">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Serial</label>
                                        <div class="col-md-9">
                                            <input type="text" name="serial" required value="<?php echo $category_info->category_serial; ?>" data-error="Enter Category Serial" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Name</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('category_name'); ?>
                                            <input type="text" name="category_name" required value="<?php echo $category_info->category_name; ?>" data-error="Enter Category Name" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                            <input type="hidden" name="category_id" value="<?php echo $category_info->pk_category_id; ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <div class="control-label pull-right">
                                            <button id="send" type="submit" class="btn btn-dark">Edit Category</button>
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