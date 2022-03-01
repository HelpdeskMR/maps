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
		<div style="padding-bottom: 10px;">
			<a href="<?php echo site_url('welcome/reject_promotion') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Back</a> <a href="<?php echo site_url('promotion_form/pdf/' . $promotion_id . '') ?>" target="parent" class="btn btn-danger"><i class="fa fa-print"></i> Print</a> </div>
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
						<td>
							<font color="#FFFFFF">Baseline Sales (HET)</font>
						</td>
						<td>
							<font color="#FFFFFF">Incremental Sales (HET)</font>
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
						<td align="right">
							<?php echo number_format($row->baseline_sales); ?>
						</td>
						<td align="right">
							<?php echo number_format($row->incremental_sales); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"><b>Total</b>
						</td>
						<td align="right">
							<b>
								<?php echo number_format($total_product_baseline); ?>
							</b>
						</td>
						<td align="right">
							<b>
								<?php echo number_format($total_product_incremental); ?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>

			<!-- 
     /* FINANCIAL KPI */
    -->
			<div style="padding-left:10px; padding-top:10px;"><b>FINANCIAL KPI</b>
			</div>
			<table class="table-read">
				<thead bgcolor="#3C8DBC">
					<tr>
						<!--td>No</td-->
						<th>
							<font color="#FFFFFF">Desc</font>
						</th>
						<th>
							<font color="#FFFFFF">Baseline</font>
						</th>
						<th>
							<font color="#FFFFFF">% HET</font>
						</th>
						<th>
							<font color="#FFFFFF">Incremental</font>
						</th>
						<th>
							<font color="#FFFFFF">% HET</font>
						</th>
						<th>
							<font color="#FFFFFF">Total</font>
						</th>
						<th>
							<font color="#FFFFFF">% HET</font>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;
          foreach ($row_financial_kpi as $row) : $no++; ?>
					<tr>
						<!--td width="10px"><?php echo $no; ?></td-->
						<?php if ($row->description == 'Net Sales') { ?>
						<td>
							<strong>
								<?php echo $row->description; ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total_het); ?> %</strong>
						</td>
						<?php } else if ($row->description == 'Net Amount') { ?>
						<td>
							<strong>
								<?php echo $row->description; ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total_het); ?> %</strong>
						</td>
						<?php } else if ($row->description == 'Cost') { ?>
						<td>
							<strong>
								<?php echo $row->description; ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->baseline_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->incremental_het); ?> %</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total); ?>
							</strong>
						</td>
						<td align="right">
							<strong>
								<?php echo number_format($row->total_het); ?> %</strong>
						</td>
						<?php } else { ?>
						<td>
							<?php echo $row->description; ?>
						</td>
						<td align="right">
							<?php echo number_format($row->baseline); ?>
						</td>
						<td align="right">
							<?php echo number_format($row->baseline_het); ?> %</td>
						<td align="right">
							<?php echo number_format($row->incremental); ?>
						</td>
						<td align="right">
							<?php echo number_format($row->incremental_het); ?> %</td>
						<td align="right">
							<?php echo number_format($row->total); ?>
						</td>
						<td align="right">
							<?php echo number_format($row->total_het); ?> %</td>
						<?php } ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<!-- 
     /* TRADING TERM */
    -->
			<div style="padding-left:10px; padding-top:20px;"><b>TRADING TERM</b>
			</div>
			<table class="table-read">
				<thead bgcolor="#3C8DBC">
					<tr>
						<!--td>No</td-->
						<td>
							<font color="#FFFFFF">Activity</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Name</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Code</font>
						</td>
						<td>
							<font color="#FFFFFF">AMOUNT</font>
						</td>
						<td>
							<font color="#FFFFFF">% to Incremental Sales</font>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;
          foreach ($row_trading_term as $row) : $no++; ?>
					<tr>
						<!--td width="10px"><?php echo $no; ?></td-->
						<td>
							<?php echo $row['trading_activity_name']; ?>
						</td>
						<td>
							<?php echo $row['gl_coa_desc']; ?>
						</td>
						<td>
							<?php echo $row['gl_account_code']; ?>
						</td>
						<td align="right">
							<?php echo number_format($row['amount']); ?>
						</td>
						<td align="right">
							<?php echo $row['incremental_sales']; ?> %</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"><b>Total</b>
						</td>
						<td align="right">
							<b>
								<?php echo number_format($total_trading_amount); ?>
							</b>
						</td>
						<td align="right">
							<b>
								<?php echo $total_trading_percent; ?> %</b>
						</td>
					</tr>
				</tbody>
			</table>

			<!-- 
     /* LISTING COST */
    -->
			<div style="padding-left:10px; padding-top:20px;"><b>LISTING COST</b>
			</div>
			<table class="table-read">
				<thead bgcolor="#3C8DBC">
					<tr>
						<!--td>No</td-->
						<td>
							<font color="#FFFFFF">Activity</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Name</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Code</font>
						</td>
						<td>
							<font color="#FFFFFF">AMOUNT</font>
						</td>
						<td>
							<font color="#FFFFFF">% to Incremental Sales</font>
						</td>
						<td>
							<font color="#FFFFFF">Source of Fund</font>
						</td>
						<td>
							<font color="#FFFFFF">Remarks</font>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;
          foreach ($row_listing_cost as $row) : $no++; ?>
					<tr>
						<!--td width="10px"><?php echo $no; ?></td-->
						<td>
							<?php echo $row->listing_activity_name; ?>
						</td>
						<td>
							<?php echo $row->gl_coa_desc; ?>
						</td>
						<td>
							<?php echo $row->gl_account_code; ?>
						</td>
						<td align="right">
							<?php echo number_format($row->amount); ?>
						</td>
						<td align="right">
							<?php echo $row->incremental_sales; ?> %</td>
						<td>
							<?php echo $row->source_fund; ?>
						</td>
						<td width="300px">
							<?php echo $row->remark; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"><b>Total</b>
						</td>
						<td align="right">
							<b>
								<?php echo number_format($total_listing_cost); ?>
							</b>
						</td>
						<td align="right">
							<b>
								<?php echo $listing_incremental_sales; ?> %</b>
						</td>
						<td colspan="2"></td>
					</tr>
				</tbody>
			</table>

			<!-- 
     /* ON TOP PROMO */
    -->
			<div style="padding-left:10px; padding-top:20px;"><b>ON TOP PROMO</b>
			</div>
			<table class="table-read">
				<thead bgcolor="#3C8DBC">
					<tr>
						<!--td>No</td-->
						<td>
							<font color="#FFFFFF">Activity</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Name</font>
						</td>
						<td>
							<font color="#FFFFFF">GL Account Code</font>
						</td>
						<td>
							<font color="#FFFFFF">AMOUNT</font>
						</td>
						<td>
							<font color="#FFFFFF">% to Incremental Sales</font>
						</td>
						<td>
							<font color="#FFFFFF">Source of Fund</font>
						</td>
						<td>
							<font color="#FFFFFF">Remarks</font>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0;
          foreach ($row_on_top_promo as $row) : $no++; ?>
					<tr>
						<!--td width="10px"><?php echo $no; ?></td-->
						<td>
							<?php echo $row->promo_activity_name; ?>
						</td>
						<td>
							<?php echo $row->gl_coa_desc; ?>
						</td>
						<td>
							<?php echo $row->gl_account_code; ?>
						</td>
						<td align="right">
							<?php echo number_format($row->amount); ?>
						</td>
						<td align="right">
							<?php echo $row->incremental_sales; ?> %</td>
						<td>
							<?php echo $row->source_fund; ?>
						</td>
						<td width="300px">
							<?php echo $row->remark; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"><b>Total</b>
						</td>
						<td align="right">
							<b>
								<?php echo number_format($total_on_top_promo); ?>
							</b>
						</td>
						<td align="right">
							<b>
								<?php echo $promo_incremental_sales; ?> %</b>
						</td>
						<td colspan="2"></td>
					</tr>
				</tbody>
			</table>

			<!-- 
     /* LIST APPROVAL */
    -->

			<div class="row">
				<table class="table-approve">
					<thead>
						<tr>
							<th width="11%" rowspan="2">
								<p>Proposed by :</p>
							</th>
							<?php if ($row_wf_program_max == $row_approval_program_max || $row_wf_program_max == 5) { ?>
							<th rowspan="2" colspan="3">
								<p>Reviewed by :</p>
							</th>
							<?php } else if ($row_wf_program_max == 3) { ?>
							<th rowspan="2" colspan="1">
								<p>Reviewed by :</p>
							</th>
							<?php } else { ?>
							<th rowspan="2" colspan="2">
								<p>Reviewed by :</p>
							</th>
							<?php } ?>
							<th rowspan="2" colspan="2">
								<p>Finance Dept</p>
							</th>
							<th colspan="2">
								<div align="center">Approved by :</div>
							</th>
						</tr>
						<tr>
							<th>Sales Director</th>
							<th>Finance Director</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p style="text-align:center; padding-top:15px">
									<b>
										<?php echo ucwords(strtolower($pemohon)); ?>
									</b>
								</p>
								<br/>
								<span>Date :&nbsp;<i><?php echo $date_create; ?></i></span>
							</td>
							<td width="12%">
								<?php $no = 0;
                              foreach ($row_approve_scheme1 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                  echo "KAM";
                                } else if ($row['id_user_level'] == 5) {
                                  echo "NKAM";
                                } else if ($row['id_user_level'] == 7) {
                                  echo "TMM";
                                } else if ($row['id_user_level'] == 16) {
                                  echo "RSM";
                                }
                    ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<td width="12%">
								<?php $no = 0;
                              foreach ($row_approve_scheme2 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                  echo "KAM";
                                } else if ($row['id_user_level'] == 5) {
                                  echo "NKAM";
                                } else if ($row['id_user_level'] == 7) {
                                  echo "TMM";
                                } else if ($row['id_user_level'] == 16) {
                                  echo "RSM";
                                }
                    ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<td width="12%">
								<?php $no = 0;
                              foreach ($row_approve_scheme3 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                  echo "KAM";
                                } else if ($row['id_user_level'] == 5) {
                                  echo "NKAM";
                                } else if ($row['id_user_level'] == 7) {
                                  echo "TMM";
                                } else if ($row['id_user_level'] == 16) {
                                  echo "RSM";
                                }
                    ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<td width="12%">
								<?php $no = 0;
                              foreach ($row_approve_scheme4 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                  echo "KAM";
                                } else if ($row['id_user_level'] == 5) {
                                  echo "NKAM";
                                } else if ($row['id_user_level'] == 7) {
                                  echo "TMM";
                                } else if ($row['id_user_level'] == 16) {
                                  echo "RSM";
                                }
                    ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<td width="12%">
								<?php $no = 0;
                              foreach ($row_approve_scheme5 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                  echo "KAM";
                                } else if ($row['id_user_level'] == 5) {
                                  echo "NKAM";
                                } else if ($row['id_user_level'] == 7) {
                                  echo "TMM";
                                } else if ($row['id_user_level'] == 16) {
                                  echo "RSM";
                                }
                    ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<?php if ($row_wf_program_max != 3) { ?>
							<td width="12%">
								<?php $no = 0;
                                foreach ($row_approve_scheme6 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<?php } ?>
							<?php if ($row_wf_program_max == $row_approval_program_max || $row_wf_program_max == 5) { ?>
							<td width="12%">
								<?php $no = 0;
                                foreach ($row_approve_scheme7 as $row) : $no++; ?>
								<p style="text-align:center; padding-top:15px">
									<?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br/>
									<b>
										<?php echo ucwords(strtolower($row['full_name'])); ?>
									</b>
								</p>
								<?php if ($row['approve_by'] != null) { ?>
								<br/>
								<span class='badge badge-success'><strong>Approved</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php if ($row['reject_by'] != null) { ?>
								<br/>
								<span class='badge badge-danger'><strong>Rejected</strong></span><br/>
								<span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
								<?php } else { ?>
								<span></span>
								<?php } ?>
								<?php endforeach; ?>
							</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		<?php if ($row_reject_reason != NULL) { ?>
			<div class="row" style="padding-top: 1%">
				<p style="padding-left: 1%">*<b>Reject Reason</b> : <?php echo $row_reject_reason; ?></p>
				<br/>
			</div>
		<?php } ?>
			<div class="box-footer"> <a href="<?php echo site_url('promotion_form') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Back</a> <a href="<?php echo site_url('promotion_form/pdf/' . $promotion_id . '') ?>" target="parent" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
	</section>
</div>