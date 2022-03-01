<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">PASSWORD</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Type <?php echo form_error('type') ?></label>
            <input type="text" class="form-control" name="type" id="type" value="<?php echo $type; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Password <?php echo form_error('password') ?></label>
            <textarea class="form-control" rows="3" name="password" id="password" ><?php echo $password; ?></textarea>
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="" value="<?php echo $; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('password') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>