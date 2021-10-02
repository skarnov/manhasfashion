<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-cogs"></i> Settings</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-3">
                                <!-- Required For Floating -->
                                <!-- Nav Tabs -->
                                <ul class="nav nav-tabs tabs-left">
                                    <li class="active"><a href="#slider" data-toggle="tab">Slider</a></li>
                                    <li><a href="#banner" data-toggle="tab">Banner</a></li>
                                </ul>
                            </div>
                            <div class="col-xs-9">
                                <!-- Tab Panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="slider">
                                        <p class="lead">Manage Sliders</p><hr/>
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('save_slider')): ?>
                                            <div class="alert success-message alert-dismissable fade in">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $this->session->flashdata('save_slider'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="btn-group btn-breadcrumb">
                                                    <a href="#addSlider" data-toggle="tab" class="btn btn-success">Add Slider</a>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th class="text-right" style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($all_sliders as $v_slider): ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($v_slider->setting) { ?>
                                                                <img src="<?php echo base_url() . 'media_library/images/slider_images/' . $v_slider->setting; ?>" class="img-rounded dataTableImage">
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-right">
                                                            <a href="<?php echo base_url(); ?>super_admin/delete_slider/<?php echo $v_slider->pk_setting_id; ?>" onclick="return check_delete();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="addSlider">
                                        <p class="lead">Add Slider</p>
                                        <hr/>
                                        <form action="<?php echo base_url(); ?>super_admin/save_slider" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                            <div class="item form-group">
                                                <label class="control-label col-md-3">Upload Picture <br/> (Size: 1700x600)</label>
                                                <div class="col-md-9">
                                                    <input type="file" accept="image/*" name="picture" class="file">
                                                    <div class="input-group col-xs-12">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                        <input type="text" class="form-control input-md" disabled placeholder="Upload Picture">
                                                        <span class="input-group-btn">
                                                            <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="control-label pull-right">
                                                    <button id="send" type="submit" class="btn btn-dark">Save Slider</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="banner">
                                        <p class="lead">Manage Banners</p><hr/>
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('save_banner')): ?>
                                            <div class="alert success-message alert-dismissable fade in">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $this->session->flashdata('save_banner'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="btn-group btn-breadcrumb">
                                                    <a href="#addBanner" data-toggle="tab" class="btn btn-success">Add Banner</a>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Banner Text</th>
                                                    <th>Position</th>
                                                    <th class="text-right" style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($all_banners as $v_banner): ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($v_banner->setting) { ?>
                                                                <img src="<?php echo base_url() . 'media_library/images/banner_images/' . $v_banner->setting; ?>" class="img-rounded dataTableImage">
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $v_banner->setting_data; ?></td>
                                                        <td><?php echo $v_banner->setting_position; ?></td>
                                                        <td class="text-right">
                                                            <a href="<?php echo base_url(); ?>super_admin/delete_banner/<?php echo $v_banner->pk_setting_id; ?>" onclick="return check_delete();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="addBanner">
                                        <p class="lead">Add Banner</p>
                                        <hr/>
                                        <form action="<?php echo base_url(); ?>super_admin/save_banner" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                            <div class="item form-group">
                                                <label class="control-label col-md-3">Upload Picture</label>
                                                <div class="col-md-9">
                                                    <input type="file" accept="image/*" name="picture" class="file">
                                                    <div class="input-group col-xs-12">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                        <input type="text" class="form-control input-md" disabled placeholder="Upload Picture">
                                                        <span class="input-group-btn">
                                                            <button class="browse btn btn-primary input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3">Banner Text</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="text" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3">Banner Position</label>
                                                <div class="col-md-9">
                                                    <select name="setting_position" required class="form-control">
                                                        <option value="Right Big">Right Big (Size: 590x640)</option>
                                                        <option value="Left Medium">Left Medium (Size: 640x350)</option>
                                                        <option value="Left Small Right">Left Small Right (Size: 350x350)</option>
                                                        <option value="Left Small Left">Left Small Left (Size: 350x350)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="control-label pull-right">
                                                    <button id="send" type="submit" class="btn btn-dark">Save Banner</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->