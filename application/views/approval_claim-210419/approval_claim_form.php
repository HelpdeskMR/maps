<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA APPROVAL_CLAIM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        
      <tr>
        <td width='200'>Approval Scheme <?php echo form_error('approval_scheme') ?></td>
        <td><?php echo cmb_dinamis('approval_scheme', 'approval_scheme', 'approval_scheme', 'approval_scheme', $approval_scheme,'ASC') ?></td></td>
      </tr>
      <tr>
        <td width='200'>Id User Level <?php echo form_error('id_user_level') ?></td>
        <td><?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $id_user_level,'ASC') ?></td>
      </tr>
      <tr>
        <td width='200'>Kode Region <?php echo form_error('region_id') ?></td>
        <td><?php echo cmb_dinamis('region_id', 'arc_region', 'nama_region', 'region_id', $region_id,'ASC') ?></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="id" value="<?php echo $id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('approval_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>