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
        <h2 style="margin-top:0px">Approval_claim Read</h2>
        <table class="table">
	    <tr><td>Approval Scheme</td><td><?php echo $approval_scheme; ?></td></tr>
	    <tr><td>Id User Level</td><td><?php echo $id_user_level; ?></td></tr>
	    <tr><td>Kode Region</td><td><?php echo $kode_region; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('approval_claim') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>