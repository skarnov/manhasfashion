<!-- Page Content -->
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>super_admin/manage_orders" class="btn btn-success">Manage Orders</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>View Order</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id='printDiv'>
                            <section class="content invoice">
                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <h1>
                                            <i class="fa fa-globe"></i> Invoice - C<?php echo date('Y') ?><?php echo $order_info->pk_order_id; ?>
                                            <small class="pull-right">Date: <?php echo $order_info->created_at; ?></small>
                                        </h1>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-xs-12 table">
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                <strong style="font-size: 1.3em;">Customer Details</strong>
                                                <address>
                                                    <?php echo $order_info->user_fullname; ?>
                                                    <?php echo $order_info->user_address; ?>
                                                    <br>Mobile: <?php echo $order_info->user_mobile; ?>
                                                    <br>Email: <?php echo $order_info->user_email; ?>
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">
                                                <strong style="font-size: 1.3em;">Shipping Details</strong>
                                                <address>
                                                    <?php echo $order_info->delivery_name; ?>
                                                    <?php echo $order_info->delivery_email; ?>
                                                    <br>Mobile: <?php echo $order_info->delivery_mobile; ?>
                                                    <br>Email: <?php echo $order_info->delivery_email; ?>
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">
                                                <strong style="font-size: 1.3em;">Billing Details</strong>
                                                <address>
                                                    <?php echo $order_info->billing_name; ?>
                                                    <?php echo $order_info->billing_email; ?>
                                                    <br>Mobile: <?php echo $order_info->billing_mobile; ?>
                                                    <br>Email: <?php echo $order_info->billing_email; ?>
                                                </address>
                                            </div>
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-right">ID</th>
                                                    <th>Name</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Price</th>
                                                    <th class="text-right">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ordermeta as $v_order): ?>
                                                    <tr>
                                                        <td class="text-right"><?php echo $v_order->fk_product_id; ?></td>
                                                        <td><?php echo $v_order->product_name; ?></td>
                                                        <td class="text-right"><?php echo $v_order->product_sales_quantity; ?></td>
                                                        <td class="text-right"><?php echo $v_order->product_price; ?></td>
                                                        <td class="text-right"><?php echo $v_order->product_sales_quantity * $v_order->product_price; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <p class="lead">Payment Status:</p>
                                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                            <?php
                                            $order_status = $order_info->order_status;
                                            if ($order_status == 0) {
                                                echo '<span class="text-danger">Pending</span>';
                                            } else {
                                                echo '<span class="text-success">Paid</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td><?php echo ($order_info->order_total) - ($order_info->discount); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount (5%)</th>
                                                        <td><?php echo $order_info->discount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td><?php echo $order_info->order_total + $order_info->discount; ?> BDT</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default" onclick="printDiv('printDiv')"><i class="fa fa-print"></i> Print</button>
<!--                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->