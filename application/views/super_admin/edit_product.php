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
                        <h2>Edit The Product</h2>
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
                            </div>
                            <form name="edit_product" action="<?php echo base_url(); ?>super_admin/update_product" method="POST" enctype="multipart/form-data" data-toggle="validator" role="form" class="form-horizontal form-label-left">
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
                                                <?php foreach ($all_subcategories as $subcategory): ?>
                                                    <option value="<?php echo $subcategory->pk_category_id; ?>"><?php echo $subcategory->category_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Subcategory Items</label>
                                        <div class="col-md-9">
                                            <select name="subcategory_item_id" id="subcategoryItems" class="form-control">
                                                <?php foreach ($all_subcategory_items as $category): ?>    
                                                    <option value="<?php echo $category->pk_category_id; ?>"><?php echo $category->category_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" required value="<?php echo isset($product_info['product_name']) ? $product_info['product_name'] : ''; ?>" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo isset($product_info['pk_product_id']) ? $product_info['pk_product_id'] : ''; ?>"/>
                                    <input type="hidden" name="previous_product_picture" value="<?php echo isset($product_info['product_image']) ? $product_info['product_image'] : ''; ?>"/>
                                    <input type="hidden" name="previous_product_picture_thumb" value="<?php echo isset($product_info['product_image_thumb']) ? $product_info['product_image_thumb'] : ''; ?>"/>
                                    <?php if ($product_info['product_image'] == NULL) { ?>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3">Main Picture</label>
                                            <div class="col-md-9">
                                                <img src="<?php echo base_url() . 'media_library/images/default_images/product.png'; ?>" class="img-responsive editImagePreview"/>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3">Main Picture</label>
                                            <div class="col-md-9">
                                                <img src="<?php echo base_url() . 'media_library/images/product_images/' . $product_info['product_image']; ?>" class="img-responsive editImagePreview"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Upload New<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" name="product_picture" accept="image/*" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload New">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="previous_product_picture_2" value="<?php echo isset($product_info['meta']['product_image_2']) ? $product_info['meta']['product_image_2'] : ''; ?>"/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <img src="<?php if (!empty($product_info['meta']['product_image_2'])) { echo base_url() . 'media_library/images/product_images/' . $product_info['meta']['product_image_2'];} else {echo base_url() . 'media_library/images/default_images/product.png'; }?>" class="img-responsive editImagePreview"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Upload New<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" name="product_picture_2" accept="image/*" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload New">
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
                                            <input type="text" name="price" required value="<?php echo isset($product_info['product_price']) ? $product_info['product_price'] : ''; ?>" data-pattern-error="Please Enter Valid Product Price" data-error="Please Enter Product Price" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Old Price</label>
                                        <div class="col-md-9">
                                            <?php echo form_error('old_price'); ?>
                                            <input type="text" name="old_price" value="<?php echo isset($product_info['product_old_price']) ? $product_info['product_old_price'] : ''; ?>" data-pattern-error="Please Enter Valid Product Old Price" class="form-control col-md-7 col-xs-12">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Additional Information</h3><hr/>
                                    <input type="hidden" name="previous_product_picture_3" value="<?php echo isset($product_info['meta']['product_image_3']) ? $product_info['meta']['product_image_3'] : ''; ?>"/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <img src="<?php if (!empty($product_info['meta']['product_image_3'])) { echo base_url() . 'media_library/images/product_images/' . $product_info['meta']['product_image_3'];} else {echo base_url() . 'media_library/images/default_images/product.png'; }?>" class="img-responsive editImagePreview"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Upload New<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" name="product_picture_3" accept="image/*" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload New">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="previous_product_picture_4" value="<?php echo isset($product_info['meta']['product_image_4']) ? $product_info['meta']['product_image_4'] : ''; ?>"/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <img src="<?php if (!empty($product_info['meta']['product_image_4'])) { echo base_url() . 'media_library/images/product_images/' . $product_info['meta']['product_image_4'];} else {echo base_url() . 'media_library/images/default_images/product.png'; }?>" class="img-responsive editImagePreview"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Upload New<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" name="product_picture_4" accept="image/*" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload New">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="previous_product_picture_5" value="<?php echo isset($product_info['meta']['product_image_5']) ? $product_info['meta']['product_image_5'] : ''; ?>"/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <img src="<?php if (!empty($product_info['meta']['product_image_5'])) { echo base_url() . 'media_library/images/product_images/' . $product_info['meta']['product_image_5'];} else {echo base_url() . 'media_library/images/default_images/product.png'; }?>" class="img-responsive editImagePreview"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Upload New<br/> (Size 250x300)</label>
                                        <div class="col-md-9">
                                            <input type="file" name="product_picture_5" accept="image/*" class="file">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                <input type="text" class="form-control input-md" disabled placeholder="Upload New">
                                                <span class="input-group-btn">
                                                    <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                            <textarea name="meta[description]" class="form-control col-md-7 col-xs-12"><?php echo isset($product_info['meta']['description']) ? $product_info['meta']['description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Clothing</h3><hr/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Sizes</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[sizes]" value="<?php echo isset($product_info['meta']['sizes']) ? $product_info['meta']['sizes'] : ''; ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Colors</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[colors]" value="<?php echo isset($product_info['meta']['colors']) ? $product_info['meta']['colors'] : ''; ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Build Material</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[build_material]" value="<?php echo isset($product_info['meta']['build_material']) ? $product_info['meta']['build_material'] : ''; ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Beverage</h3><hr/>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3">Country Origin</label>
                                        <div class="col-md-9">
                                            <input type="text" name="meta[country_origin]" value="<?php echo isset($product_info['meta']['country_origin']) ? $product_info['meta']['country_origin'] : ''; ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="control-label pull-right">
                                        <button id="send" type="submit" class="btn btn-dark">Update Product</button>
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
<script>
    document.forms['edit_product'].elements['attribute'].value = '<?php echo $product_info['product_attribute']; ?>';
    document.forms['edit_product'].elements['category_id'].value = '<?php echo $product_info['fk_category_id']; ?>';
    document.forms['edit_product'].elements['subcategory_id'].value = '<?php echo $product_info['fk_subcategory_id']; ?>';
    document.forms['edit_product'].elements['subcategory_item_id'].value = '<?php echo $product_info['fk_subcategory_item_id']; ?>';
</script>