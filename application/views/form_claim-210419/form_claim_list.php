<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">KELOLA DATA FORM_CLAIM</h3>
          </div>
          <div class="box-body">
            <div style="padding-bottom: 10px;"> <?php echo anchor(site_url('form_claim/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?> <?php echo anchor(site_url('form_claim/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
            <table class="table table-bordered table-striped" id="mytable">
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th>Kode Distributor</th>
                  <th>Nama Distributor</th>
                  <th>Tgl Klaim</th>
                  <th>No P3</th>
                  <th>Program Id</th>
                  <th>Deskripsi</th>
                  <th>Claim Dpp</th>
                  <th>Claim Ppn</th>
                  <th>Claim Pph</th>
                  <th>Total Claim</th>
                  <th>Faktur Pajak</th>
                  <th>Npwp</th>
                  <th>Pemohon</th>
                  <th>SecLogDate</th>
                  <th>SecLogUser</th>
                  <th width="200px">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
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
                    ajax: {"url": "form_claim/claim_list", "type": "POST"},
                    columns: [
                        {
                            "data": "claim_id",
                            "orderable": false
                        },{"data": "kode_distributor"},{"data": "nama_distributor"},{"data": "tgl_klaim"},{"data": "no_p3"},{"data": "program_id"},{"data": "deskripsi"},{"data": "claim_dpp"},{"data": "claim_ppn"},{"data": "claim_pph"},{"data": "total_claim"},{"data": "faktur_pajak"},{"data": "npwp"},{"data": "Pemohon"},{"data": "SecLogDate"},{"data": "SecLogUser"},
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