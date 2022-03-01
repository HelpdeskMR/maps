<style>
  /* table.dataTable thead th,
table.dataTable thead td {
    white-space: nowrap;
} */
  .table {
    overflow-y: hidden;
    overflow-x: auto;
    display: block;
  }

  #more {
    display: none;
  }
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><strong>PENGAJUAN KLAIM</strong></a></li>
          <li><a href="#tab_2" data-toggle="tab"><strong>DAFTAR KLAIM</strong></a></li>
          <?php if($this->session->userdata('id_user_level') != 18 && $this->session->userdata('id_user_level') != 17 && $this->session->userdata('id_user_level') != 24) { ?>
            <li><a href="#tab_3" data-toggle="tab"><strong>HISTORY</strong></a></li>
          <?php } ?>
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
                <?php if ($this->session->flashdata('error')) : ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('error'); ?>
                  </div>
                <?php endif; ?>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="myForm">
                  <!--form action="<?php echo $action; ?>" method="post"-->
                  <input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
                  <input type="hidden" class="form-control" name="pemohon" id="pemohon" placeholder="Pemohon" value="<?php echo $this->session->userdata('full_name'); ?>" />
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal Klaim<?php echo form_error('tgl_claim') ?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                            $now = date('Y-m-d');
                                                                                                            echo $now; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Kode Distributor/Store</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="" value="<?php if ($this->session->userdata('kode_distributor') === NULL) {
                                                                                                                                          echo $this->session->userdata('store_code');
                                                                                                                                        } else {
                                                                                                                                          echo $this->session->userdata('kode_distributor');
                                                                                                                                        }; ?>" readonly="readonly" />
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
                            <input type="text" maxlength="20" class="form-control" name="dpp" id="dpp" placeholder="" value="<?php echo $dpp; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label" unit="%">PPN 10% <?php echo form_error('ppn') ?></label>
                          <label></label>
                          <div class="col-sm-5">
                            <input type="number" min="1" max="10" class="form-control" name="ppn" id="ppn" placeholder="%" value="<?php echo $ppn; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PPH 23 <?php echo form_error('pph') ?></label>
                          <div class="col-sm-5">
                            <input type="number" min="1" max="15" class="form-control" name="pph" id="pph" placeholder="%" value="<?php echo $pph; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label" unit="%">Nilai PPN 10%</label>
                          <div class="col-sm-5">
                            <input type="text" id="valuePpn" value="" class="form-control" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nilai PPH 23</label>
                          <div class="col-sm-5">
                            <input type="text" id="valuePph" value="" class="form-control" readonly="readonly" />
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
                            <select class="form-control select2" id="mekanisme_claim" name="mekanisme_claim" style="width: 100%;">
                              <option value=""></option>
                              <option value="Uang">Uang</option>
                              <option value="Barang">Barang</option>
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
                                <option value="<?php echo $row['promotion_number']; ?>">
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
                          <label class="col-sm-3 control-label">Upload Dokumen Klaim</label>
                          <div class="col-sm-9">
                            <input type="file" id="dokumen" name="dokumen" class="form-control" />
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
                    <div class="box-footer">
                      <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>&nbsp; Ajukan</button>
                      <?php if ($this->session->userdata('id_user_level') == 1 || $this->session->userdata('id_user_level') == 8 || $this->session->userdata('id_user_level') == 13) { ?>
                        <button id="btn-import" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-import"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp; Upload</button>
                      <?php } ?>
                      <!--button class="btn btn-danger" name="finish" id="finish"><i class="fa fa-floppy-o"></i> Save</button-->
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_2">
            <div class="row">
              <div class="box-body">
                <div style="padding-bottom: 10px;">
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#report-claim"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report Claim</button>
                </div>
                <table class="table table-bordered table-striped" id="claim" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px">#</th>
                      <th>No Claim</th>
                      <th>Distributor/Store</th>
                      <th>Tanggal Klaim</th>
                      <th>Total Klaim</th>
                      <th>Total Revisi</th>
                      <th>Tanggal Terima</th>
                      <th>Due Date</th>
                      <th>Payment Plan</th>
                      <th>Payment Date</th>
                      <th>Invoice</th>
                      <th>Keterangan</th>
                      <?php if($this->session->userdata('id_user_level') != 18 && $this->session->userdata('id_user_level') != 17 && $this->session->userdata('id_user_level') != 24) { ?>
                      <th>Approval</th>
                      <?php } ?>
                      <th>Status</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;
                    foreach ($row_claim as $row) : $no++; ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href="<?php echo site_url('claim/read/'); ?><?php echo $row['claim_id']; ?>"><?php echo $row['claim_number']; ?></a></td>
                        <td><?php echo $row['nama_distributor']; ?></td>
                        <td><?php echo $row['tgl_claim']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['total_rev']; ?></td>
                        <td><?php echo $row['receive_date']; ?></td>
                        <td><?php echo $row['due_date']; ?></td>
                        <td><?php echo $row['payment_plan']; ?></td>
                        <td><?php echo $row['payment_date']; ?></td>
                        <td><?php echo $row['invoice_number']; ?></td>
                        <td style="width: 150px;"><?php echo $row['keterangan']; ?></td>
                        <?php if($this->session->userdata('id_user_level') != 18 && $this->session->userdata('id_user_level') != 17 && $this->session->userdata('id_user_level') != 24) { ?>
                          <td><?php echo $row['full_name']; ?></td>
                        <?php } ?>
                        <td><?php if ($row['status'] == '0') { ?>
                            <button class="btn btn-block btn-xs btn-warning"> Waiting</button>
                          <?php } elseif ($row['status'] == '1') { ?>
                            <button class="btn btn-block btn-xs btn-success"> Next Approval</button>
                          <?php } elseif ($row['status'] == '2') { ?>
                            <button class="btn btn-block btn-xs btn-danger"> Rejected</button>
                          <?php } else { ?>
                            <button class="btn btn-block btn-xs btn-info"> All Approved</button>
                          <?php } ?>
                        </td>
                        <td><a href="<?php echo site_url('claim/update/'); ?><?php echo $row['claim_id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_3">
            <div class="row">
              <div class="box-body">
                <table class="table table-bordered table-striped" id="claim_history" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px">#</th>
                      <th>No Claim</th>
                      <th>Distributor/Store</th>
                      <th>Tanggal Klaim</th>
                      <th>Total Klaim</th>
                      <th>Total Revisi</th>
                      <th>Tanggal Terima</th>
                      <th>Due Date</th>
                      <th>Payment Plan</th>
                      <th>Payment Date</th>
                      <th>Invoice</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;
                    foreach ($row_claim_history as $row) : $no++; ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href="<?php echo site_url('claim/read/'); ?><?php echo $row['claim_id']; ?>"><?php echo $row['claim_number']; ?></a></td>
                        <td><?php echo $row['nama_distributor']; ?></td>
                        <td><?php echo $row['tgl_claim']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['total_rev']; ?></td>
                        <td><?php echo $row['receive_date']; ?></td>
                        <td><?php echo $row['due_date']; ?></td>
                        <td><?php echo $row['payment_plan']; ?></td>
                        <td><?php echo $row['payment_date']; ?></td>
                        <td><?php echo $row['invoice_number']; ?></td>
                        <td style="width: 150px;"><?php echo $row['keterangan']; ?></td>
                        <td><?php if ($row['status'] == '0') { ?>
                            <button class="btn btn-block btn-xs btn-warning"> Waiting</button>
                          <?php } elseif ($row['status'] == '1') { ?>
                            <button class="btn btn-block btn-xs btn-success"> Next Approval</button>
                          <?php } elseif ($row['status'] == '2') { ?>
                            <button class="btn btn-block btn-xs btn-danger"> Rejected</button>
                          <?php } else { ?>
                            <button class="btn btn-block btn-xs btn-info"> All Approved</button>
                          <?php } ?>
                        </td>
                        <td><a href="<?php echo site_url('claim/update/'); ?><?php echo $row['claim_id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
