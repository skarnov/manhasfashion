<!--Main Content-->
<div class="content">
    <!--Shopping Cart-->
    <div class="cart">
        <div class="cart-area">
            <div class="form-w3agile">
                <h3>Shopping Cart</h3>
                <?php if ($contents = $this->cart->contents()): ?>
                    <div class="bs-docs-example">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th></th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contents as $v_contents): ?>
                                    <tr>
                                        <td><img src="<?php echo base_url(); ?>media_library/images/product_images/<?php echo $v_contents['image']; ?>" height="50" width="50"></td>
                                        <td><?php echo $v_contents['name']; ?></td>
                                        <td class="text-right">
                                            <form action="<?php echo base_url(); ?>store/update_cart" method="POST">
                                                <input type="hidden" value="<?php echo $v_contents['rowid']; ?>" name="rowid"/>
                                                <input type="text" name="product_quantity" value="<?php echo $v_contents['qty']; ?>" class="btn btn-outline-info form-group" style="width: 10%; color: black; background: mediumspringgreen;">
                                                <button type="submit" class="btn btn-info form-group" title="Update"><i class="fa fa-refresh"></i> Update Qunatity</button>
                                            </form>
                                        </td>
                                        <td><?php echo $v_contents['price']; ?></td>
                                        <td><?php echo $v_contents['subtotal']; ?></td>
                                        <td><a href="<?php echo base_url(); ?>store/remove/<?php echo $v_contents['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </a></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right"><?php echo $total = $this->cart->total(); ?> BDT</td>
                                </tr>
                                <?php
                                $discount = $this->session->userdata('discount');
                                $discount = $total * $discount;
                                if ($discount):
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Discount</td>
                                        <td class="text-right"><?php echo $discount; ?> BDT</td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong class="text-danger"><span id="grandTotal"><?php echo $total - $discount; ?> BDT</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if ($total): ?>
                            <a href="<?php echo base_url(); ?>checkout/login" class="btn btn-success pull-right"><i class="fa fa-shopping-cart"></i> Checkout</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!--End of Shopping Cart-->
</div>
<!--End of Main Content-->