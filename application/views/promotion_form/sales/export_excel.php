<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><?php echo @$judul; ?></h3>

  <form method="POST" action="<?php echo base_url($url); ?>" enctype="multipart/form-data">
	<table class='table'>
		<tr>
			<td width="100px">Month</td>
			<td width="100%">
				<select class="form-control select2" id="month" name="month" style="width: 100%">
					<option></option>
					<option value="">All</option>
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8">Agustus</option>
					<option value="9">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100px">Year Period</td>
			<td width="100%">
				<?php echo cmb_dinamis2('YearPeriod', 'tbl_year_period', 'year', 'year', null, 'ASC', 'YearPeriod') ?>
			</td>
		</tr>
		<tr>
			<td>Department</td>
			<td>
				<select class="form-control select2" id="kode_departemen" name="kode_departemen" style="width: 100%">
					<option></option>
					<option value="">All</option>
					<option value="0312">Key Account</option>
					<option value="0305">Trade Marketing</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select class="form-control select2" id="status_code" name="status_code" style="width: 100%">
					<option></option>
					<option value="5">All</option>
					<option value="4">Approved</option>
					<option value="0">Waiting</option>
					<option value="2">Rejected</option>
				</select>
			</td>
		</tr>
	</table>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-success"> <i class="fa fa-check"></i> Export Report Promotion</button>
      </div>
    </div>
  </form>
</div>