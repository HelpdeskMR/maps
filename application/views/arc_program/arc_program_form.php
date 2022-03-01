<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA PROGRAM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Nama Program <?php echo form_error('nama_program') ?></td>
        <td><input type="text" class="form-control" name="nama_program" id="nama_program" placeholder="Nama Program" value="<?php echo $nama_program; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Secloguser <?php echo form_error('secloguser') ?></td>
        <td><input type="text" class="form-control" name="secloguser" id="secloguser" placeholder="Secloguser" value="<?php echo $this->session->userdata('full_name'); ?>" readonly="readonly" /></td>
      </tr>
      <tr>
        <td width='200'>Seclogdate <?php echo form_error('seclogdate') ?></td>
        <td><input type="text" class="form-control" name="seclogdate" id="seclogdate" placeholder="Seclogdate" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d H:i:s');  echo $now; ?>"  readonly="readonly" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="program_id" value="<?php echo $program_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('arc_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>