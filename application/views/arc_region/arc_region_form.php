<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA REGION</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Nama Region <?php echo form_error('nama_region') ?></td>
        <td><input type="text" class="form-control" name="nama_region" id="nama_region" placeholder="Nama Region" value="<?php echo $nama_region; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Nama RSM <?php echo form_error('rsm_id') ?></td>
        <td>
        	<?php echo cmb_dinamis('rsm_id', 'arc_rsm', 'nama_rsm', 'rsm_id', $rsm_id,'ASC') ?> 
        </td>
      </tr>
      <tr>
        <td width='200'>Secloguser <?php echo form_error('secloguser') ?></td>
        <td><input type="text" class="form-control" name="secloguser" id="secloguser" placeholder="Secloguser" value="<?php echo $this->session->userdata('full_name'); ?>" readonly="readonly" /></td>
      </tr>
      <tr>
        <td width='200'>Seclogdate <?php echo form_error('seclogdate') ?></td>
        <td><input type="text" class="form-control" name="seclogdate" id="seclogdate" placeholder="Seclogdate" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d H:i:s');  echo $now; ?>"  readonly="readonly"/></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="region_id" value="<?php echo $region_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('arc_region') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>