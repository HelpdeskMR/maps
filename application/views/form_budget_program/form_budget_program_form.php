<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA FORM_BUDGET_PROGRAM</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>No P3 <?php echo form_error('no_p3') ?></td><td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="No P3" value="<?php echo $no_p3; ?>" /></td></tr>
	    <tr><td width='200'>Program Id <?php echo form_error('program_id') ?></td><td><input type="text" class="form-control" name="program_id" id="program_id" placeholder="Program Id" value="<?php echo $program_id; ?>" /></td></tr>
	    <tr><td width='200'>Gl Coa <?php echo form_error('gl_coa') ?></td><td><input type="text" class="form-control" name="gl_coa" id="gl_coa" placeholder="Gl Coa" value="<?php echo $gl_coa; ?>" /></td></tr>
	    <tr><td width='200'>Gl Coa Segment <?php echo form_error('gl_coa_segment') ?></td><td><input type="text" class="form-control" name="gl_coa_segment" id="gl_coa_segment" placeholder="Gl Coa Segment" value="<?php echo $gl_coa_segment; ?>" /></td></tr>
	    <tr><td width='200'>Sku Total Cost <?php echo form_error('sku_total_cost') ?></td><td><input type="text" class="form-control" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td></tr>
	    <tr><td width='200'>Sku Total Usage <?php echo form_error('sku_total_usage') ?></td><td><input type="text" class="form-control" name="sku_total_usage" id="sku_total_usage" placeholder="Sku Total Usage" value="<?php echo $sku_total_usage; ?>" /></td></tr>
	    <tr><td width='200'>Sku Total Saldo <?php echo form_error('sku_total_saldo') ?></td><td><input type="text" class="form-control" name="sku_total_saldo" id="sku_total_saldo" placeholder="Sku Total Saldo" value="<?php echo $sku_total_saldo; ?>" /></td></tr>
	    <tr><td width='200'>SecLogDate <?php echo form_error('SecLogDate') ?></td><td><input type="text" class="form-control" name="SecLogDate" id="SecLogDate" placeholder="SecLogDate" value="<?php echo $SecLogDate; ?>" /></td></tr>
	    <tr><td width='200'>SecLogUser <?php echo form_error('SecLogUser') ?></td><td><input type="text" class="form-control" name="SecLogUser" id="SecLogUser" placeholder="SecLogUser" value="<?php echo $SecLogUser; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('form_budget_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>