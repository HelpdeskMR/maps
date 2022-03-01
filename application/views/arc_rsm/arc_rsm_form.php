<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ARC RSM</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Nama Rsm <?php echo form_error('nama_rsm') ?></label>
            <input type="text" class="form-control" name="nama_rsm" id="nama_rsm" value="<?php echo $nama_rsm; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Region Code <?php echo form_error('region_code') ?></label>
            <input type="text" class="form-control" name="region_code" id="region_code" value="<?php echo $region_code; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="rsm_id" value="<?php echo $rsm_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('arc_rsm') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>