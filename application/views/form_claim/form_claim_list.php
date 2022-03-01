<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">FORM CLAIM</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('form_claim/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
        <table class="table table-bordered table-striped" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Tgl Claim</th>
		    <th>Claim Number</th>
		    <th>Promotion Number</th>
		    <th>Kode Distributor</th>
		    <th>Nama Distributor</th>
		    <th>Dpp</th>
		    <th>Ppn</th>
		    <th>Pph</th>
		    <th>Total</th>
		    <th>Invoice Number</th>
		    <th>Invoice</th>
		    <th>Faktur Pajak Number</th>
		    <th>Faktur Pajak</th>
		    <th>Pkp</th>
		    <th>Npwp</th>
		    <th>Keterangan</th>
		    <th>Pemohon</th>
		    <th>Status</th>
		    <th>Payment Date</th>
		    <th>Approval Scheme</th>
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
                    ajax: {"url": "form_claim/json", "type": "POST"},
                    columns: [
                        {
                            "data": "claim_id",
                            "orderable": false
                        },{"data": "tgl_claim"},{"data": "claim_number"},{"data": "promotion_number"},{"data": "kode_distributor"},{"data": "nama_distributor"},{"data": "dpp"},{"data": "ppn"},{"data": "pph"},{"data": "total"},{"data": "invoice_number"},{"data": "invoice"},{"data": "faktur_pajak_number"},{"data": "faktur_pajak"},{"data": "pkp"},{"data": "npwp"},{"data": "keterangan"},{"data": "pemohon"},{"data": "status"},{"data": "payment_date"},{"data": "approval_scheme"},{"data": "SecLogDate"},{"data": "SecLogUser"},
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