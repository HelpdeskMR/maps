<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">CLAIM LIST</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table table-bordered'>     
      <tr>
        <td width='200'>Kode Distributor <?php echo form_error('kode_distributor') ?></td>
        <td><input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="Kode Distributor" value="<?php echo $kode_distributor; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Nama Distributor <?php echo form_error('nama_distributor') ?></td>
        <td><input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $nama_distributor; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Tgl Klaim <?php echo form_error('tgl_klaim') ?></td>
        <td><input type="date" class="form-control" name="tgl_klaim" id="tgl_klaim" placeholder="Tgl Klaim" value="<?php echo $tgl_klaim; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Deskripsi <?php echo form_error('deskripsi') ?></td>
        <td><textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td>
      </tr>
      <tr>
        <td width='200'>Claim Dpp <?php echo form_error('claim_dpp') ?></td>
        <td><input type="text" class="form-control" name="claim_dpp" id="claim_dpp" placeholder="Claim Dpp" value="<?php echo $claim_dpp; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Claim Ppn <?php echo form_error('claim_ppn') ?></td>
        <td><input type="text" class="form-control" name="claim_ppn" id="claim_ppn" placeholder="Claim Ppn" value="<?php echo $claim_ppn; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Claim Pph <?php echo form_error('claim_pph') ?></td>
        <td><input type="text" class="form-control" name="claim_pph" id="claim_pph" placeholder="Claim Pph" value="<?php echo $claim_pph; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Total Claim <?php echo form_error('total_claim') ?></td>
        <td><input type="text" class="form-control" name="total_claim" id="total_claim" placeholder="Total Claim" value="<?php echo $total_claim; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Faktur Pajak <?php echo form_error('faktur_pajak') ?></td>
        <td><input type="text" class="form-control" name="faktur_pajak" id="faktur_pajak" placeholder="Faktur Pajak" value="<?php echo $faktur_pajak; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Npwp <?php echo form_error('npwp') ?></td>
        <td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" /></td>
      </tr>
      <tr>
        <td width='200'>Pemohon <?php echo form_error('pemohon') ?></td>
        <td><input type="text" class="form-control" name="Pemohon" id="Pemohon" placeholder="Pemohon" value="<?php echo $pemohon; ?>" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
          <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('claim_list') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>