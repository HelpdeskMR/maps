<!DOCTYPE html>
<html>

<head>
  <title><?php echo $promotion_number; ?></title>
  <style>
    .body {
      font-family: "Times New Roman", Times, serif;
      font-size: 12px;
      overflow-x: hidden;
      overflow-y: auto;
      height: auto;
      min-height: 100%;
    }

    .table-read {
      border-spacing: 0rem;
      border-collapse: collapse;
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
    }

    .table-read td,
    th {
      border: 1px solid #999;
      padding: 0.5rem;
    }

    .box-title {
      display: inline-block;
      font-size: 16px;
      margin: 0;
      line-height: 1;
    }

    .box-header {
      color: #fff;
      background: #3c8dbc;
      padding: 10px;
    }

    .box {
      position: relative;
      border-radius: 3px;
      background: #ffffff;
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
      font-size: 12px;
    }

    .table td {
      padding: 7px;
    }
	  
    .table pre {
        font-family: "Times New Roman", Times, serif;
        font-size: 11px;
      }

    .thead {
      background-color: #3C8DBC;
    }

    header {
      width: 200px;
      height: 45px;
      margin-bottom: 10px;
      right: 0;
      position: relative;
    }

    .row {
      padding-top: 3%;
      width: 100%;
    }

    .table-approve {
      border-spacing: 0.5rem;
      border-collapse: collapse;
      text-align: center;
      padding: 8px 8px 8px 8px;
    }

    .table-approve td {
      padding: 8px 8px 8px 8px;
      border: 1px solid #999;
    }

    .smalls-box {
      border-radius: 2px;
      position: relative;
      display: block;
      border: 1px solid #999;
    }

    .col-mod {
      float: left;
      position: relative;
      min-height: 1px;
    }
    @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
              position: static;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
  </style>
</head>

