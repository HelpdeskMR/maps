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
        <h2 style="margin-top:0px">Arc_region Read</h2>
        <table class="table">
	    <tr><td>Nama Region</td><td><?php echo $nama_region; ?></td></tr>
	    <tr><td>Rsm Id</td><td><?php echo $rsm_id; ?></td></tr>
	    <tr><td>Secloguser</td><td><?php echo $secloguser; ?></td></tr>
	    <tr><td>Seclogdate</td><td><?php echo $seclogdate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_region') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>