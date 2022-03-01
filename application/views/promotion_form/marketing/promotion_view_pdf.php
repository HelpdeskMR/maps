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
      <header> <div><img src="http://maps.mustika-ratu.com/assets/images/Mustika-Ratu-Horizontal-high.png" width="200" height="45"> </div> </header>
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
            <td colspan="3" style="margin-bottom:10px;"><b><u>SALES INFORMATION</u></b></td>
          </tr>
          <tr>
            <td style="width:50%"><u><strong>Background</strong></u></td>
            <td style="width:50%"><u><strong>Objective</strong></u></td>
          </tr>
          <tr>
            <td><p><?php echo $sales_background; ?></p></td>
            <td><p><?php echo $sales_objective; ?></p></td>
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
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
			</div>
      </div>
  </div>
</body>

</html>