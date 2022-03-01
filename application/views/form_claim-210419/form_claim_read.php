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
	    <tr><td>Kode Distributor</td><td><?php echo $kode_distributor; ?></td></tr>
	    <tr><td>Nama Distributor</td><td><?php echo $nama_distributor; ?></td></tr>
	    <tr><td>Tgl Klaim</td><td><?php echo $tgl_klaim; ?></td></tr>
	    <tr><td>No P3</td><td><?php echo $no_p3; ?></td></tr>
	    <tr><td>Program Id</td><td><?php echo $program_id; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Claim Dpp</td><td><?php echo $claim_dpp; ?></td></tr>
	    <tr><td>Claim Ppn</td><td><?php echo $claim_ppn; ?></td></tr>
	    <tr><td>Claim Pph</td><td><?php echo $claim_pph; ?></td></tr>
	    <tr><td>Total Claim</td><td><?php echo $total_claim; ?></td></tr>
	    <tr><td>Faktur Pajak</td><td><?php echo $faktur_pajak; ?></td></tr>
	    <tr><td>Npwp</td><td><?php echo $npwp; ?></td></tr>
	    <tr><td>Pemohon</td><td><?php echo $Pemohon; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('form_claim') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>