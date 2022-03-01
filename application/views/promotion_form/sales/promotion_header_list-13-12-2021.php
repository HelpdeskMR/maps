<div class="content-wrapper">
  <section class="content">
    <!-- MENU TAB -->
    <div class="row">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><strong>PROMOTION FORM</strong></a></li>
          <?php
          $id_user_level = $this->session->userdata('id_user_level');
          if ($id_user_level == 8 || $id_user_level == 9 || $id_user_level == 1 || $id_user_level == 2 ) { ?>
            <li><a href="#tab_2" data-toggle="tab"><strong>PROMOTION CANCEL</strong></a></li>
          <?php
          }
          ?>
          <li><a href="#tab_3" data-toggle="tab"><strong>HISTORY</strong></a></li>
        </ul>
        <div class="tab-content">
          <!-- /.tab-pane 1-->
          <div class="tab-pane active" id="tab_1">
            <div class="row">
              <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
              <?php endif; ?>
              <div class="box-body">
                <div style="padding-bottom: 10px;"> <?php echo anchor(site_url('promotion_form/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Add New', 'class="btn btn-danger btn-sm"'); ?>
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#report-promotion"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report Promotion</button>
                </div>
                <table class="table table-bordered table-striped" id="promotion" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px" class="not-mobile">No</th>
                      <th class="min-mobile">Date Create</th>
                      <th class="min-mobile">Promotion Number</th>
                      <th class="not-mobile">Department</th>
                      <th class="not-mobile">Promotion Name</th>
                      <th class="not-mobile">Fiscal Year</th>
                      <th class="not-mobile">Approval</th>
                      <th class="not-mobile">Status</th>
                      <th width="80px" class="not-mobile"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- /.tab-pane 2-->
          <div class="tab-pane" id="tab_2">
            <div class="row">
              <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
              <?php endif; ?>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="cancel" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px" class="not-mobile">No</th>
                      <th class="min-mobile">Date Create</th>
                      <th class="min-mobile">Promotion Number</th>
                      <th class="not-mobile">Department</th>
                      <th class="not-mobile">Promotion Name</th>
                      <th class="not-mobile">Fiscal Year</th>
                      <th class="not-mobile">Approval</th>
                      <th class="not-mobile">Status</th>
                      <th width="80px" class="not-mobile"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <!-- /.tab-pane 3-->
          <div class="tab-pane" id="tab_3">
            <div class="row">
              <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
              <?php endif; ?>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="history" style="width:100%">
                  <thead>
                    <tr>
                      <th width="30px" class="not-mobile">No</th>
                      <th class="min-mobile">Date Create</th>
                      <th class="min-mobile">Promotion Number</th>
                      <th class="not-mobile">Department</th>
                      <th class="not-mobile">Promotion Name</th>
                      <th class="not-mobile">Fiscal Year</th>
                      <th class="not-mobile">Approval</th>
                      <th class="not-mobile">Status</th>
                      <th width="80px"  class="not-mobile"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
      <!-- /.col -->

      <!-- /.col -->
    </div>

    <!-- PROMOTION LIST -->

  </section>
</div>
<?php
$export['judul'] = 'Report Promotion';
$export['url'] = 'Promotion_form/export_excel';
echo show_my_modal('promotion_header/export_excel', 'report-promotion', $export);
?>
<!-- DELETE -->
<?php $no = 0;
foreach ($row_get_promotionId as $data) : $no++; ?>
  <div class="modal fade" id="modal-delete<?php echo $data['promotion_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Reason</h4>
        </div>
        <form action="<?php echo site_url('promotion_form/delete') ?>" method="post" class="form-horizontal" id="delete">
          <div class="modal-body">
            <textarea class="form-control" rows="3" name="delete_reason" id="delete_reason" required></textarea>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="promotion_id" id="promotion_id" value="<?php echo $data['promotion_id']; ?>" />
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>

<!-- CANCEL -->
<?php $no = 0;
foreach ($row_get_promotionId as $data) : $no++; ?>
  <div class="modal fade" id="modal-cancel<?php echo $data['promotion_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Promotion Cancel</h4>
        </div>
        <form action="<?php echo site_url('promotion_form/cancel_action') ?>" method="post" class="form-horizontal" id="delete">
          <div class="modal-body">
          <label>Reason</label>
            <textarea class="form-control" rows="3" name="delete_reason" id="delete_reason" required></textarea>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="promotion_number" id="promotion_number" value="<?php echo $data['promotion_number']; ?>" />
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Proses Cancel</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal -->
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

    var t = $("#promotion").dataTable({
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
        "url": "promotion_form/json",
        "type": "POST"
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      columns: [{
          "data": "promotion_id",
          "orderable": false
        }, {
          "data": "date_create"
        }, {
          "data": "promotion_number"
        }, {
          "data": "nama_departemen"
        }, {
          "data": "promotion_name"
        }, {
          "data": "fiscal_year"
        },
        {
          "data": "full_name"
        },
        {
          "data": "tooltip"
        },
        {
          "data": "action",
          "orderable": false,
          "className": "text-center"
        }
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

  function deleteConfirm(url) {
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
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

    var t = $("#cancel").dataTable({
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
        "url": "promotion_form/jsonCancel",
        "type": "POST"
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      columns: [{
          "data": "promotion_id",
          "orderable": false
        }, {
          "data": "date_create"
        }, {
          "data": "promotion_number"
        }, {
          "data": "nama_departemen"
        }, {
          "data": "promotion_name"
        }, {
          "data": "fiscal_year"
        },
        {
          "data": "full_name"
        },
        {
          "data": "tooltip"
        },
        {
          "data": "action",
          "orderable": false,
          "className": "text-center"
        }
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

    var t = $("#history").dataTable({
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
        "url": "promotion_form/jsonHistory",
        "type": "POST"
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      columns: [{
          "data": "promotion_id",
          "orderable": false
        }, {
          "data": "date_create"
        }, {
          "data": "promotion_number"
        }, {
          "data": "nama_departemen"
        }, {
          "data": "promotion_name"
        }, {
          "data": "fiscal_year"
        },
        {
          "data": "full_name"
        },
        {
          "data": "tooltip"
        },
        {
          "data": "action",
          "orderable": false,
          "className": "text-center"
        }
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

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>