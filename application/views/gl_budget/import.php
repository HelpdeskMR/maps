<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <h3 style="display:block; text-align:center;">Import Data <?php echo @$judul; ?></h3>

  <form method="POST" action="<?php echo base_url($url); ?>" enctype="multipart/form-data">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="fa fa-file-excel-o"></i>
      </span>
      <input type="file" class="form-control" name="excel" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-success"> <i class="fa fa-check"></i> Import Data</button>
      </div>
    </div>
  </form>
</div>