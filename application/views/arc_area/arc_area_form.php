<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA AREA</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Kode Area <?php echo form_error('kode_area') ?></td>
        <td><input type="text" class="form-control" name="kode_area" id="kode_area" placeholder="Kode Area" value="<?php echo $kode_area; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Nama Area <?php echo form_error('nama_area') ?></td>
        <td><input type="text" class="form-control" name="nama_area" id="nama_area" placeholder="Nama Area" value="<?php echo $nama_area; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Region <?php echo form_error('region_id') ?></td>
        <td>
     	<?php echo cmb_dinamis('region_id', 'arc_region', 'nama_region', 'region_id', $region_id,'ASC') ?> 
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="area_id" value="<?php echo $area_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('arc_area') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>