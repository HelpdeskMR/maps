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
        <h2 style="margin-top:0px">Product Read</h2>
        <table class="table">
	    <tr><td>Product Name</td><td><?php echo $product_name; ?></td></tr>
	    <tr><td>Product Code</td><td><?php echo $product_code; ?></td></tr>
	    <tr><td>Category 1</td><td><?php echo $category_1; ?></td></tr>
	    <tr><td>Category 2</td><td><?php echo $category_2; ?></td></tr>
	    <tr><td>Baseline Sales</td><td><?php echo $baseline_sales; ?></td></tr>
	    <tr><td>Incremental Sales</td><td><?php echo $incremental_sales; ?></td></tr>
	    <tr><td>SecLogUser</td><td><?php echo $SecLogUser; ?></td></tr>
	    <tr><td>SecLogDate</td><td><?php echo $SecLogDate; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>