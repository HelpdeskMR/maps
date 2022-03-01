<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
	<?php if ($this->session->flashdata('message')) : ?>
		<div class="alert alert-danger alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-ban"></i> Alert!</h4>
           <?php echo $this->session->flashdata('message'); ?>
        </div>
	<?php endif; ?>
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">PROMOTION FORM</h3>
          </div>
          <div class="box-body">
            <div style="padding-bottom: 10px;"> <?php echo anchor(site_url('promotion_form/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Add New', 'class="btn btn-danger btn-sm"'); ?> <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#report-promotion"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report Promotion</button></div>
            <table class="table table-bordered table-striped" id="mytable" style="width:100%">
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
                  <th width="200px" class="not-mobile"></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
  $export['judul'] = 'Report Promotion';
  $export['url']= 'Promotion_form/export_excel';
  echo show_my_modal('promotion_header/export_excel', 'report-promotion', $export);
?>
<?php $no = 0; foreach ($row_get_promotionId as $data) : $no++; ?>
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
        "url": "promotion_form/json",
        "type": "POST"
      },
      pageLength: 25,
      lengthMenu: [25, 50, 100],
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
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>