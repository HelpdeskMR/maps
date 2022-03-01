<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">FORMULIR CLAIM</h3>
          </div>
          <div class="box-body">
            <?php echo $this->session->flashdata('message');?>
            <table class="table table-bordered table-striped" id="mytable">
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th>Promotion Number</th>
                  <th>Promotion Name</th>
                  <th>Channel</th>
                  <th>Region</th>
				  <th>Area</th>
				  <th>Store</th>
                  <th>Total Cost</th>
                  <th></th>
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
                    ajax: {"url": "form_claim/json_program", "type": "POST"},
                    columns: [
                        {
                            "data": "promotion_id",
                            "orderable": false
                        },{"data": "promotion_number"},{"data": "promotion_name"},{"data": "channel_name"},{"data": "nama_region"},{"data": "nama_area"},{"data": "store_name"},{"data": "promotion_total_cost"},
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