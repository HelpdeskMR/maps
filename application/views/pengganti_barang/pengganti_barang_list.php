<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><strong>PENGGANNTI BARANG</strong></a></li>
                        <li><a href="#tab_2" data-toggle="tab"><strong>HISTORY</strong></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box box-warning box-solid">
                                <div class="box-body">
                                    <div style="padding-bottom: 10px;"> <?php echo anchor(site_url('pengganti_barang/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                                    <table class="table table-bordered table-striped" id="mytable">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th>Date Create</th>
                                                <th>Claim Number</th>
                                                <th>Status</th>
                                                <th>Approval</th>
                                                <th width="200px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($row_pengganti_barang as $row) : $no++; ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row->date_create; ?></td>
                                                    <td><?php echo $row->claim_number; ?></td>
                                                    <td><?php echo $row->status_name; ?></td>
                                                    <td><?php echo $row->full_name; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('pengganti_barang/read/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-success"> Read</a>
                                                        <a href="<?php echo base_url('pengganti_barang/update/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-warning"> Edit</a>
                                                        <a href="<?php echo base_url('pengganti_barang/delete/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-danger"> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <table class="table table-bordered table-striped" id="mytable1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>Date Create</th>
                                            <th>Claim Number</th>
                                            <th>Status</th>
                                            <th>Approval</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($row_pengganti_barang_history as $row) : $no++; ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row->date_create; ?></td>
                                                <td><?php echo $row->claim_number; ?></td>
                                                <td><?php echo $row->status_name; ?></td>
                                                <td><?php echo $row->full_name; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('pengganti_barang/read/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-success"> Read</a>
                                                    <a href="<?php echo base_url('pengganti_barang/update/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-warning"> Edit</a>
                                                    <a href="<?php echo base_url('pengganti_barang/delete/' . $row->code_pengganti_barang . ''); ?>" class="btn btn-sm btn-danger"> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    $(function() {
        $('#mytable').DataTable({
            "order": [
                [0, "desc"]
            ],
            'paging': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'responsive': true,
        })
    })
</script>
<script>
    $(function() {
        $('#mytable1').DataTable({
            "order": [
                [0, "desc"]
            ],
            'paging': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'responsive': true,
        })
    })
</script>