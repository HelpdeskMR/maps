<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA PROMOTION_FINANCIAL_DESC</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Financial Name <?php echo form_error('financial_name') ?></td><td><input type="text" class="form-control" name="financial_name" id="financial_name" placeholder="Financial Name" value="<?php echo $financial_name; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="financial_desc_id" value="<?php echo $financial_desc_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('promotion_financial_desc') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>