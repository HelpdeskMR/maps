<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INPUT DATA MASTER BUDGET</h3>
    </div>
    <form action="" method="post">
      <table class='table'>        

	    
      <tr>
        <td width='200'>Perusahaan </td>
        <td>
          	<?php echo cmb_dinamis1('kode_perusahaan', 'arc_company', 'nama_perusahaan', 'kode_perusahaan', $kode_perusahaan,'ASC') ?>
            </td>
      </tr>
      <tr>
        <td width='200'>Departemen <?php echo form_error('kode_departemen') ?></td>
        <td><?php echo cmb_dinamis('kode_departemen', 'arc_departemen', 'nama_departemen', 'kode_departemen', $kode_departemen,'ASC') ?></td>
      </tr>
      <tr>
        <td width='200'>Gl Account <?php echo form_error('gl_coa') ?></td>
        <td><?php echo cmb_dinamis('gl_coa', 'gl_account', 'gl_coa_desc', 'gl_coa', $gl_coa,'ASC') ?></td>
      </tr>
      <tr>
        <td width='200'>Periode Tahun <?php echo form_error('YearPeriod') ?></td>
        <td><input type="text" class="form-control" name="YearPeriod" id="YearPeriod" placeholder="Periode Tahun" value="<?php echo $YearPeriod; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Jumlah Anggaran / Tahun <?php echo form_error('BudgetAmount') ?></td>
        <td><input type="text" class="form-control" name="BudgetAmount" id="BudgetAmount" placeholder="Jumlah Anggaran / Tahun" value="<?php echo $BudgetAmount; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Penggunaan Anggaran <?php echo form_error('BudgetUsage') ?></td>
        <td><input type="text" class="form-control" name="BudgetUsage" id="BudgetUsage" placeholder="Penggunaan Anggaran" value="<?php echo $BudgetUsage; ?>" readonly /></td>
      </tr>
      <tr>
        <td width='200'>Saldo Anggaran <?php echo form_error('BudgetSaldo') ?></td>
        <td><input type="text" class="form-control" name="BudgetSaldo" id="BudgetSaldo" placeholder="Saldo Anggaran" value="<?php echo $BudgetSaldo; ?>" readonly /></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <a href="<?php echo site_url('gl_budget_user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>