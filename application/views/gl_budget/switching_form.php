<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="box box-warning box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">BUDGET ALLOCATION</h3>
				</div>
				<form action="<?php echo $action; ?>" method="post" id="myForm">
					<div class="row">
						<div class="col-md-5">
							<h4 style="padding-left: 2%;">FROM</h4>
							<table class='table'>
								<tr>
									<td width="200px">Company
										<?php echo form_error('kode_perusahaan') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('kode_perusahaan', 'arc_company', 'nama_perusahaan', 'kode_perusahaan', $kode_perusahaan, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Business Unit
										<?php echo form_error('business_unit') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('business_unit_id', 'business_unit', 'business_unit_name', 'business_unit_id', $business_unit_id, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Department
										<?php echo form_error('kode_departemen') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Channel
										<?php echo form_error('channel_code') ?>
									</td>
									<td><select class="form-control select2" id="channel_code" name="channel_code">
											<option value="<?php echo $channel_code; ?>" selected><?php echo $channel_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Store
										<?php echo form_error('store_code') ?>
									</td>
									<td><select class="form-control select2" id="store_code" name="store_code">
											<option value="<?php echo $store_code; ?>" selected><?php echo $store_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Region
										<?php echo form_error('region_id') ?>
									</td>
									<td><select class="form-control select2" id="region_id" name="region_id">
											<option value="<?php echo $region_id; ?>" selected><?php echo $region_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Brand
										<?php echo form_error('brand_code') ?>
									</td>
									<td><select class="form-control select2" id="brand_code" name="brand_code">
											<option value="<?php echo $brand_code; ?>" selected><?php echo $brand_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Series
										<?php echo form_error('series_code') ?>
									</td>
									<td><select class="form-control select2" id="series_code" name="series_code">
											<option value="<?php echo $series_code; ?>" selected><?php echo $series_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Gl Account
										<?php echo form_error('gl_coa') ?>
									</td>
									<td>
										<select class="form-control select2" id="gl_coa" name="gl_coa">
											<option value="<?php echo $gl_coa; ?>" selected><?php echo $gl_coa; ?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Budget Balance
										<?php echo form_error('BudgetSaldo') ?>
									</td>
									<td>
										<select class="form-control select2" id="BudgetSaldo" name="BudgetSaldo" disabled>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<h4 style="padding-left: 2%;">TO</h4>
							<table class='table'>
								<tr>
									<td width="200px">Company
										<?php echo form_error('kode_perusahaan') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('kode_perusahaan_to', 'arc_company', 'nama_perusahaan', 'kode_perusahaan', $kode_perusahaan, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Business Unit
										<?php echo form_error('business_unit') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('business_unit_id_to', 'business_unit', 'business_unit_name', 'business_unit_id', $business_unit_id, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Department
										<?php echo form_error('kode_departemen') ?>
									</td>
									<td>
										<?php echo cmb_dinamis('kode_departemen_to', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen, 'ASC') ?>
									</td>
								</tr>
								<tr>
									<td>Channel
										<?php echo form_error('channel_code') ?>
									</td>
									<td><select class="form-control select2" id="channel_code_to" name="channel_code_to">
											<option value="<?php echo $channel_code; ?>" selected><?php echo $channel_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Store
										<?php echo form_error('store_code') ?>
									</td>
									<td><select class="form-control select2" id="store_code_to" name="store_code_to">
											<option value="<?php echo $store_code; ?>" selected><?php echo $store_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Region
										<?php echo form_error('region_id') ?>
									</td>
									<td><select class="form-control select2" id="region_id_to" name="region_id_to">
											<option value="<?php echo $region_id; ?>" selected><?php echo $region_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Brand
										<?php echo form_error('brand_code') ?>
									</td>
									<td><select class="form-control select2" id="brand_code_to" name="brand_code_to">
											<option value="<?php echo $brand_code; ?>" selected><?php echo $brand_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Series
										<?php echo form_error('series_code') ?>
									</td>
									<td><select class="form-control select2" id="series_code_to" name="series_code_to">
											<option value="<?php echo $series_code; ?>" selected><?php echo $series_name; ?></option>
										</select>

									</td>
								</tr>
								<tr>
									<td>Gl Account
										<?php echo form_error('gl_coa') ?>
									</td>
									<td>
										<select class="form-control select2" id="gl_coa_to" name="gl_coa_to">
											<option value="<?php echo $gl_coa; ?>" selected><?php echo $gl_coa; ?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Budget Balance
										<?php echo form_error('BudgetSaldo') ?>
									</td>
									<td>
										<select class="form-control select2" id="BudgetSaldo_to" name="BudgetSaldo_to" disabled>
										</select>
									</td>
								</tr>
								<tr>
									<td>Amount Allocation</td>
									<td>
										<input type="text" class="form-control" id="amount_allocation" name="amount_allocation" value="" />
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="hidden" id="gl_coa_segment" name="gl_coa_segment" />
										<input type="hidden" id="gl_coa_segment_to" name="gl_coa_segment_to" />
										<button type="button" class="btn btn-info" onclick="location.href='<?php echo site_url('gl_budget') ?>';"><i class="fa fa-sign-out"></i> Cancel</button>
										<button type="submit" class="btn btn-danger" id="save" disabled><i class="fa fa-floppy-o"></i> Save</button>&nbsp;
									</td>

								</tr>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//FROM
		$('#kode_departemen').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_channel'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option></option>';
					for (i = 0; i < data.length; i++) {
						/* html += '<option></option>'; */
						html += '<option value=' + data[i].channel_code + '>' + data[i].channel_name + '</option>';
					}
					$('#channel_code').html(html);

				}
			});
			return false;
		});

		//Store
		$('#channel_code').change(function() {
			var id = $(this).val();
			var kode_departemen = document.getElementById('kode_departemen').value;
			var business_unit_id = document.getElementById('business_unit_id').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_store_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].store_code + '>' + data[i].store_name + '</option>';
					}
					$('#store_code').html(html);

				}
			});
			return false;
		});

		//region
		$('#channel_code').change(function() {
			var id = $(this).val();
			var kode_departemen = document.getElementById('kode_departemen').value;
			var business_unit_id = document.getElementById('business_unit_id').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_region_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].region_code + '>' + data[i].nama_region + '</option>';
					}
					$('#region_id').html(html);

				}
			});
			return false;
		});

		//Get Brand
		$('#kode_departemen').change(function() {
			var id = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_brand_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					console.log(data);
					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].brand_code + '>' + data[i].brand_name + '</option>';
					}
					$('#brand_code').html(html);

				}
			});
			return false;
		});

		//Get Series
		$('#brand_code').change(function() {
			var id = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id').value;
			var kode_departemen = document.getElementById('kode_departemen').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_series_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].series_code + '>' + data[i].series_name + '</option>';
					}
					$('#series_code').html(html);

				}
			});
			return false;
		});

		//Get Coa (store)
		$('#store_code').change(function() {
			var store_code = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id').value;
			var kode_departemen = document.getElementById('kode_departemen').value;
			var channel_code = document.getElementById('channel_code').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + store_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + store_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_store_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa').html(html);

				}
			});
			return false;
		});

		//Get Coa (region)
		$('#region_id').change(function() {
			var region_code = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id').value;
			var kode_departemen = document.getElementById('kode_departemen').value;
			var channel_code = document.getElementById('channel_code').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + region_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + region_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_region_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa').html(html);

				}
			});
			return false;
		});

		//Get Coa (series)
		$('#series_code').change(function() {
			var series_code = $(this).val();
			var brand_code = document.getElementById('brand_code').value;
			var business_unit_id = document.getElementById('business_unit_id').value;
			var kode_departemen = document.getElementById('kode_departemen').value;
			var channel_code = document.getElementById('channel_code').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + brand_code + "-" + series_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + brand_code + "-" + series_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_series_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa').html(html);

				}
			});
			return false;
		});

		//Get Balance
		$('#gl_coa').change(function() {
			var company = "01" + "-";
			var business_unit_id = document.getElementById('business_unit_id').value + "-";
			var kode_departemen = document.getElementById('kode_departemen').value + "-";
			var channel_code = document.getElementById('channel_code').value + "-";
			var brand_code = document.getElementById('brand_code').value + "-";
			var series_code = document.getElementById('series_code').value;
			var store_code = document.getElementById('store_code').value;
			var region_code = document.getElementById('region_id').value;
			var gl_coa = "-" + $(this).val();
			if (kode_departemen == '0306-') {
				if (business_unit_id == '-') {
					var id = company + kode_departemen + channel_code + brand_code + series_code + gl_coa;
				} else {
					var id = company + business_unit_id + kode_departemen + channel_code + brand_code + series_code + gl_coa;
				}
			} else {
				if (business_unit_id == '-') {
					var id = company + kode_departemen + channel_code + store_code + region_code + gl_coa;
				} else {
					var id = company + business_unit_id + kode_departemen + channel_code + store_code + region_code + gl_coa;
				}
			}
			document.getElementById('gl_coa_segment').value = id;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_balance'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					function formatNumber(num) {
						return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
					}

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].BudgetSaldo + '>' + data[i].BudgetSaldo + '</option>';
					}
					$('#BudgetSaldo').html(html);

				}
			});
			return false;
		});

		//TO
		$('#kode_departemen_to').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_channel'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option></option>';
					for (i = 0; i < data.length; i++) {
						/* html += '<option></option>'; */
						html += '<option value=' + data[i].channel_code + '>' + data[i].channel_name + '</option>';
					}
					$('#channel_code_to').html(html);

				}
			});
			return false;
		});

		$('#channel_code_to').change(function() {
			var id = $(this).val();
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_store_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].store_code + '>' + data[i].store_name + '</option>';
					}
					$('#store_code_to').html(html);

				}
			});
			return false;
		});


		$('#channel_code_to').change(function() {
			var id = $(this).val();
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_region_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].region_code + '>' + data[i].nama_region + '</option>';
					}
					$('#region_id_to').html(html);

				}
			});
			return false;
		});

		//Get Brand
		$('#kode_departemen_to').change(function() {
			var id = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			console.log(id);
			console.log(business_unit_id);
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_brand_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					console.log(data);
					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].brand_code + '>' + data[i].brand_name + '</option>';
					}
					$('#brand_code_to').html(html);

				}
			});
			return false;
		});

		//Get Series
		$('#brand_code_to').change(function() {
			var id = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_series_switching'); ?>",
				method: "POST",
				data: {
					id: id,
					business_unit_id: business_unit_id,
					kode_departemen: kode_departemen,
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].series_code + '>' + data[i].series_name + '</option>';
					}
					$('#series_code_to').html(html);

				}
			});
			return false;
		});

		//Get Coa (store)
		$('#store_code_to').change(function() {
			var store_code = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			var channel_code = document.getElementById('channel_code_to').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + store_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + store_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_store_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa_to').html(html);

				}
			});
			return false;
		});

		//Get Coa (region)
		$('#region_id_to').change(function() {
			var region_code = $(this).val();
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			var channel_code = document.getElementById('channel_code_to').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + region_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + region_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_region_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa_to').html(html);

				}
			});
			return false;
		});

		//Get Coa (series)
		$('#series_code_to').change(function() {
			var series_code = $(this).val();
			var brand_code = document.getElementById('brand_code_to').value;
			var business_unit_id = document.getElementById('business_unit_id_to').value;
			var kode_departemen = document.getElementById('kode_departemen_to').value;
			var channel_code = document.getElementById('channel_code_to').value;
			if (business_unit_id == '') {
				var id = "01" + "-" + kode_departemen + "-" + channel_code + "-" + brand_code + "-" + series_code;
			} else {
				var id = "01" + "-" + business_unit_id + "-" + kode_departemen + "-" + channel_code + "-" + brand_code + "-" + series_code;
			}
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_coa_series_switching'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html += '<option></option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
					}
					$('#gl_coa_to').html(html);

				}
			});
			return false;
		});

		//Get Balance
		$('#gl_coa_to').change(function() {
			var company = "01" + "-";
			var business_unit_id = document.getElementById('business_unit_id_to').value + "-";
			var kode_departemen = document.getElementById('kode_departemen_to').value + "-";
			var channel_code = document.getElementById('channel_code_to').value + "-";
			var brand_code = document.getElementById('brand_code_to').value + "-";
			var series_code = document.getElementById('series_code_to').value;
			var store_code = document.getElementById('store_code_to').value;
			var region_code = document.getElementById('region_id_to').value;
			var gl_coa = "-" + $(this).val();
			if (kode_departemen == '0306-') {
				if (business_unit_id == '-') {
					var id = company + kode_departemen + channel_code + brand_code + series_code + gl_coa;
				} else {
					var id = company + business_unit_id + kode_departemen + channel_code + brand_code + series_code + gl_coa;
				}
			} else {
				if (business_unit_id == '-') {
					var id = company + kode_departemen + channel_code + store_code + region_code + gl_coa;
				} else {
					var id = company + business_unit_id + kode_departemen + channel_code + store_code + region_code + gl_coa;
				}
			}
			document.getElementById('gl_coa_segment_to').value = id;
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_balance'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					function formatNumber(num) {
						return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
					}

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].BudgetSaldo + '>' + data[i].BudgetSaldo + '</option>';
					}
					$('#BudgetSaldo_to').html(html);

				}
			});
			return false;
		});

	});
