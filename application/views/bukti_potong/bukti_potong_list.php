<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab"><strong>BUKTI POTONG</strong></a>
					</li>
					<li><a href="#tab_2" data-toggle="tab"><strong>HISTORY BUKTI POTONG</strong></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<div class="row">
							<div class="box-body">
								<?php if ($this->session->flashdata('message')) : ?>
								<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Alert!</h4>
									<?php echo $this->session->flashdata('message'); ?>
								</div>
								<?php endif; ?>
								<div class="box-body">
									<table class="table table-bordered table-striped" id="bukti" style="width:100%">
										<thead>
											<tr>
												<th width="30px">No</th>
												<th>Claim Number</th>
												<th>Distributor/Store</th>
												<th>Status</th>
												<th width="200px">Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_2">
						<div class="row">
							<div class="box-body">
								<?php if ($this->session->flashdata('message_edit')) : ?>
								<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Alert!</h4>
									<?php echo $this->session->flashdata('message_edit'); ?>
								</div>
								<?php endif; ?>
								<div class="box-body">
									<table class="table table-bordered table-striped" id="history_bukti" style="width:100%">
										<thead>
											<tr>
												<th width="30px">No</th>
												<th>Claim Number</th>
												<th>Distributor/Store</th>
												<th>Status</th>
												<th>No Bukti Potong</th>
												<th>Bukti Potong</th>
												<th width="200px">Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $no = 0; foreach ($row_get_claimId as $data) : $no++; ?>
<div class="modal fade" id="modal-bukti<?php echo $data['claim_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Upload Bukti Potong</h4>
			</div>
			<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="approve">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">No Bukti Potong</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="no_bukti_potong" id="no_bukti_potong"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Uplaod File</label>
						<div class="col-sm-8">
							<input type="file" class="form-control" name="bukti_potong" id="bukti_potong"/>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="claim_id" id="claim_id" value="<?php echo $data['claim_id']; ?>"/>
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
<?php $no = 0; foreach ($row_get_claimId as $data) : $no++; ?>
<div class="modal fade" id="modal-edit-bukti<?php echo $data['claim_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Bukti Potong</h4>
			</div>
			<form action="<?php echo $edit; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="approve">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">No Bukti Potong</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="no_bukti_potong" id="no_bukti_potong" value="<?php echo $data['no_bukti_potong']; ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Uplaod File</label>
						<div class="col-sm-8">
							<input type="file" class="form-control" name="bukti_potong" id="bukti_potong"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-8">
							<?php if($data['bukti_potong'] == NULL) { ?>
								<span>Tidak Ada</span>
							<?php } else { ?>
								<span><a href="<?php echo base_url('uploads/'); ?><?php echo $data['bukti_potong']; ?>"><?php echo $data['bukti_potong']; ?></a></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="claim_id" id="claim_id" value="<?php echo $data['claim_id']; ?>"/>
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
	$( document ).ready( function () {
		$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings ) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
				"iTotalPages": Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
			};
		};

		var t = $( "#bukti" ).dataTable( {
			initComplete: function () {
				var api = this.api();
				$( '#bukti_filter input' )
					.off( '.DT' )
					.on( 'keyup.DT', function ( e ) {
						if ( e.keyCode == 13 ) {
							api.search( this.value ).draw();
						}
					} );
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "bukti_potong/json_bukti_potong",
				"type": "POST"
			},
			columns: [ {
				"data": "claim_id",
				"orderable": false
			}, {
				"data": "claim_number"
			}, {
				"data": "nama_distributor"
			}, {
				"data": "status_name"
			}, {
				"data": "action",
				"orderable": false,
				"className": "text-center"
			} ],
			order: [
				[ 0, 'desc' ]
			],
			rowCallback: function ( row, data, iDisplayIndex ) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + ( iDisplayIndex + 1 );
				$( 'td:eq(0)', row ).html( index );
			}
		} );
	} );
</script>
<script type="text/javascript">
	$( document ).ready( function () {
		$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings ) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
				"iTotalPages": Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
			};
		};

		var t = $( "#history_bukti" ).dataTable( {
			initComplete: function () {
				var api = this.api();
				$( '#history_bukti_filter input' )
					.off( '.DT' )
					.on( 'keyup.DT', function ( e ) {
						if ( e.keyCode == 13 ) {
							api.search( this.value ).draw();
						}
					} );
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "bukti_potong/json_history_bukti_potong",
				"type": "POST"
			},
			columns: [ {
				"data": "claim_id",
				"orderable": false
			}, {
				"data": "claim_number"
			}, {
				"data": "nama_distributor"
			}, {
				"data": "status_name"
			}, {
				"data": "no_bukti_potong"
			}, {
				"data": "bukti_potong",
				"render": function ( data, type, row, meta ) {
				  return '<a href="<?php echo base_url('uploads/'); ?>'+data+'">'+data+'</a>';
				} 
			}, {
				"data": "action",
				"orderable": false,
				"className": "text-center"
			} ],
			order: [
				[ 0, 'desc' ]
			],
			rowCallback: function ( row, data, iDisplayIndex ) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + ( iDisplayIndex + 1 );
				$( 'td:eq(0)', row ).html( index );
			}
		} );
	} );
</script>