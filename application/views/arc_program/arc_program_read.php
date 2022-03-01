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
        <h2 style="margin-top:0px">Arc_program Read</h2>
        <table class="table">
	    <tr><td>Nama Program</td><td><?php echo $nama_program; ?></td></tr>
	    <tr><td>Secloguser</td><td><?php echo $secloguser; ?></td></tr>
	    <tr><td>Seclogdate</td><td><?php echo $seclogdate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('arc_program') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>