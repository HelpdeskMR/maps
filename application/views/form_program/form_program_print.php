<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <section class="invoice">
    <div class="row">
        <div class="row" align="center">
            <h4>PT. MUSTIKA RATUBUANA INT'L.</h4>
            <h4>FORMULIR PENGAJUAN PROGRAM PROMOSI</h4>
        </div>
        <table class="table table-no-bordered">
          <tr>
            <td width='200'>AREA</td>
            <td><input type="text" class="form-control" value="<?php echo $nama_area; ?>"  /></td>
            <td width='200' >TANGGAL PENGAJUAN </td>
            <td><input type="text" class="form-control" value="<?php echo $tgl_pengajuan; ?>" /> </td>
          </tr>
          <tr>
          	<td width='200'>REGION </td>
            <td><input type="text" class="form-control" value="<?php echo $nama_region; ?>" /></td>
            <td width='200'>NO. PENGAJUAN </td>
            <td><input type="text" class="form-control" value="<?php echo $no_p3; ?>" /></td>
          </tr>
          <tr>
          	<td colspan="4" align="center"><strong>PROPOSAL</strong></td>
          </tr>
          <tr>
            <td >JUDUL PROMO </td>
            <td><strong><input type="text" class="form-control" value="<?php echo $nama_program; ?>" /></strong></td>
            <td width='200'>BRAND / SKU</td>
            <td><strong><input type="text" class="form-control" value="<?php echo $brand; ?>" /></strong></td>
          </tr>
          <tr>
            <td >TIPE PROMO </td>
            <td colspan="4"><input type="text" class="form-control" value="<?php echo $gl_coa_desc; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>LATAR BELAKANG PROMO</td>
            <td colspan="3"><textarea class="form-control" rows="3" /><?php echo $latar_belakang_promo; ?> </textarea></td>
          </tr>
          <tr>
            <td width='200'>TUJUAN PROMO</td>
            <td  colspan="3"><textarea class="form-control" rows="3" name="tujuan_promo" id="tujuan_promo" placeholder="Tujuan Promo"><?php echo $tujuan_promo; ?></textarea></td>
          </tr>
          <tr>
            <td width='200'>JUMLAH OUTLET </td>
            <td><input type="text" class="form-control" name="jumlah_outlet" id="jumlah_outlet" placeholder="Jumlah Outlet" value="<?php echo $jumlah_outlet; ?>" /></td>
            <td width='200'>TIPE OUTLET</td>
            <td><input type="text" class="form-control" name="tipe_outlet" id="tipe_outlet" placeholder="Tipe Outlet" value="<?php echo $tipe_outlet; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>PERIODE AWAL </td>
            <td><input class="form-control" value="<?php echo $periode_awal; ?>" /> </td>
            <td width='200'>PERIODE AKHIR </td> 
            <td><input class="form-control" value="<?php echo $periode_akhir; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>MEKANISME PROMO </td>
            <td colspan="3"><textarea class="form-control" rows="3" name="mekanisme_promo" id="mekanisme_promo" placeholder="Mekanisme Promo"><?php echo $mekanisme_promo; ?></textarea></td>
          </tr>
        </table>
        <!-- PERHITUNGAN FINANSIAL SKU -->
        <table class='table table-bordered'>
          <tr>
            <td width='200' rowspan="5">PERHITUNGAN FINANSIAL</td>
            <td width='200' colspan="4"><b>SKU</b></td>
          </tr>
          <tr>
            <td width='200'>AVG SALES UNIT </td>
            <td><input type="text" class="form-control" name="sku_avg_sales_unit" id="sku_avg_sales_unit" placeholder="Sku Avg Sales Unit" value="<?php echo $sku_avg_sales_unit; ?>" /></td>
            <td width='200'>AVG SALES AMOUNT </td>
            <td><input type="text" class="form-control" name="sku_avg_sales_amount" id="sku_avg_sales_amount" placeholder="Sku Avg Sales Amount" value="<?php echo $sku_avg_sales_amount; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>TARGET SALES UNIT </td>
            <td><input type="text" class="form-control" name="sku_target_sales_unit" id="sku_target_sales_unit" placeholder="Sku Target Sales Unit" value="<?php echo $sku_target_sales_unit; ?>" /></td>
            <td width='200'>TARGET SALES AMOUNT </td>
            <td><input type="text" class="form-control" name="sku_target_sales_amount" id="sku_target_sales_amount" placeholder="Sku Target Sales Amount" value="<?php echo $sku_target_sales_amount; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>GROWTH </td>
            <td><input type="text" class="form-control" name="sku_growth" id="sku_growth" placeholder="Sku Growth" value="<?php echo $sku_growth; ?>" /></td>
            <td width='200'>COST RATIO </td>
            <td><input type="text" class="form-control" name="sku_cost_ratio" id="sku_cost_ratio" placeholder="Sku Cost Ratio" value="<?php echo $sku_cost_ratio; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>TOTAL COST </td>
            <td><input type="text" class="form-control numeric" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
        <table class='table table-bordered'>
          <tr>
            <td width='200'>ESTIMASI BIAYA </td>
            <td><input type="text" class="form-control" name="estimasi_biaya" id="estimasi_biaya" placeholder="Estimasi Biaya" value="<?php echo $estimasi_biaya; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>CHARGING COST</td>
            <td><input type="text" class="form-control" name="charging_cost" id="charging_cost" placeholder="Charging Cost" value="<?php echo $charging_cost; ?>" /></td>
          </tr>
        </table>
        <!--table class='table table-bordered'>
          <tr>
            <td width='200' colspan="4">Disetujui oleh:</td>
          </tr>
          <tr>
         	 <td>GENERAL MANAGER</td>
          </tr>

        </table-->
      </div>
  </section>
</div>
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>