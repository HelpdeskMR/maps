<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ARC TRADING TERM</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">        
            
	    
        <div class="form-group">
            <label>Departemen <?php echo form_error('kode_departemen') ?></label>
            <?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen, 'ASC', 'required') ?>
        </div>
	    
        <div class="form-group">
            <label>Channel <?php echo form_error('channel_code') ?></label>
            <select class="form-control select2" id="channel_code" name="channel_code" required>
            	<option><?php echo $channel_code; ?></option>
            </select>
        </div>
	    
        <div class="form-group">
            <label>Store <?php echo form_error('store_code') ?></label>
            <?php echo cmb_dinamis('store_code', 'arc_store', 'store_name', 'store_code', $store_code, 'ASC', 'required') ?>
        </div>
        
        <div class="form-group">
            <label>Trading Term <?php echo form_error('trading_term') ?></label>
            <input type="text" class="form-control" name="trading_term" id="trading_term" value="<?php echo $trading_term; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="trading_term_id" value="<?php echo $trading_term_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('arc_trading_term') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                    </div>
	
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js' ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    /* CHANNEL */
    $('#kode_departemen').change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?php echo site_url('arc_trading_term/get_channel'); ?>",
        method: "POST",
        data: {
          id: id
        },
        async: true,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html = '<option></option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].channel_code + '>' + data[i].channel_name + '</option>';
          }
          $('#channel_code').html(html);

        }
      });
      return false;
    });
});
</script>