<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Claim Approval</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table'>
        <tr>
          <td>No Klaim <?php echo form_error('no_klaim') ?></td>
          <td><input type="text" class="form-control" name="no_klaim" id="no_klaim" placeholder="No Klaim" value="<?php echo $no_klaim; ?>" readonly="readonly" /></td>
          <td>Tgl Klaim <?php echo form_error('tgl_klaim') ?></td>
          <td><input type="date" class="form-control" name="tgl_klaim" id="tgl_klaim" placeholder="Tgl Klaim" value="<?php echo $tgl_klaim; ?>" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>Kode Distributor <?php echo form_error('kode_distributor') ?></td>
          <td><input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="Kode Distributor" value="<?php echo $kode_distributor; ?>" readonly="readonly" /></td>
          <td>Nama Distributor <?php echo form_error('nama_distributor') ?></td>
          <td><input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $nama_distributor; ?>"  readonly="readonly"/></td>
        </tr>
        <tr>
          <td>Nama Program</td>
          <td><input type="text" class="form-control" name="program_id" id="program_id" value="<?php echo $nama_program; ?>" readonly="readonly" /></td>
            <td >Tipe Promo </td>
            <td colspan="4"><input type="text" class="form-control" value="<?php echo $gl_coa_desc; ?>" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>Deskripsi <?php echo form_error('deskripsi') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td>
        </tr>
        <tr>
          <td>Faktur Pajak <?php echo form_error('faktur_pajak') ?></td>
          <td><input type="text" class="form-control" name="faktur_pajak" id="faktur_pajak" placeholder="Faktur Pajak" value="<?php echo $faktur_pajak; ?>" /></td>
          <td>Npwp <?php echo form_error('npwp') ?></td>
          <td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" /></td>
        </tr>
        <tr>
          <td>Claim DPP <?php echo form_error('claim_dpp') ?></td>
          <td><input type="text" class="form-control" name="claim_dpp" id="claim_dpp" placeholder="Claim Dpp" value="<?php echo $claim_dpp; ?>" /></td>
        </tr>
        <tr>
          <td>Claim PPN <?php echo form_error('claim_ppn') ?></td>
          <td><input type="text" class="form-control" name="claim_ppn" id="claim_ppn" placeholder="Claim Ppn" value="<?php echo $claim_ppn; ?>" /></td>
        </tr>
        <tr>
          <td>Claim PPH <?php echo form_error('claim_pph') ?></td>
          <td><input type="text" class="form-control" name="claim_pph" id="claim_pph" placeholder="Claim Pph" value="<?php echo $claim_pph; ?>" /></td>
        </tr>
        <tr>
          <td>Total Claim <?php echo form_error('total_claim') ?></td>
          <td><input type="text" class="form-control" name="total_claim" id="total_claim" placeholder="Total Claim" value="<?php echo $total_claim; ?>" /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_approve ?></button>
            <a href="<?php echo site_url('wf_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
