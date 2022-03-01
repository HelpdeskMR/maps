<style>
	.badge-success {
		color: #fff;
		background-color: #28a745;
	}
	
	.badge-danger {
		color: #fff;
		background-color: #DB3236;
	}
	
	.badge {
		display: inline-block;
		padding: .25em .4em;
		font-size: 14px;
		font-weight: 700;
		line-height: 1;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25rem;
		transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	}
	
	.row {
		padding-top: 3%;
	}
	
	.table-read {
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}
	
	.table-approve {
		border: 1px solid #999;
		border-spacing: 0.5rem;
		border-collapse: collapse;
		text-align: center;
		padding: 8px 8px 8px 8px;
	}
	
	.table-read td,
	th {
		border: 1px solid #999;
		padding: 0.5rem;
	}
	
	.table-approve td,
	th {
		border: 1px solid #999;
		text-align: center;
	}
	
	.smalls-box {
		border-radius: 2px;
		position: relative;
		display: block;
		border: 1px solid #999;
	}
	
	.col-mod {
		float: left;
		position: relative;
		min-height: 1px;
		margin-left: 5px;
		margin-right: 5px;
		text-align: left;
	}

</style>
<div class="content-wrapper">
	<section class="content">
	<div style="padding-bottom: 10px;"><a href="<?php echo site_url('promotion_view') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Back</a> <a href="<?php echo site_url('promotion_view/pdf/' . $promotion_id . '') ?>" target="parent" class="btn btn-danger"><i class="fa fa-print"></i> Print</a> </div>
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">PROMOTION FORM</h3>
			</div>
			<table class='table' style="padding-top:20px">
				<tr>
					<td width="150px">Date</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $date_create; ?>
					</td>
					<td width="150px">Promotion Number</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid; border-color:#A2A2A2;" width="430px">
						<?php echo $promotion_number; ?>
					</td>
				</tr>
				<tr>
					<td width="150px">Departemen</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $nama_departemen; ?>
					</td>
					<td width="150px">Channel</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid; border-color:#A2A2A2;" width="430px">
						<?php echo $channel_name; ?>
					</td>
				</tr>
				<tr>
					<td width="150px">Promotion Name</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $promotion_name; ?>
					</td>
					<td width="150px">Region</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid; border-color:#A2A2A2;" width="430px">
						<?php echo $nama_region; ?>
					</td>
				</tr>
				<tr>
					<td width="150px">Start Period</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $periode_awal; ?>
					</td>
					<td width="150px">Area</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid; border-color:#A2A2A2;" width="430px">
						<?php echo $nama_area; ?>
					</td>
				</tr>
				<tr>
					<td width="150px">End Period</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $periode_akhir; ?>
					</td>
					<td width="150px">Store</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid; border-color:#A2A2A2;" width="430px">
						<?php echo $store_name; ?>
					</td>
				</tr>
				<tr>
					<td width="150px">Fiscal Year</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php echo $fiscal_year; ?>
					</td>
					<td width="150px">File</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php if ($upload_file == null) {
                                                                        echo '<a href="#">';
                                                                      } else { ?>
						<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $upload_file . '">'; ?>
						<?php } ?>
						<?php echo $upload_file; ?>
						</a>
					</td>
				</tr>
				<tr>
					<td width="150px"></td>
					<td width="10px"></td>
					<td></td>
					<td width="150px">File Activity</td>
					<td width="10px">:</td>
					<td style="border-bottom: 1px solid;border-color:#A2A2A2;">
						<?php if ($upload_activity == null) {
                                                                        echo '<a href="#">';
                                                                      } else { ?>
						<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $upload_activity . '">'; ?>
						<?php } ?>
						<?php echo $upload_activity; ?>
						</a>
					</td>
				</tr>
			</table>
			<!-- 
     /* SALES INFORMATION */
    -->
			<table class="table">
				<tr>
					<td colspan="3"><b><u>SALES INFORMATION</u></b>
					</td>
				</tr>
				<tr>
					<td><u><strong>Background</strong></u>
					</td>
					<td></td>
					<td><u><strong>Objective</u>
						</strong>
					</td>
				</tr>
				<tr>
					<td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_background; ?></textarea>
					</td>
					<td></td>
					<td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_objective; ?></textarea>
					</td>
				</tr>
				<tr>
					<td style="padding-top:10px"><u><strong>Strategy</u>
						</strong>
					</td>
					<td></td>
					<td style="padding-top:10px"><u><strong>Mechanism</u>
						</strong>
					</td>
				</tr>
				<tr>
					<td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_strategy; ?></textarea>
					</td>
					<td></td>
					<td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_mechanism; ?></textarea>
					</td>
				</tr>
			</table>

			<!-- 
     /* PRODUCT */
    -->
			<div style="padding-left:10px; padding-top:20px;"><b>PRODUCT</b>
			</div>
			<table class="table-read">
				<thead bgcolor="#3C8DBC">
					<tr>
						<!--td>No</td-->
						<td>
							<font color="#FFFFFF">Product Name</font>
						</td>
						<td>
							<font color="#FFFFFF">Category 1</font>
						</td>
						<td>
							<font color="#FFFFFF">Category 2</font>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;
          foreach ($row_product as $row) : $no++; ?>
					<tr>
						<!--td width="10px"><?php echo $no; ?></td-->
						<td>
							<?php echo $row->product_name; ?>
						</td>
						<td>
							<?php echo $row->cotegory_name_1; ?>
						</td>
						<td>
							<?php echo $row->cotegory_name_2; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			<div class="box-footer">
				<a href="<?php echo site_url('promotion_view') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Back</a>
				<a href="<?php echo site_url('promotion_view/pdf/' . $promotion_id . '') ?>" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
	</section>
</div>