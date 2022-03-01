<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">SERIES</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Series Name <?php echo form_error('series_name') ?></label>
            <input type="text" class="form-control" name="series_name" id="series_name" value="<?php echo $series_name; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Series Alias <?php echo form_error('series_alias') ?></label>
            <input type="text" class="form-control" name="series_alias" id="series_alias" value="<?php echo $series_alias; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Brand Code <?php echo form_error('brand_code') ?></label>
            <input type="text" class="form-control" name="brand_code" id="brand_code" value="<?php echo $brand_code; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="series_code" value="<?php echo $series_code; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('series') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>