<body class="body">
  <div class="content-wrapper">
    <section class="content">
      <header> 
        <table>
          <tr>
            <td><img src="http://maps.mustika-ratu.com/assets/images/Mustika-Ratu-Horizontal-high.png" width="200" height="45"></td>
          </tr>
        </table> 
      </header>
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">PROMOTION FORM</h3>
        </div>
        <table class='table' style="padding-top:20px">
          <tr>
            <td width="100px">Date</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;width:125px"><?php echo $date_create; ?></td>

            <td style="padding-left:10px;width:100px">Promotion Number</td>
            <td width="10px">:</td>
            <td width="150px" style="border-bottom: 1px solid; border-color:#A2A2A2;width:125px;"><?php echo $promotion_number; ?></td>
          </tr>
          <tr>
            <td>Departemen</td>
            <td>:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $nama_departemen; ?></td>
            <td style="padding-left:10px">Channel</td>
            <td>:</td>
            <td style="border-bottom: 1px solid; border-color:#A2A2A2;"><?php echo $channel_name; ?></td>
          </tr>
          <tr>
            <td>Promotion Name</td>
            <td>:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $promotion_name; ?></td>
            <td style="padding-left:10px">Region</td>
            <td>:</td>
            <td style="border-bottom: 1px solid; border-color:#A2A2A2;"><?php echo $nama_region; ?></td>
          </tr>
          <tr>
            <td>Start Period</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $periode_awal; ?></td>
            <td>Area</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid; border-color:#A2A2A2;"><?php echo $nama_area; ?></td>
          </tr>
          <tr>
            <td>End Period</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $periode_akhir; ?></td>
            <td>Store</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid; border-color:#A2A2A2;"><?php echo $store_name; ?></td>
          </tr>
          <tr>
            <td>Fiscal Year</td>
            <td width="10px">:</td>
            <td style="border-bottom: 1px solid;border-color:#A2A2A2;"><?php echo $fiscal_year; ?></td>
          </tr>
        </table>
        <!-- 
     /* SALES INFORMATION */
    -->
        <table class="table">
          <tr>
            <td colspan="3" style="margin-bottom:10px;"><b><u>GENERAL INFORMATION</u></b></td>
          </tr>
          <tr>
            <td style="width:50%"><u><strong>Background</strong></u></td>
            <td style="width:50%"><u><strong>Objective</strong></u></td>
          </tr>
          <tr>
            <td><p><?php echo $sales_background; ?></textarea></p></td>
            <td><p><?php echo $sales_objective; ?></textarea></p></td>
          </tr>
          <tr>
            <td style="padding-top:10px"><u><strong>Strategy</strong></u></td>
            <td style="padding-top:10px"><u><strong>Mechanism</strong></u></td>
          </tr>
          <tr>
            <td><p><?php echo $sales_strategy; ?></p></td>
            <td><p><?php echo $sales_mechanism; ?></p></td>
          </tr>
        </table>

        <!-- 
     /* PRODUCT */
    -->
        <div style="padding-left:10px; padding-top:20px;margin-bottom:10px;"><b>PRODUCT</b></div>
        <table class="table-read">
          <thead class="thead">
            <tr>
              <!--td>No</td-->
              <td>
                <font color="#FFFFFF">Product Name</font>
              </td>
              <td>
                <font color="#FFFFFF">Category 1</font>
              </td>
              <td>
                <font color="#FFFFFF">Category 2</font>
              </td>
              <td>
                <font color="#FFFFFF">Baseline Sales (HET)</font>
              </td>
              <td>
                <font color="#FFFFFF">Incremental Sales (HET)</font>
              </td>
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
          </tbody>
          <tr>
            <td colspan="3" align="center"><b>Total</b></td>
            <td align="right"><b><?php echo number_format($total_product_baseline); ?></b></td>
            <td align="right"><b><?php echo number_format($total_product_incremental); ?></b></td>
          </tr>
        </table>

        <!-- 
     /* FINANCIAL KPI */
    -->
        <div style="padding-left:10px; padding-top:10px;margin-bottom:10px;"><b>FINANCIAL KPI</b></div>
        <table class="table-read">
          <thead class="thead">
            <tr>
              <!--td>No</td-->
              <th>
                <font color="#FFFFFF">Desc</font>
              </th>
              <th>
                <font color="#FFFFFF">Baseline</font>
              </th>
              <th>
                <font color="#FFFFFF">% HET</font>
              </th>
              <th>
                <font color="#FFFFFF">Incremental</font>
              </th>
              <th>
                <font color="#FFFFFF">% HET</font>
              </th>
              <th>
                <font color="#FFFFFF">Total</font>
              </th>
              <th>
                <font color="#FFFFFF">% HET</font>
              </th>
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
    <?php if(!empty($row_trading_term)){ ?>
        <div style="padding-left:10px; padding-top:20px;"><b>TRADING TERM</b></div>
        <table class="table-read">
          <thead class="thead">
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
                <td><?php echo $row['trading_activity_name']; ?></td>
                <td><?php echo $row['gl_coa_desc']; ?></td>
                <td><?php echo $row['gl_account_code']; ?></td>
                <td align="right"><?php echo number_format($row['amount']); ?></td>
                <td align="right"><?php echo $row['incremental_sales']; ?> %</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tr>
            <td colspan="3" align="center"><b>Total</b></td>
            <td align="right"><b><?php echo number_format($total_trading_amount); ?></b></td>
            <td align="right"><b><?php echo $total_trading_percent; ?> %</b></td>
          </tr>
        </table>
        <?php } ?>

        <!-- 
     /* LISTING COST */
    -->
    <?php if(!empty($row_listing_cost)){ ?>
        <div style="padding-left:10px; padding-top:20px;margin-bottom:10px;"><b>LISTING COST</b></div>
        <table class="table-read">
          <thead class="thead">
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
              <td>
                <font color="#FFFFFF">Source of Fund</font>
              </td>
              <td>
                <font color="#FFFFFF">Remarks</font>
              </td>
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
                <td><?php echo $row->remark; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tr>
            <td colspan="3" align="center"><b>Total</b></td>
            <td align="right"><b><?php echo number_format($total_listing_cost); ?></b></td>
            <td align="right"><b><?php echo $listing_incremental_sales; ?> %</b></td>
            <td colspan="2"></td>
          </tr>
        </table>
      <?php } ?>

        <!-- 
     /* ON TOP PROMO */
    -->
    <?php if(!empty($row_on_top_promo)){ ?>
        <div style="padding-left:10px; padding-top:20px;margin-bottom:10px;"><b><?php if ($kode_departemen == '0306') { echo 'PROMOTION DETAIL'; } else { echo 'ON TOP PROMO'; } ?></b></div>
        <table class="table-read">
          <thead class="thead">
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
              <td>
                <font color="#FFFFFF">Source of Fund</font>
              </td>
              <td>
                <font color="#FFFFFF">Remarks</font>
              </td>
            </tr>
          </thead>
          <tbody>
            <?php $no = 0;
            foreach ($row_on_top_promo as $row) : $no++; ?>
              <tr>
                <!--td width="10px"><?php echo $no; ?></td-->
                <!--td width="10px"><?php echo $no; ?></td-->
                <td><?php echo $row->promo_activity_name; ?></td>
                <td><?php echo $row->gl_coa_desc; ?></td>
                <td><?php echo $row->gl_account_code; ?></td>
                <td align="right"><?php echo number_format($row->amount); ?></td>
                <td align="right"><?php echo $row->incremental_sales; ?> %</td>
                <td><?php echo $row->source_fund; ?></td>
                <td><?php echo $row->remark; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tr>
            <td colspan="3" align="center"><b>Total</b></td>
            <td align="right"><b><?php echo number_format($total_on_top_promo); ?></b></td>
            <td align="right"><b><?php echo $promo_incremental_sales; ?> %</b></td>
            <td colspan="2"></td>
          </tr>
        </table>
        <?php } ?>

        <!-- 
     /* LIST APPROVAL */
    -->

        <div class="row">
          <table class="table-approve">
            <thead>
              <tr>
                <th width="11%" rowspan="2">
                  <p>Proposed by :</p>
                </th>
                <?php if ($row_wf_program_max == $row_approval_program_max || $row_wf_program_max == 5) { ?>
                  <th rowspan="2" colspan="3">
                    <p>Reviewed by :</p>
                  </th>
                <?php } else if ($row_wf_program_max == 3) { ?>
                  <th rowspan="2" colspan="1">
                    <p>Reviewed by :</p>
                  </th>
                <?php } else { ?>
                  <th rowspan="2" colspan="1">
                    <p>Reviewed by :</p>
                  </th>
                <?php } ?>
                <th rowspan="2" colspan="2">
                  <p>Finance Dept</p>
                </th>
              <?php if (!empty($row_approve_scheme7) || !empty($row_approve_scheme6) || !empty($row_approve_scheme5) || !empty($row_approve_scheme4)) { ?>
              <th colspan="1">
                <div align="center">Approved by :</div>
              </th>
              <?php } else { ?>
              <th colspan="1" rowspan="2">
                <div align="center">Approved by :</div>
              </th>
              <?php } ?>
              </tr>
              <tr>
                <?php if (!empty($row_approve_scheme7)) { ?>
                  <th>Sales Director</th>
                <?php } ?>
                <?php if (!empty($row_approve_scheme6) || !empty($row_approve_scheme5) || !empty($row_approve_scheme4)) { ?>
                  <th>Finance Director</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <p style="text-align:center; padding-top:15px"><b><?php echo ucwords(strtolower($pemohon)); ?></b></p>
                  <br />
                  <span>Date :&nbsp;<i><?php echo $date_create; ?></i></span>
                </td>
                <td width="20%"><?php $no = 0;
                                foreach ($row_approve_scheme1 as $row) : $no++; ?>
                    <p style="text-align:center; padding-top:15px">
                      <?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br />
                      <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                    </p>
                    <?php if ($row['approve_by'] != null) { ?>
                      <br />
                      <span class='badge badge-success'><strong>Approved</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                    <?php if ($row['reject_by'] != null) { ?>
                      <br />
                      <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                  <?php endforeach; ?>
                </td>
                <td width="20%"><?php $no = 0;
                                foreach ($row_approve_scheme2 as $row) : $no++; ?>
                    <p style="text-align:center; padding-top:15px">
                      <?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br />
                      <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                    </p>
                    <?php if ($row['approve_by'] != null) { ?>
                      <br />
                      <span class='badge badge-success'><strong>Approved</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                    <?php if ($row['reject_by'] != null) { ?>
                      <br />
                      <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                  <?php endforeach; ?>
                </td>
                <td width="12%"><?php $no = 0;
                                foreach ($row_approve_scheme3 as $row) : $no++; ?>
                    <p style="text-align:center; padding-top:15px">
                      <?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br />
                      <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                    </p>
                    <?php if ($row['approve_by'] != null) { ?>
                      <br />
                      <span class='badge badge-success'><strong>Approved</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                    <?php if ($row['reject_by'] != null) { ?>
                      <br />
                      <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                  <?php endforeach; ?>
                </td>
                <td width="12%"><?php $no = 0;
                                foreach ($row_approve_scheme4 as $row) : $no++; ?>
                    <p style="text-align:center; padding-top:15px">
                      <?php if ($row['id_user_level'] == 4) {
                                    echo "KAM";
                                  } else if ($row['id_user_level'] == 5) {
                                    echo "NKAM";
                                  } else if ($row['id_user_level'] == 7) {
                                    echo "TMM";
                                  } else if ($row['id_user_level'] == 16) {
                                    echo "RSM";
                                  }
                      ?><br />
                      <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                    </p>
                    <?php if ($row['approve_by'] != null) { ?>
                      <br />
                      <span class='badge badge-success'><strong>Approved</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                    <?php if ($row['reject_by'] != null) { ?>
                      <br />
                      <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                      <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                    <?php } else { ?>
                      <span></span>
                    <?php } ?>
                  <?php endforeach; ?>
                </td>
                <?php if (!empty($row_approve_scheme5)) { ?>
                  <td width="12%"><?php $no = 0;
                                  foreach ($row_approve_scheme5 as $row) : $no++; ?>
                      <p style="text-align:center; padding-top:15px">
                        <?php if ($row['id_user_level'] == 4) {
                                      echo "KAM";
                                    } else if ($row['id_user_level'] == 5) {
                                      echo "NKAM";
                                    } else if ($row['id_user_level'] == 7) {
                                      echo "TMM";
                                    } else if ($row['id_user_level'] == 16) {
                                      echo "RSM";
                                    }
                        ?><br />
                        <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                      </p>
                      <?php if ($row['approve_by'] != null) { ?>
                        <br />
                        <span class='badge badge-success'><strong>Approved</strong></span><br />
                        <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                      <?php } else { ?>
                        <span></span>
                      <?php } ?>
                      <?php if ($row['reject_by'] != null) { ?>
                        <br />
                        <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                        <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                      <?php } else { ?>
                        <span></span>
                      <?php } ?>
                    <?php endforeach; ?>
                  </td>
                <?php } ?>
                <?php if (!empty($row_approve_scheme6)) { ?>
                  <?php if ($row_wf_program_max != 3) { ?>
                    <td width="12%"><?php $no = 0;
                                    foreach ($row_approve_scheme6 as $row) : $no++; ?>
                        <p style="text-align:center; padding-top:15px">
                          <?php if ($row['id_user_level'] == 4) {
                                        echo "KAM";
                                      } else if ($row['id_user_level'] == 5) {
                                        echo "NKAM";
                                      } else if ($row['id_user_level'] == 7) {
                                        echo "TMM";
                                      } else if ($row['id_user_level'] == 16) {
                                        echo "RSM";
                                      }
                          ?><br />
                          <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                        </p>
                        <?php if ($row['approve_by'] != null) { ?>
                          <br />
                          <span class='badge badge-success'><strong>Approved</strong></span><br />
                          <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                        <?php } else { ?>
                          <span></span>
                        <?php } ?>
                        <?php if ($row['reject_by'] != null) { ?>
                          <br />
                          <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                          <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                        <?php } else { ?>
                          <span></span>
                        <?php } ?>
                      <?php endforeach; ?>
                    </td>
                  <?php } ?>
                <?php } ?>
                <?php if (!empty($row_approve_scheme7)) { ?>
                  <?php if ($row_wf_program_max == $row_approval_program_max || $row_wf_program_max == 5 || !empty($row_approve_scheme7)) { ?>
                    <td width="12%"><?php $no = 0;
                                    foreach ($row_approve_scheme7 as $row) : $no++; ?>
                        <p style="text-align:center; padding-top:15px">
                          <?php if ($row['id_user_level'] == 4) {
                                        echo "KAM";
                                      } else if ($row['id_user_level'] == 5) {
                                        echo "NKAM";
                                      } else if ($row['id_user_level'] == 7) {
                                        echo "TMM";
                                      } else if ($row['id_user_level'] == 16) {
                                        echo "RSM";
                                      }
                          ?><br />
                          <b><?php echo ucwords(strtolower($row['full_name'])); ?></b>
                        </p>
                        <?php if ($row['approve_by'] != null) { ?>
                          <br />
                          <span class='badge badge-success'><strong>Approved</strong></span><br />
                          <span> Date :&nbsp;<i><?php echo $row['approval_date']; ?></i></span>
                        <?php } else { ?>
                          <span></span>
                        <?php } ?>
                        <?php if ($row['reject_by'] != null) { ?>
                          <br />
                          <span class='badge badge-danger'><strong>Rejected</strong></span><br />
                          <span> Date :&nbsp;<i><?php echo $row['reject_date']; ?></i></span>
                        <?php } else { ?>
                          <span></span>
                        <?php } ?>
                      <?php endforeach; ?>
                    </td>
                  <?php } ?>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</body>

</html>