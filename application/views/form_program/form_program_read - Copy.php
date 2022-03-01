<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">FORMULIR PENGAJUAN PROGRAM PROMOSI</h3>
    </div>
        <table class='table table-bordered'>
        <tr>
          <td width='200'>DEPARTEMEN </td>
          <td><?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen,'ASC') ?></td>
        </tr>
      </table>
      <table class='table table-bordered'>
        <tr>
          <td width='200'>AREA</td>
          <td><?php echo cmb_dinamis('kode_area', 'arc_area', 'nama_area', 'kode_area', $kode_area,'ASC') ?></td>
          <td width='200'>REGION </td>
          <td><?php echo cmb_dinamis('region_id', 'arc_region', 'nama_region', 'region_id', $region_id,'ASC') ?></td>
        </tr>
        <tr>
          <td width='200'>TANGGAL PENGAJUAN <?php echo form_error('tgl_pengajuan') ?></td>
          <td><input type="date" class="form-control" name="tgl_pengajuan" id="tgl_pengajuan" placeholder="Tgl Pengajuan" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d');  echo $now; ?>" /></td>
          <td width='200'>NO. PENGAJUAN <?php echo form_error('no_p3') ?></td>
          <td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="No. FP3" value="<?php echo $no_p3; ?>" /></td>
        </tr>
      </table>
      <table class='table table-bordered'>
        <tr>
          <td width='200'>JUDUL PROMO <?php echo form_error('program_id') ?></td>
          <td><?php echo cmb_dinamis('program_id', 'arc_program', 'nama_program', 'program_id', $program_id,'ASC') ?></td>
          <td width='200'>BRAND / SKU<?php echo form_error('brand') ?></td>
          <td><input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" value="<?php echo $brand; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>TIPE PROMO <?php echo form_error('gl_coa') ?></td>
          <td><?php echo cmb_dinamis('gl_coa', 'gl_account', 'gl_coa_desc', 'gl_coa', $gl_coa,'ASC') ?></td>
        </tr>
      </table>
      <table class='table table-bordered'>
        <tr>
          <td width='200'>LATAR BELAKANG PROMO <?php echo form_error('latar_belakang_promo') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="latar_belakang_promo" id="latar_belakang_promo" placeholder="Latar Belakang Promo"><?php echo $latar_belakang_promo; ?></textarea></td>
        </tr>
        <tr>
          <td width='200'>TUJUAN PROMO <?php echo form_error('tujuan_promo') ?></td>
          <td  colspan="3"><textarea class="form-control" rows="3" name="tujuan_promo" id="tujuan_promo" placeholder="Tujuan Promo"><?php echo $tujuan_promo; ?></textarea></td>
        </tr>
        <tr>
          <td width='200'>JUMLAH OUTLET <?php echo form_error('jumlah_outlet') ?></td>
          <td><input type="text" class="form-control" name="jumlah_outlet" id="jumlah_outlet" placeholder="Jumlah Outlet" value="<?php echo $jumlah_outlet; ?>" /></td>
          <td width='200'>TIPE OUTLET <?php echo form_error('tipe_outlet') ?></td>
          <td><input type="text" class="form-control" name="tipe_outlet" id="tipe_outlet" placeholder="Tipe Outlet" value="<?php echo $tipe_outlet; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>PERIODE AWAL <?php echo form_error('periode_awal') ?></td>
          <td><input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Periode Awal" value="<?php echo $periode_awal; ?>" /></td>
          <td width='200'>PERIODE AKHIR <?php echo form_error('periode_akhir') ?></td>
          <td><input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Periode Akhir" value="<?php echo $periode_akhir; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>MEKANISME PROMO <?php echo form_error('mekanisme_promo') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="mekanisme_promo" id="mekanisme_promo" placeholder="Mekanisme Promo"><?php echo $mekanisme_promo; ?></textarea></td>
        </tr>
      </table>
      <!-- PERHITUNGAN FINANSIAL SKU -->
      <table class='table table-bordered'>
        <tr>
          <td width='200' rowspan="8">PERHITUNGAN FINANSIAL</td>
          <td width='200' colspan="2"><b>SKU</b></td>
        </tr>
        <tr>
          <td width='200'>AVG SALES UNIT <?php echo form_error('sku_avg_sales_unit') ?></td>
          <td><input type="text" class="form-control" name="sku_avg_sales_unit" id="sku_avg_sales_unit" placeholder="Sku Avg Sales Unit" value="<?php echo $sku_avg_sales_unit; ?>" /></td>
          <td width='200'>AVG SALES AMOUNT <?php echo form_error('sku_avg_sales_amount') ?></td>
          <td><input type="text" class="form-control" name="sku_avg_sales_amount" id="sku_avg_sales_amount" placeholder="Sku Avg Sales Amount" value="<?php echo $sku_avg_sales_amount; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>TARGET SALES UNIT <?php echo form_error('sku_target_sales_unit') ?></td>
          <td><input type="text" class="form-control" name="sku_target_sales_unit" id="sku_target_sales_unit" placeholder="Sku Target Sales Unit" value="<?php echo $sku_target_sales_unit; ?>" /></td>
          <td width='200'>TARGET SALES AMOUNT <?php echo form_error('sku_target_sales_amount') ?></td>
          <td><input type="text" class="form-control" name="sku_target_sales_amount" id="sku_target_sales_amount" placeholder="Sku Target Sales Amount" value="<?php echo $sku_target_sales_amount; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>GROWTH <?php echo form_error('sku_growth') ?></td>
          <td><input type="text" class="form-control" name="sku_growth" id="sku_growth" placeholder="Sku Growth" value="<?php echo $sku_growth; ?>" /></td>
          <td width='200'>COST RATIO <?php echo form_error('sku_cost_ratio') ?></td>
          <td><input type="text" class="form-control" name="sku_cost_ratio" id="sku_cost_ratio" placeholder="Sku Cost Ratio" value="<?php echo $sku_cost_ratio; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>TOTAL COST <?php echo form_error('sku_total_cost') ?></td>
          <td><input type="text" class="form-control numeric" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td>
        </tr>
      </table>
      <table class='table table-bordered'>
        <tr>
          <td width='200'>ESTIMASI BIAYA <?php echo form_error('estimasi_biaya') ?></td>
          <td><input type="text" class="form-control" name="estimasi_biaya" id="estimasi_biaya" placeholder="Estimasi Biaya" value="<?php echo $estimasi_biaya; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>CHARGING COST <?php echo form_error('charging_cost') ?></td>
          <td><input type="text" class="form-control" name="charging_cost" id="charging_cost" placeholder="Charging Cost" value="<?php echo $charging_cost; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>PEMOHON <?php echo form_error('pemohon') ?></td>
          <td><input type="text" class="form-control" name="pemohon" id="pemohon" placeholder="Pemohon" value="<?php echo $pemohon; ?>" /></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo site_url('form_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
        </tr>
        </table>
  </div>
</div>
</div>