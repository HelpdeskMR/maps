<style>
	#signup-step {
		margin: 20px 2% auto;
		padding: 0;
		width: 100%;
		font-size: 16px;
		font-weight: 500;
		font-family: "Source Sans Pro", sans-serif;
	}
	
	#signup-step li {
		list-style: none;
		float: left;
		padding: 6px 30px;
		border-top: #3c8dbc 1px solid;
		border-left: #3c8dbc 1px solid;
		border-right: #3c8dbc 1px solid;
		border-radius: 5px 5px 0 0;
		margin-right: 3px;
	}
	
	.active {
		color: #FFF;
	}
	
	#signup-step li.active {
		background-color: #3c8dbc;
	}
	
	#signup-form {
		clear: both;
		border: 1px #004C9C solid;
		padding: 20px;
		width: 80%;
		margin: auto;
	}
	
	.demoInputBox {
		padding: 10px;
		border: #CDCDCD 1px solid;
		border-radius: 4px;
		background-color: #FFF;
		width: 50%;
	}
	
	.signup-error {
		color: #FF0000;
		padding-left: 15px;
	}
	
	.message {
		color: #00FF00;
		font-weight: bold;
		width: 100%;
		padding: 10;
	}
	
	.btnAction {
		padding: 5px 10px;
		background-color: #F00;
		border: 0;
		color: #FFF;
		cursor: pointer;
		margin-top: 15px;
	}
	
	label {
		line-height: 35px;
	}
	
	.table-wizard td {
		color: #000;
	}
	
	.table-approve {
		border: 1px solid #D5D5D5;
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}
	
	.table-read td,
	th {
		border: 1px solid #D5D5D5;
		padding: 0.5rem;
	}
	
	.table-approve th {
		border: 1px solid #D5D5D5;
		text-align: center;
	}
	
	.table-approve td {
		border: 1px solid #D5D5D5;
		vertical-align: top;
		padding-left: 8%;
	}

