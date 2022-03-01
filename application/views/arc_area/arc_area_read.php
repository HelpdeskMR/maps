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
        <h2 style="margin-top:0px">Arc_area Read</h2>
        <table class="table">
	    <tr><td>Kode Area</td><td><?php echo $kode_area; ?></td></tr>
	    <tr><td>Nama Area</td><td><?php echo $nama_area; ?></td></tr>
	    <tr><td>Region Id</td><td><?php echo $region_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_area') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>