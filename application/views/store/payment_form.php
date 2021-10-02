<!--Main Content-->
<div class="content">
    <!--Login-->
    <div class="cart">
        <div class="shipping-form">
            <div class="form-w3agile">
                <div id="orderSuccess">
                    <form action="" method="POST" data-toggle="validator" role="form">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Payment Method</h3>
                                <div class="radio">
                                    <label><input type="radio" required name="optradio">Cash on Delivery</label>
                                </div>
                                <div class="radio disabled">
                                    <label><input type="radio" name="optradio" disabled>Visa</label>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>client/confirm_order" class="btn btn-danger">Confirm Order</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End of Login-->
</div>
<!--End of Main Content-->