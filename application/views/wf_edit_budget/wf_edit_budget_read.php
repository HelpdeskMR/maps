<style>
.table-read {
	border-spacing: 0.5rem;
	border-collapse:collapse;
}
.table-read td, th {
	border: 1px solid #999;
	padding: 0.5rem;
}
</style>
<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">PROMOTION FORM</h3>
    </div>
    <table class='table' style="padding-top:20px">
      <tr>
        <td width="150px">Date</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $date_create; ?></td>
        <td width="150px">Promotion Number</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid; border-color:#A2A2A2;" ><?php echo $promotion_number; ?></td>
      </tr>
      <tr>
        <td width="150px">Departemen</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $nama_departemen; ?></td>
        <td width="150px">Channel</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid; border-color:#A2A2A2;"><?php echo $channel_name; ?></td>
      </tr>
      <tr>
        <td width="150px">Promotion Name</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $promotion_name; ?></td>
        <td width="150px">Region</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid; border-color:#A2A2A2;" ><?php echo $nama_region; ?></td>
      </tr>
      <tr>
        <td width="150px">Start Period</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $periode_awal; ?></td>
        <td width="150px">Area</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid; border-color:#A2A2A2;" ><?php echo $nama_area; ?></td>
      </tr>
      <tr>
        <td width="150px">End Period</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $periode_akhir; ?></td>
        <td width="150px">Store</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid; border-color:#A2A2A2;" ><?php echo $store_name; ?></td>
      </tr>
      <tr>
        <td width="150px">Fiscal Year</td>
        <td width="10px">:</td>
        <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $fiscal_year; ?></td>
      	<td width="150px">File</td>
          <td width="10px">:</td>
          <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php if ($upload_file == null)
{ echo '<a href="#">';}
else {?> <?php echo '<a target="parent" href="'.base_url().'uploads/'.$upload_file.'">'; ?> <?php }?><?php echo $upload_file;?></a></td>
        </tr>
        <tr>
          <td width="150px"></td>
          <td width="10px"></td>
          <td></td>
          <td width="150px">File Activity</td>
          <td width="10px">:</td>
          <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php if ($upload_activity == null)
{ echo '<a href="#">';}
else {?> <?php echo '<a target="parent" href="'.base_url().'uploads/'.$upload_activity.'">'; ?> <?php }?><?php echo $upload_activity;?></a></td>
        </tr>
    </table>
    <!-- 
     /* SALES INFORMATION */
    -->
    <table class="table">
      <tr>
        <td colspan="3"><b><u>SALES INFORMATION</u></b></td>
      </tr>
      <tr>
        <td><u><strong>Background</strong></u></td>
        <td></td>
        <td><u><strong>Objective</u></strong></td>
      </tr>
      <tr>
        <td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_background; ?></textarea></td>
        <td></td>
        <td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_objective; ?></textarea></td>
      </tr>
      <tr>
        <td style="padding-top:10px"><u><strong>Strategy</u></strong></td>
        <td></td>
        <td style="padding-top:10px"><u><strong>Mechanism</u></strong></td>
      </tr>
      <tr>
        <td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_strategy; ?></textarea></td>
        <td></td>
        <td><textarea class="form-control" rows="3" readonly="readonly"><?php echo $sales_mechanism; ?></textarea></td>
      </tr>
    </table>
    
    <!-- 
     /* PRODUCT */
    -->
    <div style="padding-left:10px; padding-top:20px;"><b>PRODUCT</b></div>
    <table class="table-read">
      <thead bgcolor="#3C8DBC">
        <tr> 
          <!--td>No</td-->
          <td><font color="#FFFFFF">Product Name</font></td>
          <td><font color="#FFFFFF">Category 1</font></td>
          <td><font color="#FFFFFF">Category 2</font></td>
          <td><font color="#FFFFFF">Baseline Sales (HET)</font></td>
          <td><font color="#FFFFFF">Incremental Sales (HET)</font></td>
        </tr>
      </thead>
      <tbody>
        <?php $no = 0;
          foreach ($row_product as $row) : $no++; ?>
        <tr> 
          <!--td width="10px"><?php echo $no; ?></td-->
          <td><?php echo $row->product_name; ?></td>
          <td><?php echo $row->cotegory_name_1; ?></td>
          <td><?php echo $row->cotegory_name_2; ?></td>
          <td align="right"><?php echo number_format($row->baseline_sales); ?></td>
          <td align="right"><?php echo number_format($row->incremental_sales); ?></td>
        </tr>
        <?php endforeach; ?>
      <tr>
        <td colspan="3" align="center"><b>Total</b></td>
        <td align="right"><b><?php echo number_format($total_product_baseline); ?></b></td>
        <td align="right"><b><?php echo number_format($total_product_incremental); ?></b></td>
      </tr>
      </tbody>
    </table>
    
    <!-- 
     /* FINANCIAL KPI */
    -->
    <div style="padding-left:10px; padding-top:10px;"><b>FINANCIAL KPI</b></div>
    <table class="table-read">
      <thead bgcolor="#3C8DBC">
        <tr> 
          <!--td>No</td-->
          <th> <font color="#FFFFFF">Desc</font> </th>
          <th> <font color="#FFFFFF">Baseline</font> </th>
          <th> <font color="#FFFFFF">% HET</font> </th>
          <th> <font color="#FFFFFF">Incremental</font> </th>
          <th> <font color="#FFFFFF">% HET</font> </th>
          <th> <font color="#FFFFFF">Total</font> </th>
          <th> <font color="#FFFFFF">% HET</font> </th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 0;
          foreach ($row_financial_kpi as $row) : $no++; ?>
        <tr> 
          <!--td width="10px"><?php echo $no; ?></td-->
          <?php if ($row->description == 'Net Sales') { ?>
          <td><strong><?php echo $row->description; ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->total); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->total_het); ?> %</strong></td>
          <?php } else if ($row->description == 'Net Amount') { ?>
          <td><strong><?php echo $row->description; ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->total); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->total_het); ?> %</strong></td>
          <?php } else if ($row->description == 'Cost') { ?>
          <td><strong><?php echo $row->description; ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->baseline_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->incremental_het); ?> %</strong></td>
          <td align="right"><strong><?php echo number_format($row->total); ?></strong></td>
          <td align="right"><strong><?php echo number_format($row->total_het); ?> %</strong></td>
          <?php } else { ?>
          <td><?php echo $row->description; ?></td>
          <td align="right"><?php echo number_format($row->baseline); ?></td>
          <td align="right"><?php echo number_format($row->baseline_het); ?> %</td>
          <td align="right"><?php echo number_format($row->incremental); ?></td>
          <td align="right"><?php echo number_format($row->incremental_het); ?> %</td>
          <td align="right"><?php echo number_format($row->total); ?></td>
          <td align="right"><?php echo number_format($row->total_het); ?> %</td>
          <?php } ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    
    <!-- 
     /* TRADING TERM */
    -->
      <div style="padding-left:10px; padding-top:20px;"><b>TRADING TERM</b></div>
      <table class="table-read">
        <thead bgcolor="#3C8DBC">
          <tr>
            <!--td>No</td-->
            <td>
              <font color="#FFFFFF">Activity</font>
            </td>
            <td>
              <font color="#FFFFFF">GL Account Name</font>
            </td>
            <td>
              <font color="#FFFFFF">GL Account Code</font>
            </td>
            <td>
              <font color="#FFFFFF">AMOUNT</font>
            </td>
            <td>
              <font color="#FFFFFF">% to Incremental Sales</font>
            </td>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0;
          foreach ($row_trading_term as $row) : $no++; ?>
            <tr>
              <!--td width="10px"><?php echo $no; ?></td-->
              <td><?php echo $row->trading_activity_name; ?></td>
              <td><?php echo $row->gl_coa_desc; ?></td>
              <td><?php echo $row->gl_account_code; ?></td>
              <td align="right"><?php echo number_format($row->amount); ?></td>
              <td align="right"><?php echo $row->incremental_sales; ?> %</td>
            </tr>
          <?php endforeach; ?>
        <tr>
          <td colspan="3" align="center"><b>Total</b></td>
          <td align="right"><b><?php echo number_format($total_trading_amount); ?></b></td>
          <td align="right"><b><?php echo $total_trading_percent; ?> %</b></td>
        </tr>
        </tbody>
      </table>
    
    <!-- 
     /* LISTING COST */
    -->
    <div style="padding-left:10px; padding-top:20px;"><b>LISTING COST</b></div>
    <table class="table-read">
      <thead bgcolor="#3C8DBC">
        <tr> 
          <!--td>No</td-->
          <td><font color="#FFFFFF">Activity</font></td>
          <td><font color="#FFFFFF">GL Account Name</font></td>
          <td><font color="#FFFFFF">GL Account Code</font></td>
          <td><font color="#FFFFFF">AMOUNT</font></td>
          <td><font color="#FFFFFF">% to Incremental Sales</font></td>
          <td><font color="#FFFFFF">Source of Fund</font></td>
          <td><font color="#FFFFFF">Remarks</font></td>
        </tr>
      </thead>
      <tbody>
        <?php $no = 0;
          foreach ($row_listing_cost as $row) : $no++; ?>
        <tr> 
          <!--td width="10px"><?php echo $no; ?></td-->
          <td><?php echo $row->listing_activity_name; ?></td>
          <td><?php echo $row->gl_coa_desc; ?></td>
          <td><?php echo $row->gl_account_code; ?></td>
          <td align="right"><?php echo number_format($row->amount); ?></td>
          <td align="right"><?php echo $row->incremental_sales; ?> %</td>
          <td><?php echo $row->source_fund; ?></td>
          <td width="300px"><?php echo $row->remark; ?></td>
        </tr>
        <?php endforeach; ?>
      <tr>
        <td colspan="3" align="center"><b>Total</b></td>
        <td align="right"><b><?php echo number_format($total_listing_cost); ?></b></td>
        <td align="right"><b><?php echo $listing_incremental_sales; ?> %</b></td>
        <td colspan="2"></td>
      </tr>
      </tbody>
    </table>
    
    <!-- 
     /* ON TOP PROMO */
    -->
    <div style="padding-left:10px; padding-top:20px;"><b>ON TOP PROMO</b></div>
    <table class="table-read">
      <thead bgcolor="#3C8DBC">
        <tr> 
          <!--td>No</td-->
          <td><font color="#FFFFFF">Activity</font></td>
          <td><font color="#FFFFFF">GL Account Name</font></td>
          <td><font color="#FFFFFF">GL Account Code</font></td>
          <td><font color="#FFFFFF">AMOUNT</font></td>
          <td><font color="#FFFFFF">% to Incremental Sales</font></td>
          <td><font color="#FFFFFF">Source of Fund</font></td>
          <td><font color="#FFFFFF">Remarks</font></td>
        </tr>
      </thead>
      <tbody>
        <?php $no = 0;
          foreach ($row_on_top_promo as $row) : $no++; ?>
        <tr> 
          <!--td width="10px"><?php echo $no; ?></td-->
          <td><?php echo $row->promo_activity_name; ?></td>
          <td><?php echo $row->gl_coa_desc; ?></td>
          <td><?php echo $row->gl_account_code; ?></td>
          <td align="right"><?php echo number_format($row->amount); ?></td>
          <td align="right"><?php echo $row->incremental_sales; ?> %</td>
          <td><?php echo $row->source_fund; ?></td>
          <td width="300px"><?php echo $row->remark; ?></td>
        </tr>
        <?php endforeach; ?>
      <tr>
        <td colspan="3" align="center"><b>Total</b></td>
        <td align="right"><b><?php echo number_format($total_on_top_promo); ?></b></td>
        <td align="right"><b><?php echo $promo_incremental_sales; ?> %</b></td>
        <td colspan="2"></td>
      </tr>
      </tbody>
    </table>
    <div class="box-footer">
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="promotion_id" value="<?php echo $promotion_id; ?>" />
      <a href="<?php echo site_url('wf_edit_budget'); ?>" class="btn btn-info" style="margin-right:1%"><i class="fa fa-sign-out"></i> Cancel</a> <a href="<?php echo site_url('wf_edit_budget/approve_action/'.$promotion_id.''); ?>" class="btn btn-success" id="approve" style="margin-right:1%" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-floppy-o"></i> Approve</a>
      <button id="btn-reject" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject<?php echo $promotion_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
      </div>
  </div>
</div>
<?php $no = 0; foreach ($row_get_promotionId as $data) : $no++; ?>
<div class="modal fade" id="modal-reject<?php echo $data['promotion_id']; ?>">
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
        	<input type="hidden" name="promotion_id" id="promotion_id" value="<?php echo $data['promotion_id']; ?>" />
          	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          	<button type="submit" name="finish" id="finish" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Reject</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<?php endforeach; ?>
<!-- /.modal -->