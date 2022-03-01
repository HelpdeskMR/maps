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
					<div class="box-header with-border">
						<h3 class="box-title">List Produk Pengganti</h3>
					</div>
					<table class='table table-striped' style="padding-top:20px; padding-left: 20px">
						<thead>
							<tr>
								<td><b>Product</b></td>
								<td><b>Qty</b></td>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0;
                            foreach ($row_product as $row) : $no++; ?>
							<tr>
								<td width="500px"><?php echo $row['product_name']; ?></td>
								<td><?php echo $row['qty']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<div class="box-footer"> </div>
				</div>
			</div>
			<!-- DIV ROW SECTION -->
		</div>
		<div class="row" >
			<div class="col-sm-6">
			<a class="btn btn-warning btn-sm" onclick="history.go(-1)"><i class="fa fa fa-sign-out"></i> Back</a>
			<a href="<?php echo site_url('wf_pengganti_barang/approve_action/'.$code.''); ?>" class="btn btn-success" style="margin-right:1%; margin-left:1%;" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-floppy-o"></i> Approve</a>
      		<button id="btn-reject" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject<?php echo $code; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
			</div>
		</div>
		</br>
	</section>
</div>
<div class="modal fade" id="modal-reject<?php echo $code; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reject Reason</h4>
      </div>
      <form action="<?php echo site_url('wf_pengganti_barang/reject_action') ?>" method="post" class="form-horizontal" id="reject">
        <div class="modal-body">
          <textarea class="form-control" rows="3" name="reject_reason" id="reject_reason" required></textarea>
        </div>
        <div class="modal-footer">
        	<input type="hidden" name="code" id="code" value="<?php echo $code; ?>" />
          	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          	<button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
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