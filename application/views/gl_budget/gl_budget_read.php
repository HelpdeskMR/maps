<style>
    .table-read {
        border-spacing: 0.5rem;
        border-collapse: collapse;
    }

    .table-read th {
        border: 1px solid #999;
        padding: 0.5rem;
        background-color: #001F3F;
        color: #fff;
    }

    .table-read td {
        border: 1px solid #999;
        padding: 0.5rem;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">GL Budget</h3>
                    </div>
                    <table class='table' style="padding-top:20px; padding-left: 10px;">
                        <tr>
                            <td style="width: 150px;">Perusahaan</td>
                            <td style="width: 10px;">:</td>
                            <td><?php echo $nama_perusahaan; ?></td>
                        </tr>
                        <tr>
                            <td>Business Unit</td>
                            <td>:</td>
                            <td><?php echo $business_unit_name; ?></td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td>:</td>
                            <td><?php echo $nama_departemen; ?></td>
                        </tr>
                        <tr>
                            <td>Channel</td>
                            <td>:</td>
                            <td><?php echo $channel_name; ?></td>
                        </tr>
                        <tr>
                            <td>Store</td>
                            <td>:</td>
                            <td><?php echo $store_name; ?></td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td>:</td>
                            <td><?php echo $nama_region; ?></td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td>:</td>
                            <td><?php echo $brand_name; ?></td>
                        </tr>
                        <tr>
                            <td>Series</td>
                            <td>:</td>
                            <td><?php echo $series_name; ?></td>
                        </tr>
                        <tr>
                            <td>GL Account</td>
                            <td>:</td>
                            <td><?php echo $gl_coa_desc; ?></td>
                        </tr>
                        <tr>
                            <td>GL Coa Segment</td>
                            <td>:</td>
                            <td><?php echo $gl_coa_segment; ?></td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:</td>
                            <td><?php echo $YearPeriod; ?></td>
                        </tr>
                        <tr>
                            <td>Budget Amount</td>
                            <td>:</td>
                            <td><?php echo number_format($BudgetAmount); ?></td>
                        </tr>
                        <tr>
                            <td>Budget Usage</td>
                            <td>:</td>
                            <td><?php echo number_format($BudgetUsage); ?></td>
                        </tr>
                        <tr>
                            <td>Budget Saldo</td>
                            <td>:</td>
                            <td><?php echo number_format($BudgetSaldo); ?></td>
                        </tr>
                        <tr>
                            <td>Aktif</td>
                            <td>:</td>
                            <td><?php if ($is_aktif == 'y') {
                                    echo 'Aktif';
                                } else {
                                    echo 'Tidak Aktif';
                                } ?></td>
                        </tr>
                    </table>
                    <br />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">History Update</h3>
                        </div>
                        <div class="body">
                            <table class='table-read' style="padding-top:20px">
                                <thead>
                                    <th>Amount Sebelumnya</th>
                                    <th>Amount Terupdate</th>
                                    <th>Keterangan</th>
                                    <th>Log User</th>
                                    <th>Log Date</th>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($history as $row) : $no++; ?>
                                        <tr>
                                            <td><?php echo number_format($row->previous_amount); ?></td>
                                            <td><?php echo number_format($row->lastest_amount); ?></td>
                                            <td><?php echo $row->keterangan; ?></td>
                                            <td><?php echo $row->SecLogUser; ?></td>
                                            <td><?php echo $row->SecLogDate; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">History Budget Allocation</h3>
                        </div>
                        <div class="body">
                            <table class='table-read' style="padding-top:20px">
                                <thead>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <th>Log User</th>
                                    <th>Log Date</th>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($history_allocation as $row) : $no++; ?>
                                        <tr>
                                            <td>
                                                <?php if(!empty($row->business_unit_name_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->business_unit_name_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->nama_departemen_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->nama_departemen_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->channel_name_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->channel_name_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->store_name_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->store_name_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->nama_region_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->nama_region_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->brand_name_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->brand_name_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->series_name_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->series_name_from; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->gl_coa_desc_from)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->gl_coa_desc_from; ?></button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($row->business_unit_name_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->business_unit_name_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->nama_departemen_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->nama_departemen_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->channel_name_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->channel_name_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->store_name_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->store_name_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->nama_region_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->nama_region_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->brand_name_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->brand_name_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->series_name_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->series_name_to; ?></button>
                                                <?php } ?>
                                                <?php if(!empty($row->gl_coa_desc_to)) { ?>
                                                <button class="btn btn-xs" style="margin: 1px 1px 1px 1px;"><?php echo $row->gl_coa_desc_to; ?></button>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo number_format($row->amount_allocation); ?></td>
                                            <td><?php echo $row->SecLogUser; ?></td>
                                            <td><?php echo $row->SecLogDate; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-left: 1%;">
            <a href="<?php echo site_url('gl_budget') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Back</a>
        </div>
    </section>
</div>