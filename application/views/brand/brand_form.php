<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">BRAND</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Brand Code <?php echo form_error('brand_code') ?></label>
            <input type="text" class="form-control" name="brand_code" id="brand_code" value="<?php echo $brand_code; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Brand Name <?php echo form_error('brand_name') ?></label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $brand_name; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Kode Departemen <?php echo form_error('kode_departemen') ?></label>
            <input type="text" class="form-control" name="kode_departemen" id="kode_departemen" value="<?php echo $kode_departemen; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('brand') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>