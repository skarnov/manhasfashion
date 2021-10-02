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
                        <h2>Categories Management</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ($this->session->flashdata('update_category')): ?>
                            <div class="alert success-message alert-dismissable fade in">
                                <?php echo $this->session->flashdata('update_category'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th class="text-right">Serial</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categories as $v_category): ?>
                                    <tr>
                                        <td><?php echo $v_category->category_name; ?></td>
                                        <td>
                                            <?php
                                            if ($v_category->category_type == 1) {
                                                ?>
                                                <span class="label label-success">Category</span>
                                                <?php
                                            } elseif ($v_category->category_type == 2) {
                                                ?>
                                                <span class="label label-warning">Subcategory</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="label label-primary">Subcategory Item</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right"><?php echo $v_category->category_serial; ?></td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url(); ?>super_admin/edit_category/<?php echo $v_category->pk_category_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="<?php echo base_url(); ?>super_admin/delete_category/<?php echo $v_category->pk_category_id; ?>" onclick="return check_delete();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
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