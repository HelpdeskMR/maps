<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA GL_ACCOUNT</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>Gl Coa <?php echo form_error('gl_coa') ?></td>
        <td><input type="text" class="form-control" name="gl_coa" id="gl_coa" placeholder="Gl Coa" value="<?php echo $gl_coa; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Gl Coa Desc <?php echo form_error('gl_coa_desc') ?></td>
        <td><input type="text" class="form-control" name="gl_coa_desc" id="gl_coa_desc" placeholder="Gl Coa Desc" value="<?php echo $gl_coa_desc; ?>" /></td>
      </tr>
       <tr>
        <td width='200'>Is Aktif <?php echo form_error('is_aktif') ?></td>
        <td><?php echo form_dropdown('is_aktif',array('y'=>'AKTIF','n'=>'TIDAK'),$is_aktif,array('class'=>'form-control'))?></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="coa_id" value="<?php echo $coa_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('gl_account') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>