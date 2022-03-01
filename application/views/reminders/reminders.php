<div class="content-wrapper">
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Email</h3>
            </div>
            <form action="<?php echo site_url('reminders/send_notif_finance'); ?>" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User</label>
                                <?php echo cmb_dinamis('user', 'tbl_user', 'full_name', 'id_users', $id_users, 'ASC') ?>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
</div>