</style>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">PROMOTION FORM</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" class="form-horizontal" id="promotion_header" enctype="multipart/form-data">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Date <?php echo form_error('date_create') ?></label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="date_create" id="date_create" value="<?php echo date(" Y/m/d "); ?>" readonly="readonly"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Department</label>
								<div class="col-sm-9">
									<select class="form-control select2" id="kode_departemen" name="kode_departemen" required style="width: 100%;">
										<option></option>
										<?php $no = 0;
          			foreach ($row_departemen as $row) : $no++; ?>
										<option value="<?php echo $row['kode_departemen']; ?>">
											<?php echo $row['nama_departemen']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Promotion Name <?php echo form_error('promotion_name') ?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="promotion_name" id="promotion_name" value="<?php echo $promotion_name; ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Start Period <?php echo form_error('periode_awal') ?></label>
								<div class="col-sm-3">
									<input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Periode Awal" value="<?php echo $periode_awal; ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">End Period <?php echo form_error('periode_akhir') ?></label>
								<div class="col-sm-3">
									<input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Periode Akhir" value="<?php echo $periode_akhir; ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Fiscal Year <?php echo form_error('fiscal_year') ?></label>
								<div class="col-sm-3">
								<?php echo cmb_dinamis('fiscal_year', 'tbl_year_period', 'year', 'year', $fiscal_year, 'ASC') ?>
									<!-- <select class="form-control select2" name="fiscal_year" id="fiscal_year" required>
					  	<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
						<option value="<?php echo date('Y', strtotime('+1 years')); ?>"><?php echo date('Y', strtotime('+1 years')); ?></option>
					</select> -->
								
									<!--                  <input type="text" class="form-control" name="fiscal_year" id="fiscal_year" value="<?php echo date("Y"); ?>" readonly="readonly" />-->
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Promotion Number</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="promotion_number" id="promotion_number" placeholder="Auto Number" value="<?php echo $promotion_number; ?>" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Channel <?php echo form_error('channel_code') ?></label>
								<div class="col-sm-9">
									<select class="form-control select2" id="channel_code" name="channel_code" required style="width: 100%;">
										<option>
											<?php echo $channel_name; ?>
										</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Region </label>
								<div class="col-sm-9">
									<select class="form-control select2" id="region_code" name="region_code" style="width: 100%;">
										<option>
											<?php echo $region_name; ?>
										</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Area</label>
								<div class="col-sm-9">
									<select class="form-control select2" id="kode_area" name="kode_area" style="width: 100%;">
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Store </label>
								<div class="col-sm-9">
									<select class="form-control select2" id="store_code" name="store_code" style="width: 100%;">
										<option>
											<?php echo $store_name; ?>
										</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Upload Excel/Pdf </label>
								<div class="col-sm-9">
									<input type="file" class="form-control" name="upload_file"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Upload Activity </label>
								<div class="col-sm-9">
									<input type="file" class="form-control" name="upload_activity"/>
								</div>
							</div>
							<div class="form-group" style="display: none" id="dis">
								<label class="col-sm-3 control-label">Distributor</label>
								<div class="col-sm-9">
									<select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="kode_distributor" name="kode_distributor[]"></select>
								</div>
							  </div>
						</div>

						<!-- /.row -->
					</div>
					<!-- / .SALES INFORMATION -->
					<div class="row">
						<div class="col-md-6">
							<div class="box-header with-border">
								<h3 class="box-title">SALES INFORMATION</h3>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Background <?php echo form_error('sales_background') ?></label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" name="sales_background" id="sales_background" required><?php echo $sales_background; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Sales Strategy </label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" name="sales_strategy" id="sales_strategy"><?php echo $sales_strategy; ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-header with-border">
								<h3 class="box-title">&nbsp;</h3>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Objective <?php echo form_error('sales_objective') ?></label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" name="sales_objective" id="sales_objective" required><?php echo $sales_objective; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Mechanism </label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" name="sales_mechanism" id="sales_mechanism"><?php echo $sales_mechanism; ?></textarea>
								</div>
							</div>
						</div>
						<!-- /.row -->
					</div>

					<div class="col-md-12">
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Product</a>
								</li>
								<li><a href="#tab_2" data-toggle="tab">Trading Term</a>
								</li>
								<li><a href="#tab_3" data-toggle="tab">Listing Cost</a>
								</li>
								<li><a href="#tab_4" data-toggle="tab">On Top Promo</a>
								</li>
								<li><button type="button" class="btn btn-success" name="budget" id="budget"><i class="fa fa-search-plus"></i> Check Budget</button>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<!-- / .PRODUCTS -->
									<div id="product-field">
										<font color="#000" style="padding-left: 1%"> Upload Product ( Excel )</font>
										<div class="input-group margin col-sm-6">
											<input type="file" class="form-control" name="product" id="product"/>
											<div class="input-group-btn">
												<button type="button" class="btn btn-success" id="upload_product" onclick="Upload_product()"><i class="fa fa-upload" style="color: #fff"> Upload</i></a></button>
												<button type="button" class="btn btn-danger btn_remove_product" id="remove" name="remove_product"><i class="fa fa-remove" style="color: #fff"> Clear</i></a></button>
												<button type="button" class="btn btn-warning"><a href="<?php echo base_url('templates/Template_upload_product.xls') ?>"><i class="fa fa-download" style="color: #fff"> Download Template</i></a></button>
											</div>
											<!-- /btn-group -->
										</div>
										<div id="dvExcel">
										</div>
										<table class="table table-wizard" id="product_field" style="display: ">
											<tr>
												<td>Product Name<span id="product_name-error" class="signup-error"></span>
												</td>
												<td>Category 1<span id="category1-error" class="signup-error"></span>
												</td>
												<td>Category 2<span id="category2-error" class="signup-error"></span>
												</td>
												<td>Baseline Sales (HET)<span id="baseline_sales-error" class="signup-error"></span>
												</td>
												<td>Incremental Sales (HET)<span id="incremental_sales-error" class="signup-error"></span>
												</td>
												<td>Action</td>
											</tr>
											<tr>
												<td width="25%">
													<?php echo cmb_dinamis2('product_name[]', 'product_list', 'product_name', 'product_code', $product_code, 'ASC', 'product_name') ?>
												</td>
												<td style="width:auto">
													<?php echo cmb_dinamis2('category_1[]', 'product_category', 'category_name', 'category_id', $category_id, 'ASC', 'category_1') ?>
												</td>
												<td style="width:auto">
													<?php echo cmb_dinamis2('category_2[]', 'product_category', 'category_name', 'category_id', $category_id, 'ASC', 'category_2') ?>
												</td>
												<td width="15%"><input type="text" name="baseline_sales[]" class="form-control" id="baseline_sales" value="<?php echo $baseline_sales; ?>"/>
												</td>
												<td width="15%"><input type="text" name="incremental_sales[]" class="form-control" id="incremental_sales" value="<?php echo $incremental_sales; ?>"/>
												</td>
												<td width="5%"><button type="button" name="add" id="add" class="btn btn-success">Add</button>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<!-- / .TRADING TERM -->
									<div id="trading-field">
										<table class="table table-wizard" id="trading_field">
											<tr>
												<td>Activity<span id="promo_activity-error" class="signup-error"></span>
												</td>
												<td>GL Account Name<span id="account_name-error" class="signup-error"></span>
												</td>
												<td>Amount<span id="promo_amount-error" class="signup-error"></span>
												</td>
												<td>Action</td>
											</tr>
											<tr>
												<td width="30%">
													<?php echo cmb_dinamis2('trading_activity[]', 'trading_term_activity', 'trading_activity_name', 'trading_activity_id', $trading_activity_id, 'ASC', 'trading_activity') ?>
												</td>
												<td>
													<select class="form-control select2" id="trading_account_code" name="trading_account_code[]" style="width:100%">
														<option></option>
													</select>
												</td>
												<td><input type="text" class="form-control" id="trading_amount" name="trading_amount[]" value="<?php echo $trading_amount; ?>"/><span id="error_trading" class="text-danger"> </span>
												</td>
												<td><button type="button" name="add3" id="add3" class="btn btn-success">Add</button>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_3">
									<!-- / .LISTING COST -->
									<div id="listing-field">
										<table class="table table-wizard" id="listing_field">
											<tr>
												<td>Activity<span id="listing_activity-error" class="signup-error"></span>
												</td>
												<td>GL Account Name<span id="account_name-error" class="signup-error"></span>
												</td>
												<td>Amount<span id="listing_amount-error" class="signup-error"></span>
												</td>
												<td>Source Of Fund</td>
												<td>Remarks</td>
												<td>Action</td>
											</tr>
											<tr>
												<td width="20%">
													<?php echo cmb_dinamis2('listing_activity[]', 'listing_activity', 'listing_activity_name', 'listing_activity_id', $listing_activity_id, 'ASC', 'listing_activity') ?>
												</td>
												<td>
													<select class="form-control select2" id="listing_account_code" name="listing_account_code[]" style="width:100%">
														<option></option>
													</select>
												</td>
												<td><input type="text" id="listing_amount" name="listing_amount[]" class="form-control" value="<?php echo $listing_amount; ?>"/><span id="error_listing" class="text-danger"> </span>
												</td>
												<td><input type="text" id="listing_source_of_fund" name="listing_source_of_fund[]" class="form-control" value="<?php echo $listing_source_of_fund; ?>"/>
												</td>
												<td><textarea class="form-control" rows="1" id="listing_remarks" name="listing_remarks[]" value="<?php echo $listing_remarks; ?>"></textarea>
												</td>
												<td><button type="button" name="add1" id="add1" class="btn btn-success">Add</button>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_4">
									<!-- / .ON TOP PROMO -->
									<div id="promo-field">
										<table class="table table-wizard" id="promo_field">
											<tr>
												<td>Activity<span id="promo_activity-error" class="signup-error"></span>
												</td>
												<td>GL Account Name<span id="account_name-error" class="signup-error"></span>
												</td>
												<td>Amount<span id="promo_amount-error" class="signup-error"></span>
												</td>
												<td>Source Of Fund</td>
												<td>Remarks</td>
												<td>Action</td>
											</tr>
											<tr>
												<td width="30%">
													<?php echo cmb_dinamis2('promo_activity[]', 'on_top_promo_activity', 'promo_activity_name', 'promo_activity_id', $promo_activity_id, 'ASC', 'promo_activity') ?>
												</td>
												<td>
													<select class="form-control select2" id="promo_account_code" name="promo_account_code[]" style="width:100%">
														<option></option>
													</select>
												</td>
												<td><input type="text" class="form-control" id="promo_amount" name="promo_amount[]" value="<?php echo $promo_amount; ?>"/><span id="error_promo" class="text-danger"> </span>
												</td>
												<td><input type="text" class="form-control" id="promo_source_of_fund" name="promo_source_of_fund[]" value="<?php echo $promo_source_of_fund; ?>"/>
												</td>
												<td><textarea class="form-control" rows="1" id="promo_remarks" name="promo_remarks[]" value="<?php echo $promo_remarks; ?>"></textarea>
												</td>
												<td><button type="button" name="add2" id="add2" class="btn btn-success">Add</button>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- nav-tabs-custom -->
					</div>
					<!-- / .WIZARD END -->
					<!-- /.body -->
					<div class="box-footer"> <a href="<?php echo site_url('promotion_form') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
						<button class="btn btn-danger" name="finish" id="finish" disabled><i class="fa fa-floppy-o"></i> Save</button>
					</div>
				</div>
				<!-- /.footer -->
			</form>
		</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.10.2.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/xlsx.full.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jszip.js' ?>"></script>
