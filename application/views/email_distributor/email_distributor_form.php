<div class="content-wrapper">
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Email</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Promotion Number</label>
                                <input type="text" class="form-control" name="promotion_number" id="promotion_number" value="<?php echo $promotion_number; ?>" />
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
</div>