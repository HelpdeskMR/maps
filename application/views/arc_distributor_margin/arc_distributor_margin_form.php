<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DISTRIBUTOR MARGIN</h3>
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
            <select class="form-control select2" id="store_code" name="store_code">
            	<option><?php echo $store_code; ?></option>
            </select>
        </div>
	    
        <div class="form-group">
            <label>Region <?php echo form_error('region_code') ?></label>
            <select class="form-control select2" id="region_code" name="region_code">
            	<option><?php echo $region_code; ?></option>
            </select>
        </div>
	    
        <div class="form-group">
            <label>Margin <?php echo form_error('margin') ?></label>
            <input type="text" class="form-control" name="margin" id="margin" value="<?php echo $margin; ?>" />
        </div>
	    <div class="box-footer">
                        <input type="hidden" name="distributor_margin_id" value="<?php echo $distributor_margin_id; ?>" /> 
	        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	        <a href="<?php echo site_url('arc_distributor_margin') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
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
        url: "<?php echo site_url('arc_distributor_margin/get_channel'); ?>",
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

    /* STORE */
    $('#channel_code').change(function() {
	  var kode_departemen = document.getElementById('kode_departemen').value;
      var id = $(this).val();
      $.ajax({
        url: "<?php echo site_url('arc_distributor_margin/get_store'); ?>",
        method: "POST",
        data: {
          id: id,
		  kode_departemen: kode_departemen
        },
        async: true,
        dataType: 'json',
        success: function(data) {

          var html = '';
          var i;
          html = '<option></option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].store_code + '>' + data[i].store_name + '</option>';
          }
          $('#store_code').html(html);

        }
      });
      return false;
    });

    /* REGION */
    $('#channel_code').change(function() {
	  var kode_departemen = document.getElementById('kode_departemen').value;
      var id = $(this).val();
      $.ajax({
        url: "<?php echo site_url('arc_distributor_margin/get_region'); ?>",
        method: "POST",
        data: {
          id: id,
		  kode_departemen: kode_departemen
        },
        async: true,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html = '<option></option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].region_code + '>' + data[i].nama_region + '</option>';
          }
          $('#region_code').html(html);
        }
      });
      return false;
    });
});
</script>