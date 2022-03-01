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
        <h2 style="margin-top:0px">Arc_am Read</h2>
        <table class="table">
	    <tr><td>Nama Am</td><td><?php echo $nama_am; ?></td></tr>
	    <tr><td>Region Code</td><td><?php echo $region_code; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_am') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>