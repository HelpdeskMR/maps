<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">PENGAJUAN KLAIM</a></li>
          <li><a href="#tab_2" data-toggle="tab">DAFTAR KLAIM</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="row">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Pengajuan Klaim</h3>
                </div>
                <?php echo $this->session->flashdata('message');?>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="promotion_id" value="<?php echo $promotion_id; ?>" />
                  <input type="hidden" class="form-control" name="pemohon" id="pemohon" placeholder="Pemohon" value="<?php echo $this->session->userdata('full_name'); ?>" />
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal Klaim<?php echo form_error('tgl_claim') ?></label>
                          <div class="col-sm-3">
                            <input type="date" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d');  echo $now; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Kode Distributor</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="" value="<?php echo $this->session->userdata('kode_distributor'); ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nama Distributor</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $this->session->userdata('full_name'); ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">DPP <?php echo form_error('claim_dpp') ?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control currency" name="claim_dpp" id="claim_dpp" placeholder="" value="<?php echo $claim_dpp; ?>"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PPN 10% <?php echo form_error('claim_ppn') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control currency" name="claim_ppn" id="claim_ppn" placeholder="" value="<?php echo $claim_ppn; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PPH 23 <?php echo form_error('claim_pph') ?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" name="claim_pph" id="claim_pph" placeholder="" value="<?php echo $claim_pph; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Total Claim <?php echo form_error('total_claim') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control numeric" name="total_claim" id="total_claim" placeholder="" value="<?php echo $total_claim; ?>" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">&nbsp;</label>
                          <div class="col-sm-9"> &nbsp; </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Promotion Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="promotion_number" id="promotion_number" placeholder="Promotion Number" value="<?php echo $promotion_number; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Promotion Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="promotion_name" id="promotion_name" placeholder="Promotion Name" value="<?php echo $promotion_name; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nomor Invoice <?php echo form_error('invoice') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="invoice" id="invoice" placeholder="" value="<?php echo $invoice; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Upload Invoice</label>
                          <div class="col-sm-9">
                            <input type="file" id="document_claim" name="document_claim" class="form-control"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nomor Faktur Pajak <?php echo form_error('faktur_pajak') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="faktur_pajak" id="faktur_pajak" placeholder="" value="<?php echo $faktur_pajak; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Upload Faktur Pajak</label>
                          <div class="col-sm-9">
                            <input type="file" id="document_claim" name="document_claim" class="form-control"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">PKP <?php echo form_error('pkp') ?></label>
                          <div class="col-sm-9"> <?php echo form_dropdown('pkp',array('1'=>'PKP','2'=>'NON PKP'),$pkp,array('class'=>'form-control'))?></div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">NPWP <?php echo form_error('npwp') ?></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="" value="<?php echo $npwp; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Keterangan <?php echo form_error('deskripsi') ?></label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder=""><?php echo $deskripsi; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer"> <a href="<?php echo site_url('Claim_list') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a>
                      <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>&nbsp; Ajukan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_2">
            <div class="row">
              <?php if ($this->session->flashdata('message')) : ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $this->session->flashdata('message'); ?> </div>
              <?php endif; ?>
              <div class="box-body">
                <?php
				  $id_user_level = $this->session->userdata('id_user_level');
				  if ($id_user_level == 17 || $id_user_level == 1 || $id_user_level == 2 ) { ?>
                <div style="padding-bottom: 10px;"> <?php echo anchor(site_url('claim_list/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Ajukan Klaim', 'class="btn btn-danger btn-sm"'); ?> </div>
                <?php
				  }
				  ?>
                <table class="table table-bordered table-striped" id="mytable" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px">#</th>
                      <th>Nomor Claim</th>
                      <th>Nomor Promosi</th>
                      <th>Nama Distributor</th>
                      <th>Tanggal Klaim</th>
                      <th>Dpp</th>
                      <th>Ppn</th>
                      <th>Pph</th>
                      <th>Total</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane 2--> 
        
      </div>
    </div>
  </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script> 
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
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
                    ajax: {"url": "claim/json", "type": "POST"},
					pageLength: 25,
      lengthMenu: [25, 50, 100],
                    columns: [
                        {
                            "data": "claim_id",
                            "orderable": false
                        },{"data": "claim_number"},{"data": "promotion_number"},{"data": "nama_distributor"},{"data": "tgl_claim"},{"data": "dpp"},{"data": "ppn"},{"data": "pph"},{"data": "total"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
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