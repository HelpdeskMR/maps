<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA ARC_CHANNEL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Channel Code <?php echo form_error('channel_code') ?></td><td><input type="text" class="form-control" name="channel_code" id="channel_code" placeholder="Channel Code" value="<?php echo $channel_code; ?>" /></td></tr>
	    <tr><td width='200'>Channel Name <?php echo form_error('channel_name') ?></td><td><input type="text" class="form-control" name="channel_name" id="channel_name" placeholder="Channel Name" value="<?php echo $channel_name; ?>" /></td></tr>
	    <tr><td width='200'>Kode Departemen <?php echo form_error('kode_departemen') ?></td><td><input type="text" class="form-control" name="kode_departemen" id="kode_departemen" placeholder="Kode Departemen" value="<?php echo $kode_departemen; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="channel_id" value="<?php echo $channel_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('arc_channel') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>