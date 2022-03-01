<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Promotion Form</h3>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table'>
        <tr>
          <td width='200'>Date <?php echo form_error('tgl_pengajuan') ?></td>
          <td><input type="date" class="form-control" name="tgl_pengajuan" id="tgl_pengajuan" placeholder="Tgl Pengajuan" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d'); echo $now; ?>" readonly="readonly" /></td>
          <td width='200'>Promotion Number </td>
          <td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="" value="<?php echo $no_p3; ?>" /></td>
          <td width='200'>Departemen <?php echo form_error('kode_departemen') ?></td>
          <td><?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen, 'ASC') ?></td>
        </tr>
        <tr>
          <td width='200' align="right">Region <?php echo form_error('region_id') ?></td>
          <td width='350'><?php echo cmb_dinamis('region_id', 'arc_region', 'nama_region', 'region_id', $region_id, 'ASC') ?></td>
          <td width='200' align="right">Area <?php echo form_error('kode_area') ?></td>
          <td><select class="form-control" id="kode_area" name="kode_area" required>
              <option></option>
            </select></td>
        </tr>
        <tr>
          <td width='200' align="right">Judul Program Promo <?php echo form_error('program_id') ?></td>
          <td><?php echo cmb_dinamis('program_id', 'arc_program', 'nama_program', 'program_id', $program_id, 'ASC') ?></td>
          <td width='200' align="right">Brand / SKU<?php echo form_error('brand') ?></td>
          <td><input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" value="<?php echo $brand; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Tipe Promo / Budget <?php echo form_error('gl_coa') ?></td>
          <td><!--?php echo cmb_dinamis('gl_coa', 'gl_account', 'gl_coa_desc', 'gl_coa', $program_id,'ASC') ?-->
            
            <select class="form-control" id="gl_coa" name="gl_coa" required>
              <option></option>
            </select></td>
        </tr>
      </table>
      <table class='table'>
        <tr>
          <td width='200' align="right">Latar Belakang Promo <?php echo form_error('latar_belakang_promo') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="latar_belakang_promo" id="latar_belakang_promo" placeholder="Latar Belakang Promo"><?php echo $latar_belakang_promo; ?></textarea></td>
        </tr>
        <tr>
          <td width='200' align="right">Tujuan Promo <?php echo form_error('tujuan_promo') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="tujuan_promo" id="tujuan_promo" placeholder="Tujuan Promo"><?php echo $tujuan_promo; ?></textarea></td>
        </tr>
        <tr>
          <td width='200' align="right">Jumlah Outlet <?php echo form_error('jumlah_outlet') ?></td>
          <td><input type="text" class="form-control" name="jumlah_outlet" id="jumlah_outlet" placeholder="Jumlah Outlet" value="<?php echo $jumlah_outlet; ?>" /></td>
          <td width='200' align="right">Tipe Outlet <?php echo form_error('tipe_outlet') ?></td>
          <td><input type="text" class="form-control" name="tipe_outlet" id="tipe_outlet" placeholder="Tipe Outlet" value="<?php echo $tipe_outlet; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Periode Awal <?php echo form_error('periode_awal') ?></td>
          <td><input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Periode Awal" value="<?php echo $periode_awal; ?>" /></td>
          <td width='200' align="right">Periode Akhir <?php echo form_error('periode_akhir') ?></td>
          <td><input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Periode Akhir" value="<?php echo $periode_akhir; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Mekanisme Promo <?php echo form_error('mekanisme_promo') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="mekanisme_promo" id="mekanisme_promo" placeholder="Mekanisme Promo"><?php echo $mekanisme_promo; ?></textarea></td>
        </tr>
      </table>
      <!-- PERHITUNGAN FINANSIAL SKU -->
      <table class='table'>
        <tr>
          <td width='200' colspan="4">PERHITUNGAN FINANSIAL SKU</td>
        </tr>
        <tr>
          <td width='200' align="right">Avg Sales Unit <?php echo form_error('sku_avg_sales_unit') ?></td>
          <td><input type="text" class="form-control" name="sku_avg_sales_unit" id="sku_avg_sales_unit" placeholder="Sku Avg Sales Unit" value="<?php echo $sku_avg_sales_unit; ?>" /></td>
          <td width='200' align="right">Avg Sales Amount <?php echo form_error('sku_avg_sales_amount') ?></td>
          <td><input type="text" class="form-control" name="sku_avg_sales_amount" id="sku_avg_sales_amount" placeholder="Sku Avg Sales Amount" value="<?php echo $sku_avg_sales_amount; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Target Sales Unit <?php echo form_error('sku_target_sales_unit') ?></td>
          <td><input type="text" class="form-control" name="sku_target_sales_unit" id="sku_target_sales_unit" placeholder="Sku Target Sales Unit" value="<?php echo $sku_target_sales_unit; ?>" /></td>
          <td width='200' align="right">Target Sales Amount <?php echo form_error('sku_target_sales_amount') ?></td>
          <td><input type="text" class="form-control" name="sku_target_sales_amount" id="sku_target_sales_amount" placeholder="Sku Target Sales Amount" value="<?php echo $sku_target_sales_amount; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Growth % <?php echo form_error('sku_growth') ?></td>
          <td><input type="text" class="form-control" name="sku_growth" id="sku_growth" placeholder="Sku Growth" value="<?php echo $sku_growth; ?>" /></td>
          <td width='200' align="right">Cost Ration % <?php echo form_error('sku_cost_ratio') ?></td>
          <td><input type="text" class="form-control" name="sku_cost_ratio" id="sku_cost_ratio" placeholder="Sku Cost Ratio" value="<?php echo $sku_cost_ratio; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Total Cost <?php echo form_error('sku_total_cost') ?></td>
          <td><input type="text" class="form-control numeric" name="sku_total_cost" id="sku_total_cost" placeholder="Sku Total Cost" value="<?php echo $sku_total_cost; ?>" /></td>
        </tr>
        <tr>
          <td width='200' align="right">Estimasi Biaya <?php echo form_error('estimasi_biaya') ?></td>
          <td><input type="text" class="form-control" name="estimasi_biaya" id="estimasi_biaya" placeholder="Estimasi Biaya" value="<?php echo $estimasi_biaya; ?>" /></td>
          <td width='200' align="right">Charging Cost <?php echo form_error('charging_cost') ?></td>
          <td><input type="text" class="form-control" name="charging_cost" id="charging_cost" placeholder="Charging Cost" value="<?php echo $charging_cost; ?>" /></td>
        </tr>
      </table>
      <table class='table table-bordered'>
        <tr>
          <td width='200'>&nbsp;</td>
          <td><input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
            <a href="<?php echo site_url('form_program') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script> 
<script type="text/javascript">
  $(document).ready(function() {

    $('#region_id').change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?php echo site_url('form_program/get_area'); ?>",
        method: "POST",
        data: {
          id: id
        },
        async: true,
        dataType: 'json',
        success: function(data) {

          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].kode_area + '>' + data[i].nama_area + '</option>';
          }
          $('#kode_area').html(html);

        }
      });
      return false;
    });

    $('#kode_departemen').change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?php echo site_url('form_program/get_coa'); ?>",
        method: "POST",
        data: {
          id: id
        },
        async: true,
        dataType: 'json',
        success: function(data) {

          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].gl_coa + '>' + data[i].gl_coa_desc + '</option>';
          }
          $('#gl_coa').html(html);

        }
      });
      return false;
    });


  });
</script>