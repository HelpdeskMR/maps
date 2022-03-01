<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">APPROVAL PROMOTION</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable" style="width:100%; ">
              <thead>
                <tr>
                  <th width="30" rowspan="2" class="not-mobile"><p>No</p></th>
                  <th rowspan="2" class="min-mobile"><p>Date</p></th>
                  <th rowspan="2" class="min-mobile"><p>Promotion Number</p></th>
                  <th rowspan="2" class="not-mobile"><p>Promotion Name</p></th>
                  <th colspan="2" class="not-mobile"><div align="center">Product</div></th>
                  <th rowspan="2" class="not-mobile"><p>Listing Cost</p></th>
                  <th rowspan="2" class="not-mobile"><p>On Top Promo</p></th>
                  <th rowspan="2" class="not-mobile"></th>
                </tr>
                <tr>
                  <th>Baseline</th>
                  <th>Incremental</th>
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
<script src="<?php echo base_url('assets/datatables/dataTables.responsive.js') ?>"></script> 
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
					responsive: true,
                    ajax: {"url": "wf_program/json", "type": "POST"},
                    columns: [
                        {
                            "data": "promotion_id",
                            "orderable": false
                        },
						{"data": "date_create"},
						{"data": "promotion_number"},
						{"data": "promotion_name"},
						{
							"data": "total_product_baseline",
							render: $.fn.dataTable.render.number('.', ',', 0)
						},
						{
							"data": "total_product_incremental",
							render: $.fn.dataTable.render.number('.', ',', 0)},
						{
							"data": "total_listing_cost",
							render: $.fn.dataTable.render.number('.', ',', 0)},
						{
							"data": "total_on_top_promo",
							render: $.fn.dataTable.render.number('.', ',', 0)},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[1, 'DESC']],
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