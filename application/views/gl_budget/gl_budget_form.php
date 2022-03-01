<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">BUDGET</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
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
							<?php echo cmb_dinamis('gl_coa', 'gl_account', 'gl_coa_desc', 'gl_coa', $gl_coa, 'ASC') ?>
						</td>
					</tr>
					<tr>
						<td>Year Period
							<?php echo form_error('YearPeriod') ?>
						</td>
						<td>
							<?php echo cmb_dinamis('YearPeriod', 'tbl_year_period', 'year', 'year', $YearPeriod, 'ASC') ?>
						</td>
					</tr>
					<tr>
						<td>Budget Total/Year
							<?php echo form_error('BudgetAmount') ?>
						</td>
						<td><input type="text" class="form-control" name="BudgetAmount" id="BudgetAmount" value="<?php echo $BudgetAmount; ?>" />
						</td>
					</tr>
					<tr>
						<td width='200'>Status Aktif <?php echo form_error('is_aktif') ?></td>
						<td><?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $is_aktif, array('class' => 'form-control')); ?>
					</tr>
					<tr>
						<td>Budget Usage
							<?php echo form_error('BudgetUsage') ?>
						</td>
						<td><input type="text" class="form-control" name="BudgetUsage" id="BudgetUsage" value="<?php echo $BudgetUsage; ?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Budget Balance
							<?php echo form_error('BudgetSaldo') ?>
						</td>
						<td><input type="text" class="form-control" name="BudgetSaldo" id="BudgetSaldo" value="<?php echo $BudgetSaldo; ?>" readonly />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<?php if ($button == "Update") { ?>
						<tr>
							<td>Keterangan</td>
							<td><textarea rows="4" id="keterangan" name="keterangan" class="form-contrl" style="width: 600px;"></textarea></td>
						</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td><input type="hidden" name="budget_id" value="<?php echo $budget_id; ?>" />
							<input type="hidden" name="gl_coa_segment" value="<?php echo $gl_coa_segment; ?>" />
							<button type="button" class="btn btn-info" onclick="location.href='<?php echo site_url('gl_budget') ?>';"><i class="fa fa-sign-out"></i> Back</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Save</button>&nbsp;
						</td>

					</tr>
				</table>
			</form>
		</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
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

		$('#channel_code').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_store'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].store_code + '>' + data[i].store_name + '</option>';
					}
					$('#store_code').html(html);

				}
			});
			return false;
		});


		$('#channel_code').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_region'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
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
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_brand'); ?>",
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
			$.ajax({
				url: "<?php echo site_url('gl_budget/get_series'); ?>",
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
						html += '<option value=' + data[i].series_code + '>' + data[i].series_name + '</option>';
					}
					$('#series_code').html(html);

				}
			});
			return false;
		});

	});
</script>
<script>
	var BudgetAmount = document.getElementById("BudgetAmount");
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
</script>