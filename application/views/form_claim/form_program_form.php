<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">FORM PENGAJUAN CLAIM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table'>
        <tr>
          <td width='200'>Kode Distributor <?php echo form_error('kode_distributor') ?></td>
          <td><input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="Kode Distributor" value="<?php echo $this->session->userdata('email'); ?>" readonly="readonly" /></td>
          <td width='200'>Judul Promosi <?php echo form_error('nama_program') ?></td>
          <td>
          <input type="text" class="form-control" name="nama_program" id="nama_program" placeholder="Judul Promosi" value="<?php echo $nama_program; ?>" readonly />
          <input type="hidden" class="form-control" name="program_id" id="program_id" placeholder="Program Id" value="<?php echo $program_id; ?>" /> </td>
        </tr>
        <tr>
          <td width='200'>Nama Distributor <?php echo form_error('nama_distributor') ?></td>
          <td><input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $this->session->userdata('full_name'); ?>" readonly /></td>
          <td width='200'>No P3 <?php echo form_error('no_p3') ?></td>
          <td><input type="text" class="form-control" name="no_p3" id="no_p3" placeholder="No P3" value="<?php echo $no_p3; ?>" readonly /></td>
        </tr>
        <tr>
        <td width='200'>No. Klaim </td>
        <td><input type="text" class="form-control" name="no_klaim" id="no_klaim" placeholder="Dibuat Otomatis" value="<?php echo $this->session->userdata('no_klaim'); ?>" readonly /></td>
        <td width='200'>Tgl Klaim <?php echo form_error('tgl_klaim') ?></td>
          <td><input type="date" class="form-control" name="tgl_klaim" id="tgl_klaim" placeholder="Tgl Klaim" value="<?php echo $tgl_klaim; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>Keterangan <?php echo form_error('deskripsi') ?></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Keterangan"><?php echo $deskripsi; ?></textarea></td>
        </tr>
        <tr>
          <td width='200'>Nilai DPP <?php echo form_error('claim_dpp') ?></td>
          <td><input type="number" value="<?php echo $claim_dpp; ?>" min="0" step="10000" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" name="claim_dpp" id="claim_dpp" placeholder="10000 tanpa tanda . atau ,"  /></td>
          <td width='200'>Nilai PPN 10% <?php echo form_error('claim_ppn') ?></td>
          <td><input type="number" class="form-control" name="claim_ppn" id="claim_ppn" placeholder="10 tanpa persen ( % )" value="<?php echo $claim_ppn; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>Nilai PPH Pasal 23 <?php echo form_error('claim_pph') ?></td>
          <td><input type="number" class="form-control" name="claim_pph" id="claim_pph" placeholder="PPH Pasal 23" value="<?php echo $claim_pph; ?>" /></td>
          <td width='200'>Total Claim <?php echo form_error('total_claim') ?></td>
          <td><input type="number" class="form-control currency" name="total_claim" id="total_claim" placeholder="1000 tanpa tanda . atau ," value="<?php echo $total_claim; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>Faktur Pajak <?php echo form_error('faktur_pajak') ?></td>
          <td><input type="text" class="form-control" name="faktur_pajak" id="faktur_pajak" placeholder="Faktur Pajak" value="<?php echo $faktur_pajak; ?>" /></td>
          <td width='200'>No. NPWP / NIK <?php echo form_error('npwp') ?></td>
          <td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="NPWP / NIK" value="<?php echo $npwp; ?>" /></td>
        </tr>
        <tr>
          <td width='200'>Pemohon <?php echo form_error('Pemohon') ?></td>
          <td><input type="text" class="form-control" name="Pemohon" id="Pemohon" placeholder="Pemohon" value="<?php echo $this->session->userdata('full_name'); ?>" /></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>&nbsp; <?php echo $button ?></button>
            <a href="<?php echo site_url('form_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script> 