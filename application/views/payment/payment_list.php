<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    			<?php if ($this->session->flashdata('message')) : ?>
                	<div class="alert alert-success alert-dismissible">
					  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  	<h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  		<?php echo $this->session->flashdata('message'); ?>
                	</div>
              	<?php endif; ?>
                    <div class="box-header">
                        <h3 class="box-title">PAYMENTS</h3>
                    </div>
        
        <div class="box-body">
        <table class="table table-bordered table-striped" id="payment" style="width:100%">
            <thead>
                <tr>
                    <th width="30px">No</th>
					<th>Claim Number</th>
					<th>Distributor/Store</th>
					<th>TOP</th>
					<th>Due Date</th>
					<th>Payment Plan</th>
					<th>Payment Date</th>
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
<?php $no = 0; foreach ($row_get_claimId as $data) : $no++; ?>
<div class="modal fade" id="modal-payment<?php echo $data['claim_id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Payment</h4>
      </div>
      <!--form action="?php echo site_url('wf_claim/approve_action/'.$claim_id.'') ?>" method="post" class="form-horizontal" id="approve"-->
      <form action="<?php echo site_url('payment/payment_action') ?>" method="post" class="form-horizontal" id="approve">
        <div class="modal-body">
			<div class="form-group">
			  <label class="col-sm-3 control-label">Payment Plan</label>
			  <div class="col-sm-5">
				<input type="date" class="form-control" name="payment_plan" id="payment_plan" value="<?php echo $data['payment_plan']; ?>"  />
			  </div>
			</div>

			<div class="form-group">
			  <label class="col-sm-3 control-label">Payment Date</label>
			  <div class="col-sm-5">
				<input type="date" class="form-control" name="payment_date" id="payment_date" value="<?php echo $data['payment_date']; ?>"  />
			  </div>
			</div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="claim_id" id="claim_id" value="<?php echo $data['claim_id']; ?>" />
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="finish" id="finish" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<?php endforeach; ?>
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

                var t = $("#payment").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#payment_filter input')
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
                    ajax: {"url": "payment/json_payment", "type": "POST"},
                    columns: [
                        {
                            "data": "claim_id",
                            "orderable": false
                        },{"data": "claim_number"},{"data": "nama_distributor"},{"data": "top"},{"data": "due_date"},{"data": "payment_plan"},{"data": "payment_date"},
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