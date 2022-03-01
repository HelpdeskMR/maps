<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="row">
            <div class="box box-warning box-solid">
              <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="myForm">
                <!--form action="<?php echo $action; ?>" method="post"-->
                <input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Klaim<?php echo form_error('tgl_claim') ?></label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php echo $tgl_claim; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Distributor/Store</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="" value="<?php echo $kode_distributor; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Distributor</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $nama_distributor; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">DPP <?php echo form_error('dpp') ?></label>
                        <div class="col-sm-5">
                          <input type="text" maxlength="20" class="form-control" name="dpp" id="dpp" placeholder="" value="<?php echo $dpp; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" unit="%">PPN 10% <?php echo form_error('ppn') ?></label>
                        <label></label>
                        <div class="col-sm-5">
                          <input type="number" min="1" max="10" class="form-control" name="ppn" id="ppn" placeholder="%" value="<?php echo $ppn; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">PPH 23 <?php echo form_error('pph') ?></label>
                        <div class="col-sm-5">
                          <input type="number" min="1" max="2" class="form-control" name="pph" id="pph" placeholder="%" value="<?php echo $pph; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" unit="%">Nilai PPN 10%</label>
                        <div class="col-sm-5">
                          <input type="text" id="valuePpn" value="<?php echo $dpp * ($ppn / 100); ?>" class="form-control" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai PPH 23</label>
                        <div class="col-sm-5">
                          <input type="text" id="valuePph" value="<?php echo $dpp * ($pph / 100); ?>" class="form-control" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Total Claim <?php echo form_error('total') ?></label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="total" id="total" placeholder="" value="<?php echo $total; ?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group" style="padding-top: 15px">
                        <label class="col-sm-3 control-label"><u><b>Revisi</b></u></label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">DPP</label>
                        <div class="col-sm-5">
                          <input type="text" maxlength="20" class="form-control" name="dpp_rev" id="dpp_rev" placeholder="" value="" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" unit="%">PPN 10%</label>
                        <label></label>
                        <div class="col-sm-5">
                          <input type="number" min="0" max="10" class="form-control" name="ppn_rev" id="ppn_rev" placeholder="%" value="" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">PPH 23</label>
                        <div class="col-sm-5">
                          <input type="number" min="0" max="20" class="form-control" name="pph_rev" id="pph_rev" placeholder="%" value="" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" unit="%">Nilai PPN 10%</label>
                        <div class="col-sm-5">
                          <input type="text" id="valuePpn_rev" value="" class="form-control" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai PPH 23</label>
                        <div class="col-sm-5">
                          <input type="text" id="valuePph_rev" value="" class="form-control" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Total Claim</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="total_rev" id="total_rev" placeholder="" value="" readonly="readonly" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Mekanisme Klaim</label>
                        <div class="col-sm-5">
                          <select class="form-control select2" id="mekanisme_claim" name="mekanisme_claim" style="width: 100%;">
                            <option value=""></option>
                            <option value="Uang" <?php if ($mekanisme_claim == 'Uang') {
                                                    echo "selected";
                                                  } ?>>Uang</option>
                            <option value="Barang" <?php if ($mekanisme_claim == 'Barang') {
                                                      echo "selected";
                                                    } ?>>Barang</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Payment Method</label>
                        <div class="col-sm-5">
                          <select class="form-control select2" id="payment_method" name="payment_method" style="width: 100%;">
                            <option value=""></option>
                            <option value="Payment" <?php if ($payment_method == 'Payment') {
                                                      echo "selected";
                                                    } ?>>Payment</option>
                            <option value="Settlement" <?php if ($payment_method == 'Settlement') {
                                                          echo "selected";
                                                        } ?>>Settlement</option>
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
                          <select class="form-control select2" id="promotion_number" name="promotion_number" style="width: 100%;" readonly="readonly">
                            <?php if ($statusClaim == 0) { ?>
                              <?php $no = 0;
                              foreach ($row_promotion as $row) : $no++; ?>
                                <option value="<?php echo $row['promotion_number']; ?>" <?php if ($row['promotion_number'] == $promotion_number) {
                                                                                          echo "selected";
                                                                                        } ?>>
                                  <?php echo $row['promotion_number']; ?> - <?php echo $row['promotion_name']; ?>
                                </option>
                              <?php endforeach; ?>
                            <?php } else { ?>
                              <option value="<?php echo $promotion_number; ?>"><?php echo $promotion_number; ?> - <?php echo $promotion_name; ?></option>
                            <?php } ?>
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
                          <div><?php if ($invoice == null) {
                                  echo '<a href="#"> Tidak Ada';
                                } else { ?> <?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $invoice . '">'; ?> <?php } ?><?php echo $invoice; ?></a></div>
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
                          <div><?php if ($faktur_pajak == null) {
                                  echo '<a href="#"> Tidak Ada';
                                } else { ?> <?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $faktur_pajak . '">'; ?> <?php } ?><?php echo $faktur_pajak; ?></a></div>
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
                          <div><?php if ($dokumen == null) {
                                  echo '<a href="#"> Tidak Ada';
                                } else { ?> <?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $dokumen . '">'; ?> <?php } ?><?php echo $dokumen; ?></a></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">PKP <?php echo form_error('pkp') ?></label>
                        <div class="col-sm-9"> <?php echo form_dropdown('pkp', array('1' => 'PKP', '2' => 'NON PKP'), $pkp, array('class' => 'form-control')) ?></div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP <?php echo form_error('npwp') ?></label>
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
                  <div class="box-footer"> <a href="<?php echo site_url('wf_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a>
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
  $(document).ready(function() {
        $('#promotion_number').change(function() {
          var id = $(this).val();
          $.ajax({
            url: "<?php echo site_url('claim/get_promotion_name'); ?>",
            method: "POST",
            data: {
              id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
              var html = '';
              var i;
              html = '<option></option>';
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].promotion_name + '>' + data[i].promotion_name + '</option>';
              }
              $('#promotion_name').html(html);

            }
          });
          return false;
        });
      }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    var t = $("#mytable").dataTable({
      initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
            }
          });
      },
      oLanguage: {
        sProcessing: "loading..."
      },
      processing: true,
      serverSide: true,
      ajax: {
        "url": "claim/json",
        "type": "POST"
      },
      pageLength: 25,
      lengthMenu: [25, 50, 100],
      columns: [{
          "data": "claim_id",
          "orderable": false
        }, {
          "data": "claim_number"
        }, {
          "data": "promotion_number"
        }, {
          "data": "nama_distributor"
        }, {
          "data": "tgl_claim"
        }, {
          "data": "dpp"
        }, {
          "data": "ppn"
        }, {
          "data": "pph"
        }, {
          "data": "total"
        }, {
          "data": "status_name"
        },
        /*{
          "data": "action",
          "orderable": false,
          "className": "text-center"
        } */
      ],
      order: [
        [0, 'desc']
      ],
      rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#myForm input").keyup(multInputs);

    function multInputs() {
      var mult = 0;
      // for each row:
      $("form#myForm").each(function() {
        // get the values from this row:
        var $dpp_rev = $('#dpp_rev', this).val();
        var $ppn_rev = $('#ppn_rev', this).val();
        var $pph_rev = $('#pph_rev', this).val();
        var $total_rev = ($dpp_rev * 1) + (($dpp_rev * 1) * ($ppn_rev / 100)) - (($dpp_rev * 1) * ($pph_rev / 100))
        $('#total_rev', this).val($total_rev);
        mult += $total_rev;
      });
      // $("#grandTotal").text(mult);
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    document.getElementById("dpp_rev").oninput = function() {
      var dpp_rev = document.getElementById("dpp_rev").value;
      document.getElementById("ppn_rev").oninput = function() {
        var ppn_rev = document.getElementById("ppn_rev").value;
        document.getElementById("pph_rev").oninput = function() {
          var pph_rev = document.getElementById("pph_rev").value;

          console.log(dpp_rev, ppn_rev, pph_rev);

          var valuePpn_rev = dpp_rev * (ppn_rev / 100);
          var valuePph_rev = dpp_rev * (pph_rev / 100);

          console.log(valuePpn_rev, valuePph_rev);

          document.getElementById('valuePpn_rev').value = valuePpn_rev;
          document.getElementById('valuePph_rev').value = valuePph_rev;
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