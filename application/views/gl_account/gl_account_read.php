<!doctype html>
<html>
    <head>
        <title>ARC</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Gl_account Read</h2>
        <table class="table">
	    <tr><td>Gl Coa</td><td><?php echo $gl_coa; ?></td></tr>
	    <tr><td>Gl Coa Desc</td><td><?php echo $gl_coa_desc; ?></td></tr>
	    <tr><td>IsActive</td><td><?php echo $IsActive; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('gl_account') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>