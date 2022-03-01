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
        <h2 style="margin-top:0px">Arc_distributor Read</h2>
        <table class="table">
	    <tr><td>Kode Distributor</td><td><?php echo $kode_distributor; ?></td></tr>
	    <tr><td>Nama Distributor</td><td><?php echo $nama_distributor; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Kode Area</td><td><?php echo $kode_area; ?></td></tr>
	    <tr><td>Secloguser</td><td><?php echo $secloguser; ?></td></tr>
	    <tr><td>Seclogdate</td><td><?php echo $seclogdate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_distributor') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>