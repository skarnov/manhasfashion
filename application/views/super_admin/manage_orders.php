<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Orders Management</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ($this->session->flashdata('update_order')): ?>
                            <div class="alert success-message alert-dismissable fade in">
                                <?php echo $this->session->flashdata('update_order'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-right">ID</th>
                                    <th class="text-right">Time</th>
                                    <th class="text-right">Discount</th>
                                    <th class="text-right">Total</th>
                                    <th class="text-right">Grand Total</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_orders as $v_order): ?>
                                    <tr>
                                        <td class="text-right"><?php echo 'C'.date('Y'). $v_order['pk_order_id']; ?></td>
                                        <td class="text-right"><?php echo $v_order['created_at']; ?></td>
                                        <td class="text-right"><?php echo $v_order['discount']; ?></td>
                                        <td class="text-right"><?php echo $v_order['order_total']; ?></td>
                                        <td class="text-right"><?php echo $v_order['order_total'] + $v_order['discount']; ?></td>
                                        <td>
                                            <?php
                                            if ($v_order['order_status'] == 1) {
                                                ?>
                                                <span class="label label-success">Active</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="label label-danger">Inactive</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropup">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                    Actions
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                    if ($v_order['order_status'] == '1') {
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>super_admin/unconfirmed_payment/<?php echo $v_order['pk_order_id']; ?>"><i class="fa fa-times"></i> Unconfirmed Payment</a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>super_admin/confirm_payment/<?php echo $v_order['pk_order_id']; ?>"><i class="fa fa-check"></i> Confirm Payment</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a href="<?php echo base_url(); ?>super_admin/view_order/<?php echo $v_order['pk_order_id']; ?>"><i class="fa fa-eye"></i> View</a></li>
                                                    <li><a href="<?php echo base_url(); ?>super_admin/delete_order/<?php echo $v_order['pk_order_id']; ?>" onclick="return check_delete();"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                </ul>
                                            </div>
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