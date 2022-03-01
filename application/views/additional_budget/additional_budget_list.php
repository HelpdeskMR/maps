<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">ADDITIONAL BUDGET</h3>
          </div>
          <div class="box-body">
            <!--div style="padding-bottom: 10px;"> ?php echo anchor(site_url('wf_claim/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div-->
            <table class="table table-bordered table-striped" id="mytable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Promotion Number</th>
                  <th>Promotion Name</th>
                  <th>Date Create</th>
                  <th>Budget</th>
                  <th>Request Budget Amount</th>
                  <th>Status</th>
                  <th>Approval</th>
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
        "url": "additional_budget/json",
        "type": "POST"
      },
      columns: [{
          "data": "id_additional_budget",
          "orderable": false
        }, {
          "data": "promotion_number"
        }, {
          "data": "promotion_name"
        }, {
          "data": "date_create"
        }, {
          "data": "budget"
        }, {
          "data": "additional_amount",
          render: $.fn.dataTable.render.number('.', ',', 0)
        }, {
          "data": "status",
          "render": function ( data, type, row, meta ) {
            if(data == 0){
              return 'Next Approval';
            } else {
              return 'All Approval';
            }
          }
        }, {
          "data": "full_name"
        },
        {
          "data": "action",
          "orderable": false,
          "className": "text-center"
        }
      ],
      order: [
        [0, 'asc']
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