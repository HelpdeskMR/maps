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
        <h2 style="margin-top:0px">Arc_distributor_margin Read</h2>
        <table class="table">
	    <tr><td>Kode Departemen</td><td><?php echo $kode_departemen; ?></td></tr>
	    <tr><td>Channel Code</td><td><?php echo $channel_code; ?></td></tr>
	    <tr><td>Store Code</td><td><?php echo $store_code; ?></td></tr>
	    <tr><td>Region Code</td><td><?php echo $region_code; ?></td></tr>
	    <tr><td>Margin</td><td><?php echo $margin; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td>SeclogDate</td><td><?php echo $SeclogDate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_distributor_margin') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>