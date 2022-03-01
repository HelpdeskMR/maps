<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">FORM PENGAJUAN CLAIM</h3>
    </div>
    <?php echo $this->session->flashdata('message');?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <table class='table'>
        <tr>
          <td>Distributor Code </td>
          <td><input type="text" class="form-control" name="kode_distributor" id="kode_distributor" placeholder="Distributor Code" value="<?php echo $this->session->userdata('kode_distributor'); ?>" readonly="readonly" /></td>
          <td>Promotion Name </td>
          <td><input type="text" class="form-control" name="promotion_name" id="promotion_name" placeholder="Promotion Name" value="<?php echo $promotion_name; ?>" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>Distributor Name </td>
          <td><input type="text" class="form-control" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" value="<?php echo $this->session->userdata('full_name'); ?>" readonly="readonly" /></td>
          <td>Promotion Number </td>
          <td><input type="text" class="form-control" name="promotion_number" id="promotion_number" placeholder="Promotion Number" value="<?php echo $promotion_number; ?>" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>Claim Date <?php echo form_error('tgl_claim') ?></td>
          <td><input type="date" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php date_default_timezone_set('Asia/Jakarta'); $now = date('Y-m-d');  echo $now; ?>" readonly="readonly" /></td>
		  <td>Document Claim<br/></td>
		  <td><input type="file" id="document_claim" name="document_claim" class="form-control" /></td>
        </tr>
        <tr>
          <td>Description <?php echo form_error('deskripsi') ?></td>
          <td><textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder=""><?php echo $deskripsi; ?></textarea></td>
          <td>PKP <?php echo form_error('pkp') ?></td>
          <td><?php echo form_dropdown('pkp',array('1'=>'PKP','2'=>'NON PKP'),$pkp,array('class'=>'form-control'))?></td>
        </tr>
        <tr>
          <td>Value DPP <?php echo form_error('claim_dpp') ?></td>
          <td><input type="text" class="form-control currency" name="claim_dpp" id="claim_dpp" placeholder="" value="<?php echo $claim_dpp; ?>"  /></td>
          <td>Value PPN 10% <?php echo form_error('claim_ppn') ?></td>
          <td><input type="text" class="form-control currency" name="claim_ppn" id="claim_ppn" placeholder="" value="<?php echo $claim_ppn; ?>" /></td>
        </tr>
        <tr>
          <td>Value PPH Pasal 23 <?php echo form_error('claim_pph') ?></td>
          <td><input type="text" class="form-control" name="claim_pph" id="claim_pph" placeholder="" value="<?php echo $claim_pph; ?>" /></td>
          <td>Total Claim <?php echo form_error('total_claim') ?></td>
          <td><input type="text" class="form-control numeric" name="total_claim" id="total_claim" placeholder="" value="<?php echo $total_claim; ?>" /></td>
        </tr>
        <tr>
          <td>Faktur Pajak <?php echo form_error('faktur_pajak') ?></td>
          <td><input type="text" class="form-control" name="faktur_pajak" id="faktur_pajak" placeholder="" value="<?php echo $faktur_pajak; ?>" /></td>
          <td>No. NPWP / NIK <?php echo form_error('npwp') ?></td>
          <td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="" value="<?php echo $npwp; ?>" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>Pemohon <?php echo form_error('pemohon') ?></td>
          <td><input type="text" class="form-control" name="pemohon" id="pemohon" placeholder="Pemohon" value="<?php echo $this->session->userdata('full_name'); ?>" /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="hidden" name="promotion_id" value="<?php echo $promotion_id; ?>" />
            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>&nbsp; <?php echo $button ?></button>
            <a href="<?php echo site_url('form_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Batal</a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script> 