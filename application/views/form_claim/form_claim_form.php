<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">FORM CLAIM</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tgl Claim <?php echo form_error('tgl_claim') ?></label>
              <input type="date" class="form-control" name="tgl_claim" id="tgl_claim" value="<?php echo $tgl_claim; ?>" />
            </div>
            <div class="form-group">
              <label>Claim Number <?php echo form_error('claim_number') ?></label>
              <input type="text" class="form-control" name="claim_number" id="claim_number" value="<?php echo $claim_number; ?>" />
            </div>
            <div class="form-group">
              <label>Promotion Number <?php echo form_error('promotion_number') ?></label>
              <input type="text" class="form-control" name="promotion_number" id="promotion_number" value="<?php echo $promotion_number; ?>" />
            </div>
            <div class="form-group">
              <label>Kode Distributor <?php echo form_error('kode_distributor') ?></label>
              <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" value="<?php echo $kode_distributor; ?>" />
            </div>
            <div class="form-group">
              <label>Nama Distributor <?php echo form_error('nama_distributor') ?></label>
              <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" value="<?php echo $nama_distributor; ?>" />
            </div>
            <div class="form-group">
              <label>Dpp <?php echo form_error('dpp') ?></label>
              <input type="text" class="form-control" name="dpp" id="dpp" value="<?php echo $dpp; ?>" />
            </div>
            <div class="form-group">
              <label>Ppn <?php echo form_error('ppn') ?></label>
              <input type="text" class="form-control" name="ppn" id="ppn" value="<?php echo $ppn; ?>" />
            </div>
            <div class="form-group">
              <label>Pph <?php echo form_error('pph') ?></label>
              <input type="text" class="form-control" name="pph" id="pph" value="<?php echo $pph; ?>" />
            </div>
            <div class="form-group">
              <label>Total <?php echo form_error('total') ?></label>
              <input type="text" class="form-control" name="total" id="total" value="<?php echo $total; ?>" />
            </div>
            <div class="form-group">
              <label>Invoice Number <?php echo form_error('invoice_number') ?></label>
              <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo $invoice_number; ?>" />
            </div>
            <div class="form-group">
              <label>Invoice <?php echo form_error('invoice') ?></label>
              <textarea class="form-control" rows="3" name="invoice" id="invoice" ><?php echo $invoice; ?></textarea>
            </div>
            <div class="form-group">
              <label>Faktur Pajak Number <?php echo form_error('faktur_pajak_number') ?></label>
              <input type="text" class="form-control" name="faktur_pajak_number" id="faktur_pajak_number" value="<?php echo $faktur_pajak_number; ?>" />
            </div>
            <div class="form-group">
              <label>Faktur Pajak <?php echo form_error('faktur_pajak') ?></label>
              <textarea class="form-control" rows="3" name="faktur_pajak" id="faktur_pajak" ><?php echo $faktur_pajak; ?></textarea>
            </div>
            <div class="form-group">
              <label>Pkp <?php echo form_error('pkp') ?></label>
              <input type="text" class="form-control" name="pkp" id="pkp" value="<?php echo $pkp; ?>" />
            </div>
            <div class="form-group">
              <label>Npwp <?php echo form_error('npwp') ?></label>
              <input type="text" class="form-control" name="npwp" id="npwp" value="<?php echo $npwp; ?>" />
            </div>
            <div class="form-group">
              <label>Keterangan <?php echo form_error('keterangan') ?></label>
              <textarea class="form-control" rows="3" name="keterangan" id="keterangan" ><?php echo $keterangan; ?></textarea>
            </div>
            <div class="form-group">
              <label>Pemohon <?php echo form_error('pemohon') ?></label>
              <input type="text" class="form-control" name="pemohon" id="pemohon" value="<?php echo $pemohon; ?>" />
            </div>
            <div class="form-group">
              <label>Status <?php echo form_error('status') ?></label>
              <input type="text" class="form-control" name="status" id="status" value="<?php echo $status; ?>" />
            </div>
            <div class="form-group">
              <label>Payment Date <?php echo form_error('payment_date') ?></label>
              <input type="text" class="form-control" name="payment_date" id="payment_date" value="<?php echo $payment_date; ?>" />
            </div>
            <div class="form-group">
              <label>Approval Scheme <?php echo form_error('approval_scheme') ?></label>
              <input type="text" class="form-control" name="approval_scheme" id="approval_scheme" value="<?php echo $approval_scheme; ?>" />
            </div>
            <div class="form-group">
              <label>SecLogDate <?php echo form_error('SecLogDate') ?></label>
              <input type="text" class="form-control" name="SecLogDate" id="SecLogDate" value="<?php echo $SecLogDate; ?>" />
            </div>
            <div class="form-group">
              <label>SecLogUser <?php echo form_error('SecLogUser') ?></label>
              <input type="text" class="form-control" name="SecLogUser" id="SecLogUser" value="<?php echo $SecLogUser; ?>" />
            </div>
            <div class="box-footer">
              <input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
              <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
              <a href="<?php echo site_url('form_claim') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Cancel</a> </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
