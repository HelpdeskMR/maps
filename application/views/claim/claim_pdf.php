<style>
	.table-read {
		width: 90%;
		font-family: 'calibri';
    	font-size:12px;
	}
	
	.table-read td {
/*		border-bottom: 1px solid #dee2e6;*/
		padding: 0.3srem;
	}
	
	.table-read1 {
		border-spacing: 0.3rem;
		border-collapse: collapse;
		width: 90%;
		font-family: 'calibri';
    	font-size:12px;
	}
	
	.table-read1 td {
		padding: 0.3rem;
		text-align: center;
	}
	
	.table-read1 th {
		border: 1px solid #fff;
		background-color: #3c8dbc;
		color: #fff;
		padding: 0.3rem;
		text-align: left;
	}
	
	@page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 5cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 1cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
	.page_break { page-break-before: always; }

</style>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
			<header>
				<table class="table-read1">
					<tr>
						<td style="padding-right: 50px"></td>
						<td width="150px"><img width="150px" src="<?php echo base_url('assets/images/Mustika_Ratu_Vertical.png'); ?>" /></td>
						<td width="500px" style="padding-left: -50px"><p align="center"><h2 style="text-align: center; padding-right: 5%"><b>PT. Mustika Ratubuana International</b></h2><br/><h4 style="text-align: center">Jl. Raya Bogor KM 26,4 Ciracas Jakarta Timur 13740<br/>Telp. : (021)8312323, Website : www.mustika-ratu.co.id</h4></p></td>
					</tr>
				</table>
			</header>
			</div>
			<div class="col-sm-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title" style="text-align: center"><u>Pengajuan Claim</u></h3>
					</div>
					<table class='table-read'>
						<tr>
							<td width="150px">Tanggal Klaim | No Klaim</td>
							<td width="10px">:</td>
							<td width="250px">
								<strong>
									<?php echo $tgl_claim; ?> |
									<?php echo $claim_number; ?>
								</strong>
							</td>
						</tr>
						<tr>
							<td width="150px">Promosi</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $promotion_number; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Nama Promosi</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $promotion_name; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Kode Distributor/Store</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $kode_distributor; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Nama Distributor/Store</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $nama_distributor; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Nomor Invoice</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $invoice_number; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Invoice</td>
							<td width="10px">:</td>
							<td width="250px">
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
							<td width="250px">
								<?php echo $faktur_pajak_number; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Faktur Pajak</td>
							<td width="10px">:</td>
							<td width="250px">
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
							<td width="250px">
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
							<td width="250px">PKP</td>
							<?php } else { ?>
							<td width="250px">NON PKP</td>
							<?php } ?>
						</tr>
						<tr>
							<td width="150px">NPWP/NIK</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $npwp; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Keterangan</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $keterangan; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Mekanisme Klaim</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $mekanisme_claim; ?>
							</td>
						</tr>
					</table>
					<hr/>
					<table class='table-read'>
						<?php if($total_rev != 0) { ?>
						<tr>
							<td><b><u>Pengajuan Claim</u></b></td>
							<td></td>
							<td></td>
							<td width="200px"><b><u>Claim Revisi</u></b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">DPP</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($dpp); ?>
							</td>
							<td width="150px">DPP Revisi</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($dpp_rev); ?>
							</td>
						</tr>
						<tr>
							<td width="150px">PPN 10%</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($ppn); ?>%</td>
							<td width="150px">PPN 10% Revisi</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($ppn_rev); ?>%</td>
						</tr>
						<tr>
							<td width="150px">PPH 23</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($pph); ?>%</td>
							<td width="150px">PPH 23 Revisi</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($pph_rev); ?>%</td>
						</tr>
						<tr>
							<td width="150px">Total Claim</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($total); ?>
							</td>
							<td width="150px">Total Claim Revisi</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo number_format($total_rev); ?>
							</td>
						</tr>
						<?php } else { ?>
						<tr>
							<td><b><u>Pengajuan Claim</u></b></td>
						</tr>
						<tr>
							<td width="150px">DPP</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo number_format($dpp); ?>
							</td>
						</tr>
						<tr>
							<td width="150px">PPN 10%</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo number_format($ppn); ?>%</td>
						</tr>
						<tr>
							<td width="150px">PPH 23</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo number_format($pph); ?>%</td>
						</tr>
						<tr>
							<td width="150px">Total Claim</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo number_format($total); ?>
							</td>
						</tr>
						<?php } ?>
					</table>
					<table class='table-read'>
					<?php if($bukti_potong == NULL) { ?>
						<tr>
							<td><b><u>Term of Payment</u></b></td>
						</tr>
						<tr>
							<td width="150px">Receive Status</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php if($receive_status == 1) { echo "Received"; } else { echo "";} ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Receive Date</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $receive_date; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Term of Payment</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $top; ?> hari</td>
						</tr>
						<tr>
							<td width="150px">Due Date</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $due_date; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Plan</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $payment_plan; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Date</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $payment_date; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Payment Method</td>
							<td width="10px">:</td>
							<td width="250px">
								<?php echo $payment_method; ?>
							</td>
						</tr>
					<?php } else { ?>
						<tr>
							<td><b><u>Term of Payment</u></b></td>
							<td></td>
							<td></td>
							<td width="200px"><b><u>Bukti Potong</u></b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">Receive Status</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php if($receive_status == 1) { echo "Received"; } else { echo "";} ?>
							</td>
							<td width="150px">No Bukti Potong</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $no_bukti_potong; ?>
							</td>
						</tr>
						<tr>
							<td width="150px">Receive Date</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $receive_date; ?>
							</td>
							<td width="150px">Bukti Potong</td>
							<td width="10px">:</td>
							<td width="100px">
								<a href="<?php echo base_url('uploads/'); ?><?php echo $bukti_potong; ?>"><?php echo $bukti_potong; ?></a>
							</td>
						</tr>
						<tr>
							<td width="150px">Term of Payment</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $top; ?> hari</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">Due Date</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $due_date; ?>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">Payment Plan</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $payment_plan; ?>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">Payment Date</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $payment_date; ?>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td width="150px">Payment Method</td>
							<td width="10px">:</td>
							<td width="100px">
								<?php echo $payment_method; ?>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php } ?>
					</table>
				<div class="page_break">
					<div class="col-sm-12">
			<header>
				<table class="table-read1">
					<tr>
						<td style="padding-right: 50px"></td>
						<td width="150px"><img width="150px" src="<?php echo base_url('assets/images/Mustika_Ratu_Vertical.png'); ?>" /></td>
						<td width="500px" style="padding-left: -70px"><p align="center"><h2 style="text-align: center; padding-right: 5%"><b>PT. Mustika Ratubuana International</b></h2><br/><h4 style="text-align: center">Jl. Raya Bogor KM 26,4 Ciracas Jakarta Timur 13740<br/>Telp. : (021)8312323, Website : www.mustika-ratu.co.id</h4></p></td>
					</tr>
				</table>
			</header>
			</div>
			<?php if($this->session->userdata('id_user_level') != 17 || $this->session->userdata('id_user_level') != 18) { ?>
					<h3 class="box-title" style="text-align: center"><u>Budget Promosi</u></h3>
					<table class='table-read1'>
						<thead>
							<th width="80px">Budget</th>
							<th width="250px">Activity</th>
							<th width="70px">Gl Account</th>
						</thead>
					</table>
					<table class='table-read1'>
						<tbody>
							<?php $no = 1; foreach ($row_budgetPromotion as $data) { ?>
							<tr>
								<td width="80px">
									<?php echo $data['Budget']; ?>
								</td>
								<td style="text-align: left" width="250px">
									<?php echo $data['activity']; ?>
								</td>
								<td width="70px">
									<?php echo $data['gl_account_code']; ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>

					</table>
					<br/>
					<br/>
				<?php } ?>
					<h3 class="box-title" style="text-align: center"><u>Approval List</u></h3>
					<table class='table-read1'>
						<thead>
							<th width="20px">No</th>
							<th width="80px">Status</th>
							<th width="150px">Approved/Rejected By</th>
							<th width="150px">Date</th>
							<th width="200px">Reason</th>
						</thead>
					</table>
					<table class='table-read1'>
						<tbody>
							<?php $no = 1; foreach ($wf_claim as $data) { ?>
							<tr>
								<td width="20px">
									<?php echo $data['approval_scheme']; ?>
								</td>
								<td width="80px">
									<?php if($data['approve_by'] == NULL && $data['reject_by'] == NULL){echo "Waiting";}elseif($data['approve_by'] != NULL){echo "Approved";}else{echo "Rejected";} ?>
								</td>
								<td style="text-align: left" width="150px">
									<?php echo $data['full_name']; ?>
								</td>
								<td width="150px">
									<?php if($data['approve_by'] != NULL){echo $data['approval_date'];}else{echo $data['reject_date'];} ?>
								</td>
								<td width="200px">
									<?php echo $data['reject_reason']; ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>

					</table>
				</div>
					<div class="box-footer"> </div>
				</div>
			</div>
			<!-- DIV ROW SECTION -->
		</div>
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