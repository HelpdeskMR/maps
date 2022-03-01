<div class="content-wrapper">
  <section class="content">
    <div class="box box-warning box-solid">
      <div class="invoice p-3 mb-3">
        <div class="row" align="center">
            <h4>PT. MUSTIKA RATUBUANA INT'L.</h4>
            <h4>FORMULIR PENGAJUAN PROGRAM PROMOSI</h4>
        </div>
        <?php echo $this->session->flashdata('alert');?>
        <form action="<?php echo $action; ?>" method="post">
        <table class="table table-no-bordered">
          <tr>
            <td width='200'>Area</td>
            <td><input type="text" class="form-control" value="<?php echo $nama_area; ?>"  /></td>
            <td width='200' >Tanggal Pengajuan </td>
            <td><input type="text" class="form-control" value="<?php echo $tgl_pengajuan; ?>" /></td>
          </tr>
          <tr>
          	<td width='200'>Region </td>
            <td><input type="text" class="form-control" value="<?php echo $nama_region; ?>" /></td>
            <td width='200'>No. Pengajuan </td>
            <td><input type="text" class="form-control" name="no_p3" value="<?php echo $no_p3; ?>" /></td>
          </tr>
          <tr>
            <td >Judul Promo</td>
            <td><input type="text" class="form-control" value="<?php echo $nama_program; ?>" /></td>
            <td width='200'>Brand / SKU</td>
            <td><input type="text" class="form-control" value="<?php echo $brand; ?>" /></td>
          </tr>
          <tr>
            <td >Tipe Promo </td>
            <td colspan="4"><input type="text" class="form-control" value="<?php echo $gl_coa_desc; ?>" /></td>
          </tr>
        </table>
        <table class='table table-bordered'>
          <tr>
            <td width='200'>Latar Belakang Promo</td>
            <td colspan="3"><textarea class="form-control" rows="3" /><?php echo $latar_belakang_promo; ?> </textarea></td>
          </tr>
          <tr>
            <td width='200'>Tujuan Promo</td>
            <td  colspan="3"><textarea class="form-control" rows="3" name="tujuan_promo" id="tujuan_promo" placeholder="Tujuan Promo"><?php echo $tujuan_promo; ?></textarea></td>
          </tr>
          <tr>
            <td width='200'>Jumlah Outlet </td>
            <td><input type="text" class="form-control" name="jumlah_outlet" id="jumlah_outlet" placeholder="Jumlah Outlet" value="<?php echo $jumlah_outlet; ?>" /></td>
            <td width='200'>Tipe Outlet</td>
            <td><input type="text" class="form-control" name="tipe_outlet" id="tipe_outlet" placeholder="Tipe Outlet" value="<?php echo $tipe_outlet; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Periode Awal </td>
            <td><input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Periode Awal" value="<?php echo $periode_awal; ?>" /></td>
             <td width='200'>Periode Akhir </td>
            <td><input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Periode Akhir" value="<?php echo $periode_akhir; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Mekanisme Promo </td>
            <td colspan="3"><textarea class="form-control" rows="3" name="mekanisme_promo" id="mekanisme_promo" placeholder="Mekanisme Promo"><?php echo $mekanisme_promo; ?></textarea></td>
          </tr>
        </table>
        <!-- PERHITUNGAN FINANSIAL SKU -->
        <table class='table table-bordered'>
          <tr>
            <td width='200' rowspan="8">Perhitungan Financial</td>
            <td width='200' colspan="2"><b>SKU</b></td>
          </tr>
          <tr>
            <td width='200'>Avg Sales Unit </td>
            <td><input type="text" class="form-control" name="sku_avg_sales_unit" id="sku_avg_sales_unit" placeholder="Sku Avg Sales Unit" value="<?php echo $sku_avg_sales_unit; ?>" /></td>
            <td width='200'>Avg Sales Amount </td>
            <td><input type="text" class="form-control" name="sku_avg_sales_amount" id="sku_avg_sales_amount" placeholder="Sku Avg Sales Amount" value="<?php echo $sku_avg_sales_amount; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Target Sales Unit </td>
            <td><input type="text" class="form-control" name="sku_target_sales_unit" id="sku_target_sales_unit" placeholder="Sku Target Sales Unit" value="<?php echo $sku_target_sales_unit; ?>" /></td>
            <td width='200'>Target Sales Amount </td>
            <td><input type="text" class="form-control" name="sku_target_sales_amount" id="sku_target_sales_amount" placeholder="Sku Target Sales Amount" value="<?php echo $sku_target_sales_amount; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Growth </td>
            <td><input type="text" class="form-control" name="sku_growth" id="sku_growth" placeholder="Sku Growth" value="<?php echo $sku_growth; ?>" /></td>
            <td width='200'>Cost Ration </td>
            <td><input type="text" class="form-control" name="sku_cost_ratio" id="sku_cost_ratio" placeholder="Sku Cost Ratio" value="<?php echo $sku_cost_ratio; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Total Cost </td>
            <td><input type="text" class="form-control numeric" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td>
          </tr>
        </table>
        <table class='table table-bordered'>
          <tr>
            <td width='200'>Estimasi Biaya </td>
            <td><input type="text" class="form-control" name="estimasi_biaya" id="estimasi_biaya" placeholder="Estimasi Biaya" value="<?php echo $estimasi_biaya; ?>" /></td>
          </tr>
          <tr>
            <td width='200'>Charging Cost </td>
            <td><input type="text" class="form-control" name="charging_cost" id="charging_cost" placeholder="Charging Cost" value="<?php echo $charging_cost; ?>" /></td>
          </tr>
          <tr>
            <td></td>
            <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_approve ?></button>
            <a href="<?php echo site_url('wf_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
          </tr>
        </table>
        </form>
      </div>
    </div>
  </section>
</div>
