<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-warning box-solid">

					<div class="box-header">
						<h3 class="box-title">PRODUCT NAME</h3>
					</div>

					<div class="box-body">
						<div style="padding-bottom: 10px;">
							<?php echo anchor(site_url('product_name/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
						</div>
						<table class="table table-bordered table-striped" id="mytable" style="width:100%">
							<thead>
								<tr>
									<th width="30px">No</th>
									<th>Product Code</th>
									<th>Product Name</th>
									<th>Category 1</th>
									<th>Category 2</th>
									<th>Business Unit</th>
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

		var t = $( "#mytable" ).dataTable( {
			initComplete: function () {
				var api = this.api();
				$( '#mytable_filter input' )
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
				"url": "product_name/json",
				"type": "POST"
			},
			columns: [ {
				"data": "product_name_id",
				"orderable": false
			}, {
				"data": "product_code"
			}, {
				"data": "product_name"
			}, {
				"data": "category_1"
			}, {
				"data": "category_2"
			}, {
				"data": "business_unit_name"
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