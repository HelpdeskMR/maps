<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">BUDGET ALLOCATION</h3>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <h4 style="padding-left: 2%;">FROM</h4>
                        <table class='table'>
                            <tr>
                                <td width="150px">Company
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_perusahaan_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Business Unit
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $business_unit_name_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Department
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_departemen_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Channel
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $channel_name_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Store
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $store_name_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Region
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_region_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Brand
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $brand_name_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Series
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $series_name_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Gl Account
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $gl_coa_desc_from; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Budget Balance
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo number_format($BusgetSaldo_from); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4 style="padding-left: 2%;">TO</h4>
                        <table class='table'>
                            <tr>
                                <td width="150px">Company
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_perusahaan_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Business Unit
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $business_unit_name_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Department
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_departemen_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Channel
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $channel_name_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Store
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $store_name_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Region
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $nama_region_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Brand
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $brand_name_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Series
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $series_name_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Gl Account
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo $gl_coa_desc_to; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Budget Balance
                                </td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo number_format($BusgetSaldo_to); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Amount Allocation</td>
                                <td width="10px">:</td>
                                <td>
                                    <?php echo number_format($amount_allocation); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-info" onclick="location.href='<?php echo site_url('wf_allocation') ?>';"><i class="fa fa-sign-out"></i> Cancel</button>
                    <a href="<?php echo site_url('wf_allocation/approve_action/' . $id_budget_allocation . ''); ?>" class="btn btn-success" id="approve" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-floppy-o"></i> Approve</a>
                    <button id="btn-reject" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject<?php echo $id_budget_allocation; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-reject<?php echo $id_budget_allocation; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reject Reason</h4>
            </div>
            <form action="<?php echo site_url('wf_edit_budget/reject_action') ?>" method="post" class="form-horizontal" id="reject">
                <div class="modal-body">
                    <textarea class="form-control" rows="3" name="reject_reason" id="reject_reason" required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_budget_allocation" id="id_budget_allocation" value="<?php echo $id_budget_allocation; ?>" />
                    <input type="hidden" name="allocation_code" id="allocation_code" value="<?php echo $allocation_code; ?>" />
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>