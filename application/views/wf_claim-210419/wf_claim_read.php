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
        <h2 style="margin-top:0px">Wf_claim Read</h2>
        <table class="table">
	    <tr><td>No Klaim</td><td><?php echo $no_klaim; ?></td></tr>
	    <tr><td>Approval Scheme</td><td><?php echo $approval_scheme; ?></td></tr>
	    <tr><td>Id User Level</td><td><?php echo $id_user_level; ?></td></tr>
	    <tr><td>Approve By</td><td><?php echo $approve_by; ?></td></tr>
	    <tr><td>Approval Date</td><td><?php echo $approval_date; ?></td></tr>
	    <tr><td>Reject By</td><td><?php echo $reject_by; ?></td></tr>
	    <tr><td>Reject Date</td><td><?php echo $reject_date; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wf_claim') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>