</script>
<!-- <script>
	var BudgetAmount = document.getElementById("amount_allocation");
	BudgetAmount.addEventListener("keyup", function(e) {
		BudgetAmount.value = convertRupiah(this.value);
	});
	BudgetAmount.addEventListener('keydown', function(event) {
		return isNumberKey(event);
	});

	function convertRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
	}

	function isNumberKey(evt) {
		key = evt.which || evt.keyCode;
		if (key != 188 // Comma
			&&
			key != 8 // Backspace
			&&
			key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
			&&
			(key < 48 || key > 57) // Non digit
		) {
			evt.preventDefault();
			return;
		}
	}
</script> -->
<script>
	$(document).ready(function() {
    $("#myForm input").on('change mouseup mousedown mouseout keydown keyup drop', multInputs);

    function multInputs() {
      $("#myForm").each(function() {
        var $amount_allocation = $('#amount_allocation', this).val();
		var $budget_saldo = $('#BudgetSaldo', this).val();
		var $saldo = $budget_saldo.replace(/,/g, '');
		var amount = parseInt($amount_allocation);
		var bSaldo = parseInt($saldo);
		if(amount > bSaldo){
			document.getElementById('save').disabled = true;
		} else {
			document.getElementById('save').disabled = false;
		}
      });
    }
  });
</script>