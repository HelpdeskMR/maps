<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA APPROVAL_PROGRAM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Id Users <?php echo form_error('id_users') ?></td>
        <td><?php echo cmb_dinamis('id_users', 'tbl_user', 'full_name', 'id_users', $id_users,'ASC') ?></td>
      </tr>
      <tr>
        <td width='200'>Id User Level <?php echo form_error('id_user_level') ?></td>
        <td><?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $id_user_level,'ASC') ?></td>
      </tr>
      <tr>
        <td width='200'>Kode Departemen <?php echo form_error('kode_departemen') ?></td>
        <td><?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen,'ASC') ?></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="id" value="<?php echo $approval_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('approval_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>