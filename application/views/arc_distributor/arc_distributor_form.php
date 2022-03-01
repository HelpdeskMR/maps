<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA DISTRIBUTOR</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Kode Distributor <?php echo form_error('kode_distributor') ?></td>
        <td><input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="Kode Distributor" value="<?php echo $kode_distributor; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Nama Distributor <?php echo form_error('nama_distributor') ?></td>
        <td><input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $nama_distributor; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Email <?php echo form_error('email') ?></td>
        <td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Area <?php echo form_error('kode_area') ?></td>
        <td>
        <?php echo cmb_dinamis('kode_area', 'arc_area', 'nama_area', 'kode_area', $kode_area,'ASC') ?> 
        </td>
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
        <td><input type="hidden" name="distributor_id" value="<?php echo $distributor_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('arc_distributor') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>