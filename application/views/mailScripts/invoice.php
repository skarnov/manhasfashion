<!DOCTYPE html>

<html>
    <head>
        <style type="text/css">
            body{
                margin: 0;
                padding: 0;
            }
            .container{
                width: 595px;
                height: 842px;
                margin:0 auto;
            }
            .address{
                width: 230px;
                position: absolute;
                top: 20px;
                left: 420px;
            }
            .title{
                text-align: center;
            }
            td,th{
                padding:7px;
                font-size: 12px;
            }
            footer{
                font-size: 13px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <header>
                <div class="logo">
                    <img src="<?php echo base_url(); ?>media_library/images/website/logo.jpg"/>
                </div>
                <div class="address">
                    <p>
                        <strong>Contact:</strong> +88 01933447144, +88 09638813888, +88 01751407068, +88 09638107153<br/>
                        <strong>Website:</strong> www.eoutlet-bd.com<br/>
                        <strong>Date:</strong> <?php echo date("jS F, Y", strtotime($order_info->created_at)); ?>
                    </p>
                </div>
            </header>
            <div class="main">
                <h1 class="title">Invoice - C<?php echo date('Y') . $order_info->pk_order_id; ?></h1>
                <div class="customer">
                    <h3>Client Details</h3>
                    <p>
                        <strong>Name of Client:</strong> <?php echo $order_info->user_fullname; ?><br>
                        <strong>Address:</strong> <?php echo $order_info->user_address; ?><br>
                        <strong>Phone:</strong> <?php echo $order_info->user_mobile; ?><br/>
                        <strong>Email:</strong> <?php echo $order_info->user_email; ?>
                    </p>
                </div>
                <div class="customer">
                    <h3>Shipping Details</h3>
                    <p>
                        <strong>Name:</strong> <?php echo $order_info->delivery_name; ?><br>
                        <strong>Address:</strong> <?php echo $order_info->delivery_address; ?><br>
                        <strong>Phone:</strong> <?php echo $order_info->delivery_mobile; ?><br/>
                        <strong>Email:</strong> <?php echo $order_info->delivery_email; ?>
                    </p>
                </div>
                <div class="customer">
                    <h3>Billing Details</h3>
                    <p>
                        <strong>Name:</strong> <?php echo $order_info->billing_name; ?><br>
                        <strong>Address:</strong> <?php echo $order_info->billing_address; ?><br>
                        <strong>Phone:</strong> <?php echo $order_info->billing_mobile; ?><br/>
                        <strong>Email:</strong> <?php echo $order_info->billing_email; ?>
                    </p>
                </div>
                <br/><br/>
                <table  border="1" style="border-collapse: collapse;">
                    <tr>
                        <th>SL</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                    <?php
                    $contents = $this->cart->contents();
                    $i = 1;
                    foreach ($contents as $values) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $values['name']; ?></td>
                            <td><?php echo $values['qty']; ?></td>
                            <td><?php echo $values['price']; ?></td>
                            <td><?php echo $values['qty'] * $values['price']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    $order_total = $order_info->order_total;
                    $discount = $this->session->userdata('discount');
                    ?>
                    <tr>
                        <td colspan="7"><span style="margin-left:400px;">Total: <span style="font-weight: bolder;"> </span><?php echo $order_total; ?></span> BDT</td>
                    </tr>
                    <?php if ($discount) : ?>
                        <tr>
                            <td colspan="7"><span style="margin-left:400px;">Discount: <span style="font-weight: bolder;"> </span><?php echo $discount; ?></span> BDT</td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="7">
                            <span style="margin-left:400px;">Grand Total: 
                                <strong>
                                    <?php echo $order_total - $discount; ?> BDT
                                    <span style="color:red">(Unpaid)</span>
                                </strong>
                            </span>
                        </td>
                    </tr>
                </table>
                <p><b>Total In Word:</b> <?php echo convert_number_to_words($order_total) . ' Taka Only.'; ?></p><br>
            </div><br/><br/>
            <footer>
                <hr>
                <address>
                    Received the above in good condition & found No discrepancy
                </address>
            </footer>
        </div>
    </body>
</html>