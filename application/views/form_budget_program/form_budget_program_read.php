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
        <h2 style="margin-top:0px">Form_budget_program Read</h2>
        <table class="table">
	    <tr><td>No P3</td><td><?php echo $no_p3; ?></td></tr>
	    <tr><td>Program Id</td><td><?php echo $program_id; ?></td></tr>
	    <tr><td>Gl Coa</td><td><?php echo $gl_coa; ?></td></tr>
	    <tr><td>Gl Coa Segment</td><td><?php echo $gl_coa_segment; ?></td></tr>
	    <tr><td>Sku Total Cost</td><td><?php echo $sku_total_cost; ?></td></tr>
	    <tr><td>Sku Total Usage</td><td><?php echo $sku_total_usage; ?></td></tr>
	    <tr><td>Sku Total Saldo</td><td><?php echo $sku_total_saldo; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('form_budget_program') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>