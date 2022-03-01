<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Form_claim Read</h2>
        <table class="table">
	    <tr><td>Tgl Claim</td><td><?php echo $tgl_claim; ?></td></tr>
	    <tr><td>Claim Number</td><td><?php echo $claim_number; ?></td></tr>
	    <tr><td>Promotion Number</td><td><?php echo $promotion_number; ?></td></tr>
	    <tr><td>Kode Distributor</td><td><?php echo $kode_distributor; ?></td></tr>
	    <tr><td>Nama Distributor</td><td><?php echo $nama_distributor; ?></td></tr>
	    <tr><td>Dpp</td><td><?php echo $dpp; ?></td></tr>
	    <tr><td>Ppn</td><td><?php echo $ppn; ?></td></tr>
	    <tr><td>Pph</td><td><?php echo $pph; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Invoice Number</td><td><?php echo $invoice_number; ?></td></tr>
	    <tr><td>Invoice</td><td><?php echo $invoice; ?></td></tr>
	    <tr><td>Faktur Pajak Number</td><td><?php echo $faktur_pajak_number; ?></td></tr>
	    <tr><td>Faktur Pajak</td><td><?php echo $faktur_pajak; ?></td></tr>
	    <tr><td>Pkp</td><td><?php echo $pkp; ?></td></tr>
	    <tr><td>Npwp</td><td><?php echo $npwp; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Pemohon</td><td><?php echo $pemohon; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Payment Date</td><td><?php echo $payment_date; ?></td></tr>
	    <tr><td>Approval Scheme</td><td><?php echo $approval_scheme; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('form_claim') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>