<script type="text/javascript">
	$( document ).ready( function () {
		/* CHANNEL */
		$( '#kode_departemen' ).change( function () {
			var id = $( this ).val();
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_channel'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {
					var html = '';
					var i;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						html += '<option value=' + data[ i ].channel_code + '>' + data[ i ].channel_name + '</option>';
					}
					$( '#channel_code' ).html( html );

				}
			} );
			return false;
		} );

		/* STORE */
		$( '#channel_code' ).change( function () {
			var kode_departemen = document.getElementById( 'kode_departemen' ).value;
			var id = $( this ).val();
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_store'); ?>",
				method: "POST",
				data: {
					id: id,
					kode_departemen: kode_departemen
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						html += '<option value=' + data[ i ].store_code + '>' + data[ i ].store_name + '</option>';
					}
					$( '#store_code' ).html( html );

				}
			} );
			return false;
		} );

		/* REGION */
		$( '#channel_code' ).change( function () {
			var kode_departemen = document.getElementById( 'kode_departemen' ).value;
			var id = $( this ).val();
			if(id != '001'){
						document.getElementById('dis').style.display = '';
				} 
				if(id == '001') {
					document.getElementById('dis').style.display = 'none';
				}
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_region'); ?>",
				method: "POST",
				data: {
					id: id,
					kode_departemen: kode_departemen
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {
					var html = '';
					var i;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						html += '<option value=' + data[ i ].region_code + '>' + data[ i ].nama_region + '</option>';
					}
					$( '#region_code' ).html( html );
				}
			} );
			return false;
		} );
		
		//Get List Distributor
		$( '#region_code' ).change( function () {
			var id = $( this ).val();
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_distributor'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
//					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						// html += '<option value=' + data[ i ].kode_distributor + '>' + data[ i ].nama_distributor + '</option>';
						if(id == 6){
							html += '<option value="' + data[ i ].kode_distributor + '" selected>' + data[ i ].nama_distributor + '</option>';
						} else {
							html += '<option value=' + data[ i ].kode_distributor + '>' + data[ i ].nama_distributor + '</option>';
						}
					}
					$( '#kode_distributor' ).html( html );

				}
			} );
			return false;
		} );


		$( '#region_code' ).change( function () {
			var id = $( this ).val();
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_area'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						html += '<option value=' + data[ i ].kode_area + '>' + data[ i ].nama_area + '</option>';
					}
					$( '#kode_area' ).html( html );

				}
			} );
			return false;
		} );


		/* Get Account Name (Listing Cost) */

		$( '#region_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#listing_account_code' + x ).html( html );
					}
					$( '#listing_account_code' ).html( html );
				}
			} );
			return false;
		} );

		$( '#store_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#listing_account_code' + x ).html( html );
					}
					$( '#listing_account_code' ).html( html );
				}
			} );
			return false;
		} );

		document.getElementById( "add1" ).onclick = function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#listing_account_code' + x ).html( html );
					}
				}
			} );
			return false;
		}

		/* Get Account Name (On Top Promo) */

		$( '#region_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#promo_account_code' + x ).html( html );
					}
					$( '#promo_account_code' ).html( html );
				}
			} );
			return false;
		} );

		$( '#store_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#promo_account_code' + x ).html( html );
					}
					$( '#promo_account_code' ).html( html );
				}
			} );
			return false;
		} );

		document.getElementById( "add2" ).onclick = function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#promo_account_code' + x ).html( html );
					}
				}
			} );
			return false;
		}

		/* Get Account Name (Trading Term) */

		$( '#region_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#trading_account_code' + x ).html( html );
					}
					$( '#trading_account_code' ).html( html );
				}
			} );
			return false;
		} );

		$( '#store_code' ).change( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#trading_account_code' + x ).html( html );
					}
					$( '#trading_account_code' ).html( html );
				}
			} );
			return false;
		} );

		document.getElementById( "add3" ).onclick = function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var id = company + kode_departemen + channel_code + store_code + region_code;
			$.ajax( {
				url: "<?php echo site_url('promotion_form/get_coaSegment'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {

					var html = '';
					var i;
					var x;
					var max = 100;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						if (data[ i ].is_aktif == 'n'){
							html += '<option disabled title="Over Budget" value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						} else {
							html += '<option value=' + data[ i ].gl_coa + '>' + data[ i ].gl_coa_desc + '</option>';
						}
					}
					for ( x = 0; x < max; x++ ) {
						$( '#trading_account_code' + x ).html( html );
					}
				}
			} );
			return false;
		}

		// Cek Budget
		//#On Top Promo
		$( '#budget' ).click( function () {
			var company = "01" + "-";
			var kode_departemen = document.getElementById( 'kode_departemen' ).value + "-";
			var channel_code = document.getElementById( 'channel_code' ).value + "-";
			var store_code = document.getElementById( 'store_code' ).value;
			var region_code = document.getElementById( 'region_code' ).value;
			var fiscal_year = document.getElementById( 'fiscal_year' ).value;
			var finish = document.getElementById( 'finish' );
			
			if ( $.trim( $( '#promo_account_code' ).val() ).length != 0 && $.trim( $( '#promo_amount' ).val() ).length != 0 ) {
				var gl_account_name = "-" + document.getElementById( 'promo_account_code' ).value;
				var promo_amount = document.getElementById( 'promo_amount' ).value;
				var id = company + kode_departemen + channel_code + store_code + region_code + gl_account_name;
				console.log( id, promo_amount );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id,
						promo: promo_amount,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo = data;
							$( '#error_promo' ).html( error_promo );
							finish.disabled = true;
							return false;
						} else {
							var error_promo = "";
							$( '#error_promo' ).html( error_promo );
							finish.disabled = false;
						}
					}
				} );
			} //1

			//Row 2	
			if ( $.trim( $( '#promo_account_code2' ).val() ).length != 0 && $.trim( $( '#promo_amount2' ).val() ).length != 0 ) {
				var gl_account_name2 = "-" + $( '#promo_account_code2' ).val();
				var promo_amount2 = $( '#promo_amount2' ).val();
				var id2 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name2;

				console.log( id2, promo_amount2 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id2,
						promo: promo_amount2,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo2 = data;
							$( '#error_promo2' ).html( error_promo2 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo2 = "";
							$( '#error_promo2' ).html( error_promo2 );
							finish.disabled = false;
						}
					}
				} );
			} //2

			//Row 3	
			if ( $.trim( $( '#promo_account_code3' ).val() ).length != 0 && $.trim( $( '#promo_amount3' ).val() ).length != 0 ) {
				var gl_account_name3 = "-" + $( '#promo_account_code3' ).val();
				var promo_amount3 = $( '#promo_amount3' ).val();
				var id3 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name3;

				console.log( id3, promo_amount3 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id3,
						promo: promo_amount3,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo3 = data;
							$( '#error_promo3' ).html( error_promo3 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo3 = "";
							$( '#error_promo3' ).html( error_promo3 );
							finish.disabled = false;
						}
					}
				} );
			} //3

			//Row 4
			if ( $.trim( $( '#promo_account_code4' ).val() ).length != 0 && $.trim( $( '#promo_amount4' ).val() ).length != 0 ) {
				var gl_account_name4 = "-" + $( '#promo_account_code4' ).val();
				var promo_amount4 = $( '#promo_amount4' ).val();
				var id4 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name4;

				console.log( id4, promo_amount4 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id4,
						promo: promo_amount4,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo4 = data;
							$( '#error_promo4' ).html( error_promo4 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo4 = "";
							$( '#error_promo4' ).html( error_promo4 );
							finish.disabled = false;
						}
					}
				} );
			} //4

			//Row 5
			if ( $.trim( $( '#promo_account_code5' ).val() ).length != 0 && $.trim( $( '#promo_amount5' ).val() ).length != 0 ) {
				var gl_account_name5 = "-" + $( '#promo_account_code5' ).val();
				var promo_amount5 = $( '#promo_amount5' ).val();
				var id5 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name5;

				console.log( id5, promo_amount5 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id5,
						promo: promo_amount5,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo5 = data;
							$( '#error_promo5' ).html( error_promo5 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo5 = "";
							$( '#error_promo5' ).html( error_promo5 );
							finish.disabled = false;
						}
					}
				} );
			} //5

			//Row 6
			if ( $.trim( $( '#promo_account_code6' ).val() ).length != 0 && $.trim( $( '#promo_amount6' ).val() ).length != 0 ) {
				var gl_account_name6 = "-" + $( '#promo_account_code6' ).val();
				var promo_amount6 = $( '#promo_amount6' ).val();
				var id6 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name6;

				console.log( id6, promo_amount6 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id6,
						promo: promo_amount6,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo6 = data;
							$( '#error_promo6' ).html( error_promo6 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo6 = "";
							$( '#error_promo6' ).html( error_promo6 );
							finish.disabled = false;
						}
					}
				} );
			} //6

			//Row 7
			if ( $.trim( $( '#promo_account_code7' ).val() ).length != 0 && $.trim( $( '#promo_amount7' ).val() ).length != 0 ) {
				var gl_account_name7 = "-" + $( '#promo_account_code7' ).val();
				var promo_amount7 = $( '#promo_amount7' ).val();
				var id7 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name7;

				console.log( id7, promo_amount7 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id7,
						promo: promo_amount7,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo7 = data;
							$( '#error_promo7' ).html( error_promo7 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo7 = "";
							$( '#error_promo7' ).html( error_promo7 );
							finish.disabled = false;
						}
					}
				} );
			} //7

			//Row 8
			if ( $.trim( $( '#promo_account_code8' ).val() ).length != 0 && $.trim( $( '#promo_amount8' ).val() ).length != 0 ) {
				var gl_account_name8 = "-" + $( '#promo_account_code8' ).val();
				var promo_amount8 = $( '#promo_amount8' ).val();
				var id8 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name8;

				console.log( id8, promo_amount8 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id8,
						promo: promo_amount8,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );

						if (data != null){
							var error_promo8 = data;
							$( '#error_promo8' ).html( error_promo8 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo8 = "";
							$( '#error_promo8' ).html( error_promo8 );
							finish.disabled = false;
						}
					}
				} );
			} //8

			//Row 9
			if ( $.trim( $( '#promo_account_code9' ).val() ).length != 0 && $.trim( $( '#promo_amount9' ).val() ).length != 0 ) {
				var gl_account_name9 = "-" + $( '#promo_account_code9' ).val();
				var promo_amount9 = $( '#promo_amount9' ).val();
				var id9 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name9;

				console.log( id9, promo_amount9 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id9,
						promo: promo_amount9,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo9 = data;
							$( '#error_promo9' ).html( error_promo9 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo9 = "";
							$( '#error_promo9' ).html( error_promo9 );
							finish.disabled = false;
						}
					}
				} );
			} //9

			//Row 10
			if ( $.trim( $( '#promo_account_code10' ).val() ).length != 0 && $.trim( $( '#promo_amount10' ).val() ).length != 0 ) {
				var gl_account_name10 = "-" + $( '#promo_account_code10' ).val();
				var promo_amount10 = $( '#promo_amount10' ).val();
				var id10 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name10;

				console.log( id10, promo_amount10 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_promo'); ?>",
					method: "POST",
					data: {
						id: id10,
						promo: promo_amount10,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_promo10 = data;
							$( '#error_promo10' ).html( error_promo10 );
							finish.disabled = true;
							return false;
						} else {
							var error_promo10 = "";
							$( '#error_promo10' ).html( error_promo10 );
							finish.disabled = false;
						}
					}
				} );
			} //10



			//Listing Cost
			
			if ( $.trim( $( '#listing_account_code' ).val() ).length != 0 && $.trim( $( '#listing_amount' ).val() ).length != 0 ) {
				var gl_account_name = "-" + document.getElementById( 'listing_account_code' ).value;
				var listing_amount = document.getElementById( 'listing_amount' ).value;
				var id = company + kode_departemen + channel_code + store_code + region_code + gl_account_name;

				console.log( id, listing_amount );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id,
						listing: listing_amount,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing = data;
							$( '#error_listing' ).html( error_listing );
							finish.disabled = true;
							return false;
						} else {
							var error_listing = data;
							$( '#error_listing' ).html( error_listing );
							finish.disabled = false;
						}
					}
				} );
			} //1

			//Row 2	
			if ( $.trim( $( '#listing_account_code2' ).val() ).length != 0 && $.trim( $( '#listing_amount2' ).val() ).length != 0 ) {
				var gl_account_name2 = "-" + $( '#listing_account_code2' ).val();
				var listing_amount2 = $( '#listing_amount2' ).val();
				var id2 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name2;

				console.log( id2, listing_amount2 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id2,
						listing: listing_amount2,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing2 = data;
							$( '#error_listing2' ).html( error_listing2 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing2 = data;
							$( '#error_listing2' ).html( error_listing2 );
							finish.disabled = false;
						}
					}
				} );
			} //2

			//Row 3
			if ( $.trim( $( '#listing_account_code3' ).val() ).length != 0 && $.trim( $( '#listing_amount3' ).val() ).length != 0 ) {
				var gl_account_name3 = "-" + $( '#listing_account_code3' ).val();
				var listing_amount3 = $( '#listing_amount3' ).val();
				var id3 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name3;

				console.log( id3, listing_amount3 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id3,
						listing: listing_amount3,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing3 = data;
							$( '#error_listing3' ).html( error_listing3 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing3 = data;
							$( '#error_listing3' ).html( error_listing3 );
							finish.disabled = false;
						}
					}
				} );
			} //3	

			//Row 4
			if ( $.trim( $( '#listing_account_code4' ).val() ).length != 0 && $.trim( $( '#listing_amount4' ).val() ).length != 0 ) {
				var gl_account_name4 = "-" + $( '#listing_account_code4' ).val();
				var listing_amount4 = $( '#listing_amount4' ).val();
				var id4 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name4;

				console.log( id4, listing_amount4 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id4,
						listing: listing_amount4,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing4 = data;
							$( '#error_listing4' ).html( error_listing4 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing4 = data;
							$( '#error_listing4' ).html( error_listing4 );
							finish.disabled = false;
						}
					}
				} );
			} //4

			//Row 5
			if ( $.trim( $( '#listing_account_code5' ).val() ).length != 0 && $.trim( $( '#listing_amount5' ).val() ).length != 0 ) {
				var gl_account_name5 = "-" + $( '#listing_account_code5' ).val();
				var listing_amount5 = $( '#listing_amount5' ).val();
				var id5 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name5;

				console.log( id5, listing_amount5 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id5,
						listing: listing_amount5,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing5 = data;
							$( '#error_listing5' ).html( error_listing5 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing5 = data;
							$( '#error_listing5' ).html( error_listing5 );
							finish.disabled = false;
						}
					}
				} );
			} //5

			//Row 6
			if ( $.trim( $( '#listing_account_code6' ).val() ).length != 0 && $.trim( $( '#listing_amount6' ).val() ).length != 0 ) {
				var gl_account_name6 = "-" + $( '#listing_account_code6' ).val();
				var listing_amount6 = $( '#listing_amount6' ).val();
				var id6 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name6;

				console.log( id6, listing_amount6 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id6,
						listing: listing_amount6,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing6 = data;
							$( '#error_listing6' ).html( error_listing6 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing6 = data;
							$( '#error_listing6' ).html( error_listing6 );
							finish.disabled = false;
						}
					}
				} );
			} //6

			//Row 7
			if ( $.trim( $( '#listing_account_code7' ).val() ).length != 0 && $.trim( $( '#listing_amount7' ).val() ).length != 0 ) {
				var gl_account_name7 = "-" + $( '#listing_account_code7' ).val();
				var listing_amount7 = $( '#listing_amount7' ).val();
				var id7 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name7;

				console.log( id7, listing_amount7 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id7,
						listing: listing_amount7,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing7 = data;
							$( '#error_listing7' ).html( error_listing7 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing7 = data;
							$( '#error_listing7' ).html( error_listing7 );
							finish.disabled = false;
						}
					}
				} );
			} //7

			//Row 8
			if ( $.trim( $( '#listing_account_code8' ).val() ).length != 0 && $.trim( $( '#listing_amount8' ).val() ).length != 0 ) {
				var gl_account_name8 = "-" + $( '#listing_account_code8' ).val();
				var listing_amount8 = $( '#listing_amount8' ).val();
				var id8 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name8;

				console.log( id8, listing_amount8 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id8,
						listing: listing_amount8,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing8 = data;
							$( '#error_listing8' ).html( error_listing8 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing8 = data;
							$( '#error_listing8' ).html( error_listing8 );
							finish.disabled = false;
						}
					}
				} );
			} //8

			//Row 9
			if ( $.trim( $( '#listing_account_code9' ).val() ).length != 0 && $.trim( $( '#listing_amount9' ).val() ).length != 0 ) {
				var gl_account_name9 = "-" + $( '#listing_account_code9' ).val();
				var listing_amount9 = $( '#listing_amount9' ).val();
				var id9 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name9;

				console.log( id9, listing_amount9 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id9,
						listing: listing_amount9,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing9 = data;
							$( '#error_listing9' ).html( error_listing9 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing9 = data;
							$( '#error_listing9' ).html( error_listing9 );
							finish.disabled = false;
						}
					}
				} );
			} //9

			//Row 10
			if ( $.trim( $( '#listing_account_code10' ).val() ).length != 0 && $.trim( $( '#listing_amount10' ).val() ).length != 0 ) {
				var gl_account_name10 = "-" + $( '#listing_account_code10' ).val();
				var listing_amount10 = $( '#listing_amount10' ).val();
				var id10 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name10;

				console.log( id10, listing_amount10 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_listing'); ?>",
					method: "POST",
					data: {
						id: id10,
						listing: listing_amount10,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_listing10 = data;
							$( '#error_listing10' ).html( error_listing10 );
							finish.disabled = true;
							return false;
						} else {
							var error_listing10 = data;
							$( '#error_listing10' ).html( error_listing10 );
							finish.disabled = false;
						}
					}
				} );
			} //10
			
			//trading term
			
			if ( $.trim( $( '#trading_account_code' ).val() ).length != 0 && $.trim( $( '#trading_amount' ).val() ).length != 0 ) {
				var gl_account_name = "-" + $( '#trading_account_code' ).val();
				var trading_amount = $( '#trading_amount' ).val();
				var id = company + kode_departemen + channel_code + store_code + region_code + gl_account_name;

				console.log( id, trading_amount );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id,
						trading: trading_amount,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading = data;
							$( '#error_trading' ).html( error_trading );
							finish.disabled = true;
							return false;
						} else {
							var error_trading = data;
							$( '#error_trading' ).html( error_trading );
							finish.disabled = false;
						}
					}
				} );
			}
			
			//row2
			if ( $.trim( $( '#trading_account_code2' ).val() ).length != 0 && $.trim( $( '#trading_amount2' ).val() ).length != 0 ) {
				var gl_account_name2 = "-" + $( '#trading_account_code2' ).val();
				var trading_amount2 = $( '#trading_amount2' ).val();
				var id2 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name2;

				console.log( id2, trading_amount2 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id2,
						trading: trading_amount2,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading2 = data;
							$( '#error_trading2' ).html( error_trading2 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading2 = data;
							$( '#error_trading2' ).html( error_trading2 );
							finish.disabled = false;
						}
					}
				} );
			}//2
			
			//row3
			if ( $.trim( $( '#trading_account_code3' ).val() ).length != 0 && $.trim( $( '#trading_amount3' ).val() ).length != 0 ) {
				var gl_account_name3 = "-" + $( '#trading_account_code3' ).val();
				var trading_amount3 = $( '#trading_amount3' ).val();
				var id3 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name3;

				console.log( id, trading_amount );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id3,
						trading: trading_amount3,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading3 = data;
							$( '#error_trading3' ).html( error_trading3 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading3 = data;
							$( '#error_trading3' ).html( error_trading3 );
							finish.disabled = false;
						}
					}
				} );
			}//3
			
			//row4
			if ( $.trim( $( '#trading_account_code4' ).val() ).length != 0 && $.trim( $( '#trading_amount4' ).val() ).length != 0 ) {
				var gl_account_name4 = "-" + $( '#trading_account_code4' ).val();
				var trading_amount4 = $( '#trading_amount4' ).val();
				var id4 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name4;

				console.log( id4, trading_amount4 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id4,
						trading: trading_amount4,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading4 = data;
							$( '#error_trading4' ).html( error_trading4 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading4 = data;
							$( '#error_trading4' ).html( error_trading4 );
							finish.disabled = false;
						}
					}
				} );
			}//4
			
			//row5
			if ( $.trim( $( '#trading_account_code5' ).val() ).length != 0 && $.trim( $( '#trading_amount5' ).val() ).length != 0 ) {
				var gl_account_name5 = "-" + $( '#trading_account_code5' ).val();
				var trading_amount5 = $( '#trading_amount5' ).val();
				var id5 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name5;

				console.log( id5, trading_amount5 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id5,
						trading: trading_amount5,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading5 = data;
							$( '#error_trading5' ).html( error_trading5 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading5 = data;
							$( '#error_trading5' ).html( error_trading5 );
							finish.disabled = false;
						}
					}
				} );
			}//5
			
			//row6
			if ( $.trim( $( '#trading_account_code6' ).val() ).length != 0 && $.trim( $( '#trading_amount6' ).val() ).length != 0 ) {
				var gl_account_name6 = "-" + $( '#trading_account_code6' ).val();
				var trading_amount6 = $( '#trading_amount6' ).val();
				var id6 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name6;

				console.log( id6, trading_amount6 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id6,
						trading: trading_amount6,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading6 = data;
							$( '#error_trading6' ).html( error_trading6 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading6 = data;
							$( '#error_trading6' ).html( error_trading6 );
							finish.disabled = false;
						}
					}
				} );
			}//6
			
			//row7
			if ( $.trim( $( '#trading_account_code7' ).val() ).length != 0 && $.trim( $( '#trading_amount7' ).val() ).length != 0 ) {
				var gl_account_name7 = "-" + $( '#trading_account_code7' ).val();
				var trading_amount7 = $( '#trading_amount7' ).val();
				var id7 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name7;

				console.log( id, trading_amount );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id7,
						trading: trading_amount7,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading7 = data;
							$( '#error_trading7' ).html( error_trading7 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading7 = data;
							$( '#error_trading7' ).html( error_trading7 );
							finish.disabled = false;
						}
					}
				} );
			}//7
			
			//row8
			if ( $.trim( $( '#trading_account_code8' ).val() ).length != 0 && $.trim( $( '#trading_amount8' ).val() ).length != 0 ) {
				var gl_account_name8 = "-" + $( '#trading_account_code8' ).val();
				var trading_amount8 = $( '#trading_amount8' ).val();
				var id8 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name8;

				console.log( id8, trading_amount8 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id8,
						trading: trading_amount8,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading8 = data;
							$( '#error_trading8' ).html( error_trading8 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading8 = data;
							$( '#error_trading8' ).html( error_trading8 );
							finish.disabled = false;
						}
					}
				} );
			}//8
			
			//row9
			if ( $.trim( $( '#trading_account_code9' ).val() ).length != 0 && $.trim( $( '#trading_amount9' ).val() ).length != 0 ) {
				var gl_account_name9 = "-" + $( '#trading_account_code9' ).val();
				var trading_amount9 = $( '#trading_amount9' ).val();
				var id9 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name9;

				console.log( id9, trading_amount9 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id9,
						trading: trading_amount9,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading9 = data;
							$( '#error_trading9' ).html( error_trading9 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading9 = data;
							$( '#error_trading9' ).html( error_trading9 );
							finish.disabled = false;
						}
					}
				} );
			}//9
			
			//row10
			if ( $.trim( $( '#trading_account_code10' ).val() ).length != 0 && $.trim( $( '#trading_amount10' ).val() ).length != 0 ) {
				var gl_account_name10 = "-" + $( '#trading_account_code10' ).val();
				var trading_amount10 = $( '#trading_amount10' ).val();
				var id10 = company + kode_departemen + channel_code + store_code + region_code + gl_account_name10;

				console.log( id10, trading_amount10 );
				$.ajax( {
					url: "<?php echo site_url('promotion_form/get_budgetSaldo_trading'); ?>",
					method: "POST",
					data: {
						id: id10,
						trading: trading_amount10,
						year: fiscal_year
					},
					async: true,
					dataType: 'json',
					success: function ( data ) {
						console.log( data );
						
						if (data != null){
							var error_trading10 = data;
							$( '#error_trading10' ).html( error_trading10 );
							finish.disabled = true;
							return false;
						} else {
							var error_trading10 = data;
							$( '#error_trading10' ).html( error_trading10 );
							finish.disabled = false;
						}
					}
				} );
			}//10
		} );

		var i = 1;
		$( '#add' ).click( function () {
			i++;
			$( '#product_field' ).append( "<tr id='row" + i + "'>" +
				"<td width='375px'><?php echo cmb_dinamis2('product_name[]', 'product_list', 'product_name', 'product_code', $product_code, 'ASC', 'product_name') ?></td>" +
				"<td width='150px'><?php echo cmb_dinamis2('category_1[]', 'product_category', 'category_name', 'category_id', $category_id, 'ASC', 'category_1') ?></td>" +
				"<td width='150px'><?php echo cmb_dinamis2('category_2[]', 'product_category', 'category_name', 'category_id', $category_id, 'ASC', 'category_2') ?></td>" +
				"<td><input type='text' name='baseline_sales[]' class='form-control' id='baseline_sales' value='<?php echo $baseline_sales; ?>' /></td>" +
				"<td><input type='text' name='incremental_sales[]' class='form-control' id='incremental_sales' value='<?php echo $incremental_sales; ?>' /></td>" +
				"<td><button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_remove'>Delete</button></td>" +
				"</tr>" );
		} );

		$( document ).on( 'click', '.btn_remove', function () {
			var button_id = $( this ).attr( "id" );
			$( '#row' + button_id + '' ).remove();
		} );

		var j = 1;
		$( '#add1' ).click( function () {
			j++;
			$( '#listing_field' ).append( "<tr id='row" + j + "'>" +
				"<td width='115px'><?php echo cmb_dinamis2('listing_activity[]', 'listing_activity', 'listing_activity_name', 'listing_activity_id', $listing_activity_id, 'ASC', 'listing_activity') ?></td>" +
				"<td width='250px'><select class='form-control' id='listing_account_code" + j + "' name='listing_account_code[]' style='width:250px'><option></option></select></td>" +
				"<td><input type='text' id='listing_amount" + j + "' name='listing_amount[]' class='form-control' value='<?php echo $listing_amount; ?>' /><span id='error_listing" + j + "'> </span></td>" +
				"<td><input type='text' id='listing_source_of_fund' name='listing_source_of_fund[]' class='form-control' value='<?php echo $listing_source_of_fund; ?>' /></td>" +
				"<td><textarea class='form-control' rows='1' id='listing_remarks' name='listing_remarks[]' value='<?php echo $listing_remarks; ?>'></textarea></td>" +
				"<td><button type='button' name='remove1' id='" + j + "' class='btn btn-danger btn_remove1'>Delete</button></td>" +
				"</tr>" );
		} );

		$( document ).on( 'click', '.btn_remove1', function () {
			var button_id = $( this ).attr( "id" );
			$( '#row' + button_id + '' ).remove();
		} );

		var k = 1;
		$( '#add2' ).click( function () {
			k++;
			$( '#promo_field' ).append( "<tr id='row" + k + "'>" +
				"<td width='180px'><?php echo cmb_dinamis2('promo_activity[]', 'on_top_promo_activity', 'promo_activity_name', 'promo_activity_id', $promo_activity_id, 'ASC', 'promo_activity') ?></td>" +
				"<td width='250px'><select class='form-control' id='promo_account_code" + k + "' name='promo_account_code[]' style='width:250px'><option></option></select></td>" +
				"<td><input type='text' class='form-control' id='promo_amount" + k + "' name='promo_amount[]' value='<?php echo $promo_amount; ?>' /><span id='error_promo" + k + "'> </span></td>" +
				"<td><input type='text' class='form-control' id='promo_source_of_fund' name='promo_source_of_fund[]' value='<?php echo $promo_source_of_fund; ?>' /></td>" +
				"<td><textarea class='form-control' rows='1' id='promo_remarks' name='promo_remarks[]' value='<?php echo $promo_remarks; ?>'></textarea></td>" +
				"<td><button type='button' name='remove2' id='" + k + "' class='btn btn-danger btn_remove2'>Delete</button></td>" +
				"</tr>" );
		} );

		$( document ).on( 'click', '.btn_remove2', function () {
			var button_id = $( this ).attr( "id" );
			$( '#row' + button_id + '' ).remove();
		} );

		var l = 1;
		$( '#add3' ).click( function () {
			l++;
			$( '#trading_field' ).append( "<tr id='row" + l + "'>" +
				"<td width='30%'><?php echo cmb_dinamis2('trading_activity[]', 'trading_term_activity', 'trading_activity_name', 'trading_activity_id', $trading_activity_id, 'ASC', 'trading_activity') ?></td>" +
				"<td><select class='form-control select2' id='trading_account_code" + l + "' name='trading_account_code[]' style='width:100%'><option></option></select></td>" +
				"<td><input type='text' class='form-control' id='trading_amount" + l + "' name='trading_amount[]' value='<?php echo $trading_amount; ?>' /><span id='error_trading" + l + "' class='text-danger'></span></td>" +
				"<td><button type='button' name='remove3' id='" + l + "' class='btn btn-danger btn_remove3'>Delete</button></td>" +
				"</tr>" );
		} );

		$( document ).on( 'click', '.btn_remove3', function () {
			var button_id = $( this ).attr( "id" );
			$( '#row' + button_id + '' ).remove();
		} );

	} );

	$( document ).on( 'click', '.btn_remove_product', function () {
		$( '#table_product' ).remove();
		document.getElementById( "product_field" ).style.display = "";
		document.getElementById( "product_name" ).disabled = false;
		document.getElementById( "category_1" ).disabled = false;
		document.getElementById( "category_2" ).disabled = false;
		document.getElementById( "baseline_sales" ).disabled = false;
		document.getElementById( "incremental_sales" ).disabled = false;
	} );

	function Upload_product() {
		//Hide & Disable form input product
		document.getElementById( "product_field" ).style.display = "none";
		document.getElementById( "product_name" ).disabled = true;
		document.getElementById( "category_1" ).disabled = true;
		document.getElementById( "category_2" ).disabled = true;
		document.getElementById( "baseline_sales" ).disabled = true;
		document.getElementById( "incremental_sales" ).disabled = true;

		//Reference the FileUpload element.
		var fileUpload = document.getElementById( "product" );

		//Validate whether File is valid Excel file.
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
		if ( regex.test( fileUpload.value.toLowerCase() ) ) {
			if ( typeof ( FileReader ) != "undefined" ) {
				var reader = new FileReader();

				//For Browsers other than IE.
				if ( reader.readAsBinaryString ) {
					reader.onload = function ( e ) {
						ProcessExcel( e.target.result );
					};
					reader.readAsBinaryString( fileUpload.files[ 0 ] );
				} else {
					//For IE Browser.
					reader.onload = function ( e ) {
						var data = "";
						var bytes = new Uint8Array( e.target.result );
						for ( var i = 0; i < bytes.byteLength; i++ ) {
							data += String.fromCharCode( bytes[ i ] );
						}
						ProcessExcel( data );
					};
					reader.readAsArrayBuffer( fileUpload.files[ 0 ] );
				}
			} else {
				alert( "This browser does not support HTML5." );
			}
		} else {
			alert( "Please upload a valid Excel file." );
		}
	};

	function ProcessExcel( data ) {
		//Read the Excel File data.
		var workbook = XLSX.read( data, {
			type: 'binary'
		} );

		//Fetch the name of First Sheet.
		var firstSheet = workbook.SheetNames[ 0 ];

		//Read all rows from First Sheet into an JSON array.
		var excelRows = XLSX.utils.sheet_to_row_object_array( workbook.Sheets[ firstSheet ] );

		//Create a HTML Table element.
		var table = document.createElement( "table" );
		table.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		table.id = "table_product";

		//Add the header row.
		var row = table.insertRow( -1 );

		//Add the header cells.
		var headerCell = document.createElement( "TH" );
		headerCell.innerHTML = "Product Name";
		headerCell.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		row.appendChild( headerCell );

		headerCell = document.createElement( "TH" );
		headerCell.innerHTML = "Category 1";
		headerCell.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		row.appendChild( headerCell );

		headerCell = document.createElement( "TH" );
		headerCell.innerHTML = "Category 2";
		headerCell.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		row.appendChild( headerCell );

		headerCell = document.createElement( "TH" );
		headerCell.innerHTML = "Baseline Sales (HET)";
		headerCell.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		row.appendChild( headerCell );

		headerCell = document.createElement( "TH" );
		headerCell.innerHTML = "Incremental Sales (HET)";
		headerCell.setAttribute( "style", "color: #000; border-color: #4C4C4C; border: 1px solid #CCC;" );
		row.appendChild( headerCell );

		//Add the data rows from Excel file.
		for ( var i = 0; i < excelRows.length; i++ ) {
			
			if (isNaN(excelRows[ i ].Baseline_Sales || excelRows[ i ].Incremental_Sales)){
				alert('Please Check!! baseline and incremental cannot be 0 or empty');
			} else {
			if (excelRows[ i ].Baseline_Sales != 0 || excelRows[ i ].Incremental_Sales != 0){
			
			//Add the data row.
			var row = table.insertRow( -1 );
			var product = document.createElement( "SELECT" );
			var category1 = document.createElement( "SELECT" );
			var category2 = document.createElement( "SELECT" );
			var baseline_sales = document.createElement( "INPUT" );
			var incremental_sales = document.createElement( "INPUT" );

			//Add the data cells.
			var cell = row.insertCell( -1 );
			product.innerHTML = "<option value=" + excelRows[ i ].Product_Code + ">" + excelRows[ i ].Product_Name + "</option>";
			product.name = "product_name[]";
			product.id = "upload_product_name";
			product.setAttribute( "readonly", "readonly" );
			product.setAttribute( "class", "form-control" );
			product.setAttribute( "style", "background-color: #fff; -moz-appearance: none; -webkit-appearance: none;" );
			cell.appendChild( product );

			cell = row.insertCell( -1 );
			category1.innerHTML = "<option value=" + excelRows[ i ].Category_id_1 + ">" + excelRows[ i ].Category_1 + "</option>";
			category1.name = "category_1[]";
			category1.id = "upload_category_1";
			category1.setAttribute( "readonly", "readonly" );
			category1.setAttribute( "class", "form-control select2" );
			category1.setAttribute( "style", "background-color: #fff; -moz-appearance: none; -webkit-appearance: none;" );
			cell.appendChild( category1 );

			cell = row.insertCell( -1 );
			category2.innerHTML = "<option value=" + excelRows[ i ].Category_id_2 + ">" + excelRows[ i ].Category_2 + "</option>";
			category2.name = "category_2[]";
			category2.id = "upload_category_2";
			category2.setAttribute( "readonly", "readonly" );
			category2.setAttribute( "class", "form-control select2" );
			category2.setAttribute( "style", "background-color: #fff; -moz-appearance: none; -webkit-appearance: none;" );
			cell.appendChild( category2 );

			cell = row.insertCell( -1 );
			baseline_sales.type = "text";
			baseline_sales.id = "upload_baseline_sales";
			baseline_sales.name = "baseline_sales[]";
			baseline_sales.setAttribute( "readonly", "readonly" );
			baseline_sales.setAttribute( "class", "form-control" );
			baseline_sales.setAttribute( "style", "background-color: #fff" );
			if(isNaN(excelRows[ i ].Baseline_Sales)){
				baseline_sales.value = 0;
			} else {
				baseline_sales.value = Math.round(excelRows[ i ].Baseline_Sales);
			}
			cell.appendChild( baseline_sales );

			cell = row.insertCell( -1 );
			incremental_sales.type = "text";
			incremental_sales.id = "upload_incremental_sales";
			incremental_sales.name = "incremental_sales[]";
			incremental_sales.setAttribute( "readonly", "readonly" );
			incremental_sales.setAttribute( "class", "form-control" );
			incremental_sales.setAttribute( "style", "background-color: #fff" );
			if(isNaN(excelRows[ i ].Incremental_Sales)){
				incremental_sales.value = 0;
			} else {
				incremental_sales.value = Math.round(excelRows[ i ].Incremental_Sales);
			}
			cell.appendChild( incremental_sales );
				
			} else {
				alert('Please Check!! baseline and incremental cannot be 0 or empty');
			}
			
		}

		}

		var dvExcel = document.getElementById( "dvExcel" );
		dvExcel.innerHTML = "";
		dvExcel.appendChild( table );
	};
