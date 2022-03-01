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
                                <label>Alamat Email</label>
                                <input type="text" class="form-control" name="alamat_email" id="alamat_email" value="<?php echo $alamat_email; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $subject; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message" id="message" value="<?php echo $message; ?>"></textarea>
                            </div>
							<div class="form-group">
                                <label>Port</label>
                                <select class="form-control" name="port" id="port">
									<option></option>
									<option value="465">465</option>
									<option value="587">587</option>
                                    <option value="25">25</option>								</select>
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