<div class="content-wrapper">
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">FORM PENGGANTI BARANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date Create</label>
                                <input type="date" class="form-control" name="date_create" id="date_create" value="<?php echo $date_create; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Claim Number</label>
                                <select class="form-control select2" id="claim_number" name="claim_number" style="width: 100%;">
                                    <option></option>
                                    <?php $no = 0;
                                    foreach ($row_claim_barang as $row) : $no++; ?>
                                        <option value="<?php echo $row->claim_number; ?>" <?php if($row->claim_number == $claim_number) {echo 'selected';} ?>><?php echo $row->claim_number; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="code_pengganti_barang" value="<?php echo $code_pengganti_barang; ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                                <a href="<?php echo site_url('pengganti_barang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="product-field">
                                <table class="table table-wizard" id="product_field" style="width: 100%; ">
                                    <tr>
                                        <td>Product Name</td>
                                        <td>Qty</td>
                                        <td>Action</td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <?php echo cmb_dinamis2('product_name[]', 'product_list', 'product_name', 'product_code', $product_code, 'ASC', 'product_name') ?>
                                        </td>
                                        <td width="15%"><input type="text" name="qty[]" class="form-control" id="qty" value="<?php echo $qty; ?>" />
                                        </td>
                                        <td width="5%"><button type="button" name="add" id="add" class="btn btn-success">Add</button>
                                        </td>
                                    </tr>
                                    <?php if($button == 'Edit') { ?>
                                        <?php $no = 0;
                                        foreach ($row_product as $data) : $no++; ?>
                                        <tr id="row<?php echo $no; ?>">
                                            <td width="40%">
                                                <?php echo cmb_dinamis2('product_name[]', 'product_list', 'product_name', 'product_code', $data['product_code'], 'ASC', 'product_name') ?>
                                            </td>
                                            <td width="15%"><input type="text" name="qty[]" class="form-control" id="qty" value="<?php echo $data['qty']; ?>" />
                                            </td>
                                            <td width="5%"><button type='button' name='remove' id='<?php echo $no; ?>' class='btn btn-danger btn_remove'>Delete</button></td>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.10.2.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/xlsx.full.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jszip.js' ?>"></script>
<script type="text/javascript">
	$( document ).ready( function () {
    var i = 1;
		$( '#add' ).click( function () {
			i++;
			$( '#product_field' ).append( "<tr id='row" + i + "'>" +
				"<td width='375px'><?php echo cmb_dinamis2('product_name[]', 'product_list', 'product_name', 'product_code', $product_code, 'ASC', 'product_name') ?></td>" +
				"<td><input type='text' name='qty[]' class='form-control' id='qty' value='<?php echo $qty; ?>' /></td>" +
				"<td><button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_remove'>Delete</button></td>" +
				"</tr>" );
		} );

		$( document ).on( 'click', '.btn_remove', function () {
			var button_id = $( this ).attr( "id" );
			$( '#row' + button_id + '' ).remove();
		} );
    });
</script>