$export['judul'] = 'Report Claim';
$export['url'] = 'claim/excel';
echo show_my_modal('claim/export_excel', 'report-claim', $export);
?>
<div class="modal fade" id="modal-import">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Claim</h4>
      </div>
      <form action="<?php echo site_url('claim/import') ?>" method="post" class="form-horizontal" id="import" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="file" class="form-control" name="excel" aria-describedby="sizing-addon2">
        </div>
        <div class="modal-footer">
          <button type="submit" class="form-control btn btn-success"> <i class="fa fa-check"></i> Upload Data</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
<script>
  $(function() {
    $('#claim').DataTable({
      "order": [
        [0, "desc"]
      ],
      'paging': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'responsive': true,
    })
  })
</script>
<script>
  $(function() {
    $('#claim_history').DataTable({
      "order": [
        [0, "desc"]
      ],
      'paging': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'responsive': true,
    })
  })
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#myForm input").keyup(multInputs);

    function multInputs() {
      var mult = 0;
      // for each row:
      $("form#myForm").each(function() {
        // get the values from this row:
        var $dpp = $('#dpp', this).val();
        var $ppn = $('#ppn', this).val();
        var $pph = $('#pph', this).val();
        var $total = ($dpp * 1) + (($dpp * 1) * ($ppn / 100)) - (($dpp * 1) * ($pph / 100))
        $('#total', this).val($total);
        mult += $total;
      });
      // $("#grandTotal").text(mult);
    }
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    document.getElementById("dpp").oninput = function() {
      var dpp = document.getElementById("dpp").value;
      document.getElementById("ppn").oninput = function() {
        var ppn = document.getElementById("ppn").value;
        document.getElementById("pph").oninput = function() {
          var pph = document.getElementById("pph").value;

          console.log(dpp, ppn, pph);

          var valuePpn = dpp * (ppn / 100);
          var valuePph = dpp * (pph / 100);

          console.log(valuePpn, valuePph);

          document.getElementById('valuePpn').value = valuePpn;
          document.getElementById('valuePph').value = valuePph;
        }
      }
    }
  });
</script>