<style>
table.dataTable thead th,
table.dataTable thead td {
    white-space: nowrap;
}
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><strong>EDIT PENGAJUAN KLAIM</strong></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="row">
              <div class="box box-warning box-solid"> 
			 <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Success</h4>
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
              <?php endif; ?>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="myForm">
                <input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
                  <input type="hidden" class="form-control" name="pemohon" id="pemohon" placeholder="Pemohon" value="<?php echo $this->session->userdata('full_name'); ?>" />
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal Klaim<?php echo form_error('tgl_claim') ?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php echo $tgl_claim; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Kode Distributor/Store</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="" 
                            value="<?php if($this->session->userdata('kode_distributor') === NULL) {
								echo $this->session->userdata('store_code');
								} else {
									echo $this->session->userdata('kode_distributor');
								} ; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nama Distributor</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $this->session->userdata('full_name'); ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">DPP <?php echo form_error('dpp') ?></label>
                          <div class="col-sm-5">
                            <input type="text" maxlength="20" class="form-control" name="dpp" id="dpp" placeholder="" value="<?php echo $dpp; ?>"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label" unit="%">PPN 10% <?php echo form_error('ppn') ?></label>
                          <label ></label>
                          <div class="col-sm-5">
                            <input type="number"  min="0" max="10" class="form-control" name="ppn" id="ppn" placeholder="%" value="<?php echo $ppn; ?>" />
                          </div>
						</div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PPH 23 <?php echo form_error('pph') ?></label>
                          <div class="col-sm-5">
                            <input type="number"  min="0" max="15" class="form-control" name="pph" id="pph" placeholder="%" value="<?php echo $pph; ?>" />
                          </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label" unit="%">Nilai PPN 10%</label>
						  <div class="col-sm-5">
							<input type="text" id="valuePpn" value="<?php echo $nilai_ppn; ?>" class="form-control" readonly="readonly" />
                          </div>
                        </div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Nilai PPH 23</label>
						  <div class="col-sm-5">
							<input type="text" id="valuePph" value="<?php echo $nilai_pph; ?>" class="form-control" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Total Claim <?php echo form_error('total') ?></label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" name="total" id="total" placeholder="" value="<?php echo $total; ?>" readonly="readonly" />
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-sm-3 control-label">Mekanisme Klaim</label>
                          <div class="col-sm-5">
                            <select class="form-control select2" id="mekanisme_claim" name="mekanisme_claim" style="width: 100%;" >
                                <option value=""></option>
								<option value="Uang" <?php if($mekanisme_claim == 'Uang') { echo "selected";} ?> >Uang</option>
								<option value="Barang" <?php if($mekanisme_claim == 'Barang') { echo "selected";} ?> >Barang</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">&nbsp;</label>
                          <div class="col-sm-9"> &nbsp; </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Promosi <?php echo form_error('promotion_number') ?></label>
                          <div class="col-sm-9">
                            <select class="form-control select2" id="promotion_number" name="promotion_number" style="width: 100%;">
                              <option></option>
                              <?php $no = 0;
                              foreach ($row_promotion as $row) : $no++; ?>
                                <option value="<?php echo $row['promotion_number']; ?>" <?php if($row['promotion_number'] == $promotion_number) { echo "selected";} ?>>
                                  <?php echo $row['promotion_number']; ?> - <?php echo $row['promotion_name']; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>

                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nomor Invoice <?php echo form_error('invoice') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="invoice_number" id="invoice_number" placeholder="" value="<?php echo $invoice_number; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Upload Invoice</label>
                          <div class="col-sm-9">
                            <input type="file" id="invoice" name="invoice" class="form-control" />
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-sm-3 control-label"></label>
                          <div class="col-sm-9">
                            <div><?php if ($invoice == null)
{ echo '<a href="#"> Tidak Ada';}
else {?> <?php echo '<a target="parent" href="'.base_url().'uploads/'.$invoice.'">'; ?> <?php }?><?php echo $invoice;?></a></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nomor Faktur Pajak <?php echo form_error('faktur_pajak') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="faktur_pajak_number" id="faktur_pajak_number" placeholder="" value="<?php echo $faktur_pajak_number; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Upload Faktur Pajak</label>
                          <div class="col-sm-9">
                            <input type="file" id="faktur_pajak" name="faktur_pajak" class="form-control" />
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-sm-3 control-label"></label>
                          <div class="col-sm-9">
                            <div><?php if ($faktur_pajak == null)
{ echo '<a href="#"> Tidak Ada';}
else {?> <?php echo '<a target="parent" href="'.base_url().'uploads/'.$faktur_pajak.'">'; ?> <?php }?><?php echo $faktur_pajak;?></a></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Upload Dokumen Klaim</label>
                          <div class="col-sm-9">
                            <input type="file" id="dokumen" name="dokumen" class="form-control" />
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-sm-3 control-label"></label>
                          <div class="col-sm-9">
                            <div><?php if ($dokumen == null)
{ echo '<a href="#"> Tidak Ada';}
else {?> <?php echo '<a target="parent" href="'.base_url().'uploads/'.$dokumen.'">'; ?> <?php }?><?php echo $dokumen;?></a></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PKP <?php echo form_error('pkp') ?></label>
                          <div class="col-sm-9"> <?php echo form_dropdown('pkp', array('1' => 'PKP', '2' => 'NON PKP'), $pkp, array('class' => 'form-control')) ?></div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">NPWP/NIK <?php echo form_error('npwp') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="" value="<?php echo $npwp; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Keterangan <?php echo form_error('deskripsi') ?></label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder=""><?php echo $keterangan; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer"> <a href="<?php echo site_url('claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a>
                      <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>&nbsp; Edit</button>
                      <!--button class="btn btn-danger" name="finish" id="finish"><i class="fa fa-floppy-o"></i> Save</button-->
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.10.2.js' ?>"></script>
<script src="<?php echo base_url('assets/js/number-divider.js') ?>"></script>
<script src="<?php echo base_url('assets/js/number-divider.min.js') ?>"></script>
<script type="text/javascript">
$( document ).ready( function () {
	$( '#promotion_number' ).change( function () {
			var id = $( this ).val();
			$.ajax( {
				url: "<?php echo site_url('claim/get_promotion_name'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function ( data ) {
					var html = '';
					var i;
					html = '<option></option>';
					for ( i = 0; i < data.length; i++ ) {
						html += '<option value=' + data[ i ].promotion_name + '>' + data[ i ].promotion_name + '</option>';
					}
					$( '#promotion_name' ).html( html );

				}
			} );
			return false;
		} );
}
</script>

<script type="text/javascript">
 $(document).ready(function () {
       $("#myForm input").keyup(multInputs);

       function multInputs() {
           var mult = 0;
           // for each row:
           $("form#myForm").each(function () {
               // get the values from this row:
               var $dpp = $('#dpp', this).val();
               var $ppn = $('#ppn', this).val();
               var $pph = $('#pph', this).val();
               var $total = ($dpp * 1) + (($dpp * 1) * ($ppn/100 )) - (($dpp* 1) * ($pph/100 ))
               $('#total',this).val($total);
               mult += $total;
           });
          // $("#grandTotal").text(mult);
       }
  });
</script>

<script type="text/javascript">
	$( document ).ready( function () {
		document.getElementById("dpp").oninput = function () {
			var dpp = document.getElementById("dpp").value;
			document.getElementById("ppn").oninput = function () {
				var ppn = document.getElementById("ppn").value;
				document.getElementById("pph").oninput = function () {
					var pph = document.getElementById("pph").value;

					console.log(dpp,ppn,pph);

					var valuePpn = dpp * (ppn/100);
					var valuePph = dpp * (pph/100);
					
					console.log(valuePpn,valuePph);

					document.getElementById('valuePpn').value = valuePpn;
					document.getElementById('valuePph').value = valuePph;
				}
			}
		}
	});
</script>

<script>
	/* var claim_dpp = document.getElementById( "claim_dpp" );
	claim_dpp.addEventListener( "keyup", function ( e ) {
		claim_dpp.value = convertRupiah( this.value );
	} );
	claim_dpp.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	var trading_amount = document.getElementById( "trading_amount" );
	trading_amount.addEventListener( "keyup", function ( e ) {
		trading_amount.value = convertRupiah( this.value );
	} );
	trading_amount.addEventListener( 'keydown', function ( event ) {
		return isNumberKey( event );
	} );

	function convertRupiah( angka, prefix ) {
		var number_string = angka.replace( /[^,\d]/g, "" ).toString(),
			split = number_string.split( "," ),
			sisa = split[ 0 ].length % 3,
			rupiah = split[ 0 ].substr( 0, sisa ),
			ribuan = split[ 0 ].substr( sisa ).match( /\d{3}/gi );

		if ( ribuan ) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join( "." );
		}

		rupiah = split[ 1 ] != undefined ? rupiah + "," + split[ 1 ] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
	}

	function isNumberKey( evt ) {
		key = evt.which || evt.keyCode;
		if ( key != 188 // Comma
			&&
			key != 8 // Backspace
			&&
			key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
			&&
			( key < 48 || key > 57 ) // Non digit
		) {
			evt.preventDefault();
			return;
		}
	}

	$( function () {
		var dtToday = new Date();

		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if ( month < 10 )
			month = '0' + month.toString();
		if ( day < 10 )
			day = '0' + day.toString();

		var minDate = year + '-' + month + '-' + day;

		$( '#periode_awal' ).attr( 'min', minDate );
		$( '#periode_akhir' ).attr( 'min', minDate );
	} );

	$( function () {
		var product_name = document.getElementById( "product_name" );
		var product = document.getElementById( "product" );
	} ); */
	
</script>
<script>
/*
$('#claim_dpp').divide({delimiter: ' ',
		divideThousand: true});
		$('input').divide({delimiter: ',',
		divideThousand: false});
		*/
</script>  