</script>
<script>
	var baseline_sales = document.getElementById( "baseline_sales" );
	baseline_sales.addEventListener( "keyup", function ( e ) {
		baseline_sales.value = convertRupiah( this.value );
	} );
	baseline_sales.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	var incremental_sales = document.getElementById( "incremental_sales" );
	incremental_sales.addEventListener( "keyup", function ( e ) {
		incremental_sales.value = convertRupiah( this.value );
	} );
	incremental_sales.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	var listing_amount = document.getElementById( "listing_amount" );
	listing_amount.addEventListener( "keyup", function ( e ) {
		listing_amount.value = convertRupiah( this.value );
	} );
	listing_amount.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	var promo_amount = document.getElementById( "promo_amount" );
	promo_amount.addEventListener( "keyup", function ( e ) {
		promo_amount.value = convertRupiah( this.value );
	} );
	promo_amount.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	var trading_amount = document.getElementById( "trading_amount" );
	trading_amount.addEventListener( "keyup", function ( e ) {
		trading_amount.value = convertRupiah( this.value );
	} );
	trading_amount.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	function convertRupiah( angka, prefix ) {
		var number_string = angka.replace( /[^,\d]/g, "" ).toString(),
			split = number_string.split( "," ),
			sisa = split[ 0 ].length % 3,
			rupiah = split[ 0 ].substr( 0, sisa ),
			ribuan = split[ 0 ].substr( sisa ).match( /\d{3}/gi );

		if ( ribuan ) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join( "." );
		}

		rupiah = split[ 1 ] != undefined ? rupiah + "," + split[ 1 ] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
	}

	function isNumberKey( evt ) {
		key = evt.which || evt.keyCode;
		if ( key != 188 // Comma
			&&
			key != 8 // Backspace
			&&
			key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
			&&
			( key < 48 || key > 57 ) // Non digit
		) {
			evt.preventDefault();
			return;
		}
	}

	$( function () {
		var dtToday = new Date();

		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if ( month < 10 )
			month = '0' + month.toString();
		if ( day < 10 )
			day = '0' + day.toString();

		var minDate = year + '-' + month + '-' + day;

		$( '#periode_awal' ).attr( 'min', minDate );
		$( '#periode_akhir' ).attr( 'min', minDate );
	} );

	$( function () {
		var product_name = document.getElementById( "product_name" );
		var product = document.getElementById( "product" );
	} );
</script>