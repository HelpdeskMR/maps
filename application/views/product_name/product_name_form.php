<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">PRODUCT NAME</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Product Code <?php echo form_error('product_code') ?></label>
            <input type="text" class="form-control" name="product_code" id="product_code" value="<?php echo $product_code; ?>" />
        </div>
	    
        <div class="form-group">
            <label>Product Name <?php echo form_error('product_name') ?></label>
            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product_name; ?>" />
        </div>
		
		<div class="form-group">
            <label>Category 1 <?php echo form_error('category_1') ?></label>
            <?php echo cmb_dinamis('category_1', 'product_category', 'category_name', 'category_id', $category_1, 'ASC') ?>
        </div>
		
		<div class="form-group">
            <label>Category 2 <?php echo form_error('category_2') ?></label>
            <?php echo cmb_dinamis('category_2', 'product_category', 'category_name', 'category_id', $category_2, 'ASC') ?>
        </div>
		
		<div class="form-group">
            <label>Business Unit <?php echo form_error('business_unit_id') ?></label>
            <?php echo cmb_dinamis('business_unit_id', 'business_unit', 'business_unit_name', 'business_unit_id', $business_unit_id, 'ASC') ?>
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="product_name_id" value="<?php echo $product_name_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('product_name') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>