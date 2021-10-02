<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>super_admin/add_product" class="btn btn-info">Add New Product</a>
                    <a href="<?php echo base_url(); ?>super_admin/manage_products" class="btn btn-success">Manage Products</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add New Product</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert success-message alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form action="<?php echo base_url(); ?>super_admin/save_product" method="POST" enctype="multipart/form-data" data-toggle="validator" role="form" class="form-horizontal form-label-left">
                                <div class="col-md-6">
                                    <h3>Basic Information</h3><hr/>
                                    <div class="item form-group">
                                        <div class="col-md-9 col-md-offset-1">
                                            <div class="radio text-success">
                                                <input type="radio" name="attribute" checked value="0">
                                                <label>Normal</label>
                                            </div>
                                            <div class="radio text-primary">
                                                <input type="radio" name="attribute" value="2">
                                                <label>New Arrival</label>
                                            </div>
                                            <div class="radio text-danger">
                                                <input type="radio" name="attribute" value="1">
                                                <label>Best Seller</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Category</label>
                                        <div class="col-md-9">
                                            <select name="category_id" onclick="findSubcategories(this.value)" class="form-control">
                                                <option>Please Select One</option>
                                                <?php foreach ($all_categories as $category): ?>    
                                                    <option value="<?php echo $category->pk_category_id; ?>"><?php echo $category->category_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Subcategory</label>
                                        <div class="col-md-9">
                                            <select name="subcategory_id" id="subcategories" onmousemove="findSubcategoryItems(this.value)" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Subcategory Items</label>
                                        <div class="col-md-9">
                                            <select name="subcategory_item_id" id="subcategoryItems" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" required value="<?php echo set_value('name'); ?>" data-error="Please Enter Product Name" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Main Picture<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="product_picture" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Product Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Price</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('price'); ?>
                                            <input type="text" name="price" required value="<?php echo set_value('price'); ?>" data-pattern-error="Please Enter Valid Product Price" data-error="Please Enter Product Price" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Additional Information</h3><hr/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Secondary Picture<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="product_picture_2" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Product Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="product_picture_3" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Product Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="product_picture_4" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Product Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="image/*" name="product_picture_5" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload Product Picture">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                            <textarea name="meta[description]" class="form-control col-md-7 col-xs-12"><?php echo set_value('product_description'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Clothing</h3><hr/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Sizes</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[sizes]" value="<?php echo set_value('meta[sizes]'); ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Colors</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[colors]" value="<?php echo set_value('meta[colors]'); ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Build Material</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[build_material]" value="<?php echo set_value('meta[build_material]'); ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Beverage</h3><hr/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Country Origin</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[country_origin]" value="<?php echo set_value('meta[country_origin]'); ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="control-label pull-right">
                                        <button id="send" type="submit" class="btn btn-dark">Save Product</button>
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