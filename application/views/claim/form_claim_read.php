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
			<div class="col-sm-6">
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
								<?php if ($invoice == null)
{ echo '<a href="#">';}
else {?>
								<?php echo '<a target="parent" href="'.base_url().'uploads/'.$invoice.'">'; ?>
								<?php }?>
								<?php echo $invoice;?>
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
								<?php if ($faktur_pajak == null)
{ echo '<a href="#">';}
else {?>
								<?php echo '<a target="parent" href="'.base_url().'uploads/'.$faktur_pajak.'">'; ?>
								<?php }?>
								<?php echo $faktur_pajak;?>
								</a>
							</td>
						</tr>
						<tr>
							<td width="150px">Dokumen Klaim</td>
							<td width="10px">:</td>
							<td>
								<?php if ($dokumen == null)
{ echo '<a href="#">';}
else {?>
								<?php echo '<a target="parent" href="'.base_url().'uploads/'.$dokumen.'">'; ?>
								<?php }?>
								<?php echo $dokumen;?>
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
						<tr><td><b><u>Pengajuan Claim</u></b></td></tr>
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
					<?php if($total_rev != 0) { ?>
						<tr><td width="200px"><b><u>Claim Revisi</u></b></td></tr>
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
					<?php if($bukti_potong != NULL) { ?>
						<tr><td width="200px"><b><u>Bukti Potong</u></b></td></tr>
						<tr>
							<td width="150px">No Bukti Potong</td>
							<td width="10px">:</td>
							<td>
								<?php echo $no_bukti_potong; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Bukti Potong</td>
							<td width="10px">:</td>
							<td>
								<a href="<?php echo base_url('uploads/'); ?><?php echo $bukti_potong; ?>"><?php echo $bukti_potong; ?></a>
							</td>
						</tr>
					<?php } ?>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<!--div class="box-header with-border" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6f80a1));"-->
					<div class="box-header with-border">
						<h3 class="box-title">Term Of Payment</h3>
					</div>
					<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
						<tr>
							<td width="200px">Receive Status</td>
							<td width="10px">:</td>
							<td width="550px">
								<?php if($receive_status == 1) { echo "Received"; } else { echo "";} ?>
							</td>
						</tr>
						<tr>
							<td width="200px">Receive Date</td>
							<td width="10px">:</td>
							<td width="550px">
								<?php echo $receive_date; ?>
							</td>
						</tr>
						<tr>
							<td width="200px">Term of Payment</td>
							<td width="10px">:</td>
							<td width="550px">
								<?php echo $top; ?> hari</td>
						</tr>
						<tr>
							<td width="150px">Due Date</td>
							<td width="10px">:</td>
							<td>
								<?php echo $due_date; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Plan</td>
							<td width="10px">:</td>
							<td>
								<?php echo $payment_plan; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Date</td>
							<td width="10px">:</td>
							<td>
								<?php echo $payment_date; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Method</td>
							<td width="10px">:</td>
							<td>
								<?php echo $payment_method; ?>
							</td>
						</tr>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<?php if($this->session->userdata('id_user_level') != 17 || $this->session->userdata('id_user_level') != 18) { ?>
			<div class="col-sm-6">
				<div class="box">
					<!--div class="box-header with-border" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6f80a1));"-->
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
							<?php $no = 1; foreach ($row_budgetPromotion as $data) { ?>
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
			<?php } ?>
			<?php if($this->session->userdata('id_user_level') == 17 || $this->session->userdata('id_user_level') == 18) { ?>
			<div class="col-sm-6">
				<div class="box">
					<!--div class="box-header with-border" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6f80a1));"-->
					<div class="box-header with-border">
						<h3 class="box-title">Approval Status</h3>
					</div>
					<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
						<tr>
							<td width="170px">Status</td>
							<td width="10px">:</td>
							<td><?php echo $status_name; ?></td>
						</tr>
						<tr>
							<td>Date</td>
							<td>:</td>
							<td><?php echo $wfLogDate; ?></td>
						</tr>
						<?php if($reject_reason != NULL) { ?>
						<tr>
							<td>Reject Reason</td>
							<td>:</td>
							<td><?php echo $reject_reason; ?></td>
						</tr>
						<?php } else { ?>
						<?php } ?>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<?php } else { ?>
			<div class="col-sm-6">
				<div class="box">
					<!--div class="box-header with-border" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6f80a1));"-->
					<div class="box-header with-border">
						<h3 class="box-title">Approval List</h3>
					</div>
					<table class='table-read1'>
						<thead>
							<th width="35px">No</th>
							<th width="80px">Status</th>
							<th width="150px">Approved/Rejected By</th>
							<th width="150px">Date</th>
							<th>Reason</th>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($wf_claim as $data) { ?>
							<tr>
								<td>
									<?php echo $data['approval_scheme']; ?>
								</td>
								<td>
									<?php if($data['approve_by'] == NULL && $data['reject_by'] == NULL){echo "Waiting";}elseif($data['approve_by'] != NULL){echo "Approved";}else{echo "Rejected";} ?>
								</td>
								<td style="text-align: left">
									<?php echo $data['full_name']; ?>
								</td>
								<td>
									<?php if($data['approve_by'] != NULL){echo $data['approval_date'];}else{echo $data['reject_date'];} ?>
								</td>
								<td>
									<?php echo $data['reject_reason']; ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>

					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<?php } ?>
			<!-- DIV ROW SECTION -->
		</div>
		<div class="row" >
			<div class="col-sm-6">
				<!-- <a href="<?php echo base_url("claim"); ?>" class="btn btn-danger btn-sm"><i class="fa fa fa-sign-out"></i> Back</a> -->
				<a class="btn btn-danger btn-sm" onclick="history.go(-1)"><i class="fa fa fa-sign-out"></i> Back</a>
			<?php if($status == 4) { ?>
			<a href="<?php echo base_url("claim/pdf/$claim_id"); ?>" class="btn btn-success btn-sm"><i class="fa  fa-file-pdf-o"></i> Print</a>
			<?php } ?>
			</div>
		</div>
		</br>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.10.2.js' ?>"></script>
<script src="<?php echo base_url('assets/js/number-divider.js') ?>"></script>
<script src="<?php echo base_url('assets/js/number-divider.min.js') ?>"></script>
<script type="text/javascript">
	$( document ).ready( function () {
		$( '#top' ).change( function () {
			var numberOfDaysToAdd = $( this ).val();
			var someDate = new Date();
			if ( numberOfDaysToAdd == 30 ) {
				someDate.setDate( someDate.getDate() + 30 );
			} else if ( numberOfDaysToAdd == 60 ) {
				someDate.setDate( someDate.getDate() + 60 );
			} else {
				someDate.setDate( someDate.getDate() + 90 ); //number  of days to add, e.x. 15 days
			}
			var dateFormated = someDate.toISOString().substr( 0, 10 );
			console.log( dateFormated );
			document.getElementById( 'due_date' ).value = dateFormated;
		} );
	} );
</script>