<style>
.red {
  color: red;
}
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">BUDGET</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered" id="mytable" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Business Unit</th>
                  <th>Departemen</th>
                  <th>Channel</th>
                  <th>Store</th>
                  <th>Region</th>
                  <th>Brand</th>
                  <th>Series</th>
                  <th>GL Account</th>
                  <th>Periode Tahun</th>
                  <th>Budget</th>
                  <th>Usage</th>
                  <th style="color:#333">Saldo</th>
                  <th>Status</th>
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
	  responsive: true,
      ajax: {
        "url": "gl_budget_view/json",
        "type": "POST"
      },
      pageLength: 25,
      lengthMenu: [25, 50, 100],
      columns: [{
          "data": "budget_id",
          "orderable": false
        },
        {
          "data": "business_unit_name"
        },
        {
          "data": "nama_departemen"
        },
        {
          "data": "channel_name"
        },
        {
          "data": "store_name"
        },
		    {
          "data": "nama_region"
        },
        {
          "data": "brand_name"
        },
        {
          "data": "series_name"
        },
        {
          "data": "gl_coa_desc"
        },
        {
          "data": "YearPeriod"
        },
        {
          "data": "BudgetAmount",
          render: $.fn.dataTable.render.number('.', ',', 0)
        },
        {
          "data": "BudgetUsage",
          render: $.fn.dataTable.render.number('.', ',', 0)
        },
        {
          "data": "BudgetSaldo",
		   "className": "red",
          render: $.fn.dataTable.render.number('.', ',', 0)
        },
        {
          "data": "is_aktif",
        },
      ],
      order: [
        [1, 'asc']
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