<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">PRODUCT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Product Name <?php echo form_error('product_name') ?></label>
            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product_name; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Product Code <?php echo form_error('product_code') ?></label>
            <input type="text" class="form-control" name="product_code" id="product_code" value="<?php echo $product_code; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Category 1 <?php echo form_error('category_1') ?></label>
            <input type="text" class="form-control" name="category_1" id="category_1" value="<?php echo $category_1; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Category 2 <?php echo form_error('category_2') ?></label>
            <input type="text" class="form-control" name="category_2" id="category_2" value="<?php echo $category_2; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Baseline Sales <?php echo form_error('baseline_sales') ?></label>
            <input type="text" class="form-control" name="baseline_sales" id="baseline_sales" value="<?php echo $baseline_sales; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Incremental Sales <?php echo form_error('incremental_sales') ?></label>
            <input type="text" class="form-control" name="incremental_sales" id="incremental_sales" value="<?php echo $incremental_sales; ?>" />
        </div>
	    
        <div class="form-group">
            <label>SecLogUser <?php echo form_error('SecLogUser') ?></label>
            <input type="text" class="form-control" name="SecLogUser" id="SecLogUser" value="<?php echo $SecLogUser; ?>" />
        </div>
	    
        <div class="form-group">
            <label>SecLogDate <?php echo form_error('SecLogDate') ?></label>
            <input type="text" class="form-control" name="SecLogDate" id="SecLogDate" value="<?php echo $SecLogDate; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('product') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>