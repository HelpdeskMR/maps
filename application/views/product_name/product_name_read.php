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
        <h2 style="margin-top:0px">Product_name Read</h2>
        <table class="table">
	    <tr><td>Product Code</td><td><?php echo $product_code; ?></td></tr>
	    <tr><td>Product Name</td><td><?php echo $product_name; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product_name') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>