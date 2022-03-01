<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><?php echo @$judul; ?></h3>

  <form method="POST" action="<?php echo base_url($url); ?>" enctype="multipart/form-data">
	<table class='table'>
		<tr>
			<td width="500px">Start date</td>
			<td width="80%">
				<input type="date" name="startDate" id="startDate" class="form-control" require />
			</td>
		</tr>
		<tr>
			<td width="500px">End date</td>
			<td width="80%">
				<input type="date" name="endDate" id="endDate" class="form-control" require />
			</td>
		</tr>
		<tr>
			<td width="500px">Channel</td>
			<td>
				<select class="form-control select2" id="channel_code" name="channel_code" style="width: 100%" require>
					<option></option>
					<option value="">All</option>
					<option value="001">MTKA</option>
					<option value="003">GT</option>
					<option value="002">MTI</option>
				</select>
			</td>
		</tr>
	</table>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-success"> <i class="fa fa-check"></i> Export Report Claim</button>
      </div>
    </div>
  </form>
</div>