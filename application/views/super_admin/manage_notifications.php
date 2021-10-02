<!-- Page Content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Notifications Management</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Notification</th>
                                    <th class="text-right">Time</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_notifications as $v_notification): ?>
                                    <tr>
                                        <td><?php echo $v_notification->notification; ?></td>
                                        <td class="text-right"><?php echo $v_notification->created_at; ?></td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url(); ?>super_admin/delete_notification/<?php echo $v_notification->pk_notification_id; ?>" onclick="return check_delete();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->