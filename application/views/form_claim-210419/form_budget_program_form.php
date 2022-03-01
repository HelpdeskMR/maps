<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Klaim</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>No P3 <?php echo form_error('no_p3') ?></td>
        <td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="No P3" value="<?php echo $no_p3; ?>" readonly /></td>
      </tr>
      <tr>
        <td width='200'>Nama Program <?php echo form_error('program_id') ?></td>
        <td><input type="text" class="form-control" name="program_id" id="program_id" placeholder="Program Id" value="<?php echo $program_id; ?>" readonly /></td>
      </tr>
      <tr>
        <td width='200'>Gl Coa <?php echo form_error('gl_coa') ?></td>
        <td><input type="text" class="form-control" name="gl_coa" id="gl_coa" placeholder="Gl Coa" value="<?php echo $gl_coa; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Sku Total Cost <?php echo form_error('sku_total_cost') ?></td>
        <td><input type="text" class="form-control" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="id" value="<?php echo $id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('form_budget_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>