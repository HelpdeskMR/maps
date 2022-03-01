<style>
	.table-read {
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}

	.table-read td,
	th {
		border: 1px solid #999;
		padding: 0.5rem;
	}

	.table-read1 {
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}
	
	.table-read1 td {
		padding: 0.5rem;
		text-align: center;
	}
	
	.table-read1 th {
		border: 1px solid #fff;
		background-color: #3c8dbc;
		color: #fff;
		padding: 0.5rem;
		text-align: left;
	}
</style>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<!-- DIV ROW SECTION -->
			<?php if ($this->session->flashdata('over_budget')) : ?>
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Over Budget</h4>
					<?php echo $this->session->flashdata('over_budget'); ?>
				</div>
			<?php endif; ?>
			<div class="col-sm-6">
				<?php if ($receive_status == 0) { ?>
					<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="myForm">
					<?php } else { ?>
						<form action="<?php echo site_url('wf_claim/approve_action') ?>" method="post" class="form-horizontal" id="approve">
						<?php } ?>
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Claim Detail</h3>
							</div>
							<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
								<tr>
									<td width="150px">Tanggal Klaim</td>
									<td width="10px">:</td>
									<td width="550px">
										<strong>
											<?php echo $tgl_claim; ?> |
											<?php echo $claim_number; ?>
										</strong>
									</td>
								</tr>
								<tr>
									<td width="150px">Promosi</td>
									<td width="10px">:</td>
									<td>
										<?php echo $promotion_number; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Nama Promosi</td>
									<td width="10px">:</td>
									<td>
										<?php echo $promotion_name; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Kode Distributor/Store</td>
									<td width="10px">:</td>
									<td>
										<?php echo $kode_distributor; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Nama Distributor/Store</td>
									<td width="10px">:</td>
									<td>
										<?php echo $nama_distributor; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Nomor Invoice</td>
									<td width="10px">:</td>
									<td>
										<?php echo $invoice_number; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Invoice</td>
									<td width="10px">:</td>
									<td>
										<?php if ($invoice == null) {
											echo '<a href="#">';
										} else { ?>
											<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $invoice . '">'; ?>
										<?php } ?>
										<?php echo $invoice; ?>
										</a>
									</td>
								</tr>
								<tr>
									<td width="150px">Nomor Faktur Pajak</td>
									<td width="10px">:</td>
									<td>
										<?php echo $faktur_pajak_number; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Faktur Pajak</td>
									<td width="10px">:</td>
									<td>
										<?php if ($faktur_pajak == null) {
											echo '<a href="#">';
										} else { ?>
											<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $faktur_pajak . '">'; ?>
										<?php } ?>
										<?php echo $faktur_pajak; ?>
										</a>
									</td>
								</tr>
								<tr>
									<td width="150px">Dokumen Klaim</td>
									<td width="10px">:</td>
									<td>
										<?php if ($dokumen == null) {
											echo '<a href="#">';
										} else { ?>
											<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $dokumen . '">'; ?>
										<?php } ?>
										<?php echo $dokumen; ?>
										</a>
									</td>
								</tr>
								<tr>
									<td width="150px">PKP</td>
									<td width="10px">:</td>
									<?php if ($pkp == 1) { ?>
										<td>PKP</td>
									<?php } else { ?>
										<td>NON PKP</td>
									<?php } ?>
								</tr>
								<tr>
									<td width="150px">NPWP/NIK</td>
									<td width="10px">:</td>
									<td>
										<?php echo $npwp; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Keterangan</td>
									<td width="10px">:</td>
									<td>
										<?php echo $keterangan; ?>
									</td>
								</tr>
								<tr>
									<td width="150px">Mekanisme Klaim</td>
									<td width="10px">:</td>
									<td>
										<?php echo $mekanisme_claim; ?>
									</td>
								</tr>
								<tr>
									<td><b><u>Pengajuan Claim</u></b></td>
								</tr>
								<tr>
									<td width="150px">DPP</td>
									<td width="10px">:</td>
									<td>
										<?php echo number_format($dpp); ?>
									</td>
								</tr>
								<tr>
									<td width="150px">PPN 10%</td>
									<td width="10px">:</td>
									<td>
										<?php echo number_format($ppn); ?>%</td>
								</tr>
								<tr>
									<td width="150px">PPH 23</td>
									<td width="10px">:</td>
									<td>
										<?php echo number_format($pph); ?>%</td>
								</tr>
								<tr>
									<td width="150px">Total Claim</td>
									<td width="10px">:</td>
									<td>
										<?php echo number_format($total); ?>
									</td>
								</tr>
								<?php if ($total_rev != 0) { ?>
									<tr>
										<td width="200px"><b><u>Claim Revisi</u></b></td>
									</tr>
									<tr>
										<td width="150px">DPP Revisi</td>
										<td width="10px">:</td>
										<td>
											<?php echo number_format($dpp_rev); ?>
										</td>
									</tr>
									<tr>
										<td width="150px">PPN 10% Revisi</td>
										<td width="10px">:</td>
										<td>
											<?php echo number_format($ppn_rev); ?>%</td>
									</tr>
									<tr>
										<td width="150px">PPH 23 Revisi</td>
										<td width="10px">:</td>
										<td>
											<?php echo number_format($pph_rev); ?>%</td>
									</tr>
									<tr>
										<td width="150px">Total Claim Revisi</td>
										<td width="10px">:</td>
										<td>
											<?php echo number_format($total_rev); ?>
										</td>
									</tr>
								<?php } ?>
							</table>
							<div class="box-footer">
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
								<input type="hidden" name="claim_number" value="<?php echo $claim_number; ?>" />
								<a href="<?php echo site_url('wf_claim'); ?>" class="btn btn-info" style="margin-right:1%"><i class="fa fa-sign-out"></i> Cancel</a>
								<button id="btn-reject" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject<?php echo $claim_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
								<?php
								if ($receive_status == 0) { ?>
									<button type="submit" class="btn btn-warning" onclick="javasciprt: return confirm('Are You Sure to Receive ?')"><i class="fa fa-floppy-o"></i>&nbsp; Receive</button>
									<?php
								} else {
									if ($this->session->userdata('id_user_level') == 13) { ?>
										<button id="btn-approve" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-approve<?php echo $claim_id; ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Approve</button>
									<?php } else { ?>
										<button type="submit" class="btn btn-success" onclick="javasciprt: return confirm('Are You Sure to Receive ?')"><i class="fa fa-floppy-o" aria-hidden="true"></i> Approve</button>
										<!--a href="?php echo site_url('wf_claim/approve_action/'.$claim_id.''); ?>" class="btn btn-success"  style="margin-right:1%" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-floppy-o"></i> Approve</a -->
								<?php }
								}
								?>
							</div>
						</div>
						</form>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<!--div class="box-header with-border" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6f80a1));"-->
					<div class="box-header with-border">
						<h3 class="box-title">Claim Budget</h3>
					</div>
					<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
						<tr>
							<td width="200px">Total Budget Promosi</td>
							<td width="10px">:</td>
							<td width="550px"><?php echo number_format($promotion_total_cost); ?></td>
						</tr>
						<tr>
							<td width="200px">Saldo Budget Promosi</td>
							<td width="10px">:</td>
							<td width="550px"><?php echo number_format($promotion_total_saldo); ?></td>
						</tr>
						<tr>
							<td width="150px">Dpp</td>
							<td width="10px">:</td>
							<td><?php echo number_format($dpp); ?></td>
						</tr>
						<tr>
							<td width="150px">Total Claim</td>
							<td width="10px">:</td>
							<td><?php echo number_format($total); ?></td>
						</tr>
						<?php if ($dpp_rev != 0) { ?>
							<tr>
								<td width="150px">Dpp Revisi</td>
								<td width="10px">:</td>
								<td><?php echo number_format($dpp_rev); ?></td>
							</tr>
							<tr>
								<td width="150px">Total Claim Revisi</td>
								<td width="10px">:</td>
								<td><?php echo number_format($total_rev); ?></td>
							</tr>
						<?php } ?>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Budget Promosi</h3>
					</div>
					<table class='table-read1'>
						<thead>
							<th width="80px">Budget</th>
							<th width="200px">Activity</th>
							<th width="70px">Gl Account</th>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($row_budgetPromotion as $data) { ?>
								<tr>
									<td>
										<?php echo $data['Budget']; ?>
									</td>
									<td style="text-align: left">
										<?php echo $data['activity']; ?>
									</td>
									<td>
										<?php echo $data['gl_account_code']; ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>

					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Term Of Payment</h3>
					</div>
					<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
						<tr>
							<td width="200px">Receive Date</td>
							<td width="10px">:</td>
							<td width="550px"><?php echo $receive_date; ?></td>
						</tr>
						<tr>
							<td width="200px">Term of Payment</td>
							<td width="10px">:</td>
							<td width="550px"><?php echo $top; ?> hari</td>
						</tr>
						<tr>
							<td width="150px">Due Date</td>
							<td width="10px">:</td>
							<td><?php echo $due_date; ?></td>
						</tr>
						<tr>
							<td width="150px">Payment Plan</td>
							<td width="10px">:</td>
							<td><?php echo $payment_plan; ?></td>
						</tr>
						<tr>
							<td width="150px">Payment Date</td>
							<td width="10px">:</td>
							<td><?php echo $payment_date; ?></td>
						</tr>
						<tr>
							<td width="150px">Payment Method</td>
							<td width="10px">:</td>
							<td><?php echo $payment_method; ?></td>
						</tr>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<!-- DIV ROW SECTION -->
		</div>
	</section>
</div>
<!-- modal -->
	<div class="modal fade" id="modal-reject<?php echo $claim_id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Reject Reason</h4>
				</div>
				<form action="<?php echo site_url('wf_claim/reject_action') ?>" method="post" class="form-horizontal" id="reject">
					<div class="modal-body">
						<textarea class="form-control" rows="3" name="reject_reason" id="reject_reason" required></textarea>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="claim_id" id="claim_id" value="<?php echo $claim_id; ?>" />
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->
<!-- modal -->
	<div class="modal fade" id="modal-approve<?php echo $claim_id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Term of Payment</h4>
				</div>
				<form action="<?php echo site_url('wf_claim/approve_action') ?>" method="post" class="form-horizontal" id="approve">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Receive Date</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="receive_date" id="receive_date" value="<?php echo $receive_date; ?>" readonly="readonly" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Term of Payment</label>
							<div class="col-sm-5">
								<?php echo cmb_dinamis1('top', 'term_of_payment', 'top', 'top', $top, 'ASC') ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Payment Method</label>
							<div class="col-sm-5">
								<select class="form-control" id="payment_method" name="payment_method" required style="width: 100%;">
									<option></option>
									<option value="Payment">Payment</option>
									<option value="Settlement">Settlement</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Approval</label>
							<div class="col-sm-5">
								<select class="form-control" id="approval" name="approval" required style="width: 100%;">
									<option></option>
									<?php $no = 0;
									foreach ($row_approval as $approval) : $no++; ?>
										<option value="<?php echo $approval['approval_code']; ?>">
											<?php echo $approval['approval_name']; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="claim_id" id="claim_id" value="<?php echo $claim_id; ?>" />
						<input type="hidden" name="claim_number" value="<?php echo $claim_number; ?>" />
						<input type="hidden" name="total" value="<?php echo $total; ?>" />
						<input type="hidden" name="dpp" value="<?php echo $dpp; ?>" />
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="submit" name="finish" id="finish" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->