<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA WF_PROGRAM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered>'        

	    
      <tr>
        <td width='200'>No P3 <?php echo form_error('no_p3') ?></td>
        <td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="No P3" value="<?php echo $no_p3; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Approval Scheme <?php echo form_error('approval_scheme') ?></td>
        <td><input type="text" class="form-control" name="approval_scheme" id="approval_scheme" placeholder="Approval Scheme" value="<?php echo $approval_scheme; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Id User Level <?php echo form_error('id_user_level') ?></td>
        <td><input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Approve By <?php echo form_error('approve_by') ?></td>
        <td><input type="text" class="form-control" name="approve_by" id="approve_by" placeholder="Approve By" value="<?php echo $approve_by; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Approval Date <?php echo form_error('approval_date') ?></td>
        <td><input type="text" class="form-control" name="approval_date" id="approval_date" placeholder="Approval Date" value="<?php echo $approval_date; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>SecLogDate <?php echo form_error('SecLogDate') ?></td>
        <td><input type="text" class="form-control" name="SecLogDate" id="SecLogDate" placeholder="SecLogDate" value="<?php echo $SecLogDate; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>SecLogUser <?php echo form_error('SecLogUser') ?></td>
        <td><input type="text" class="form-control" name="SecLogUser" id="SecLogUser" placeholder="SecLogUser" value="<?php echo $SecLogUser; ?>" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="id" value="<?php echo $id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('wf_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>