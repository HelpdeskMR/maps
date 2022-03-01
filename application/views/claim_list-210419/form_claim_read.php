<style>
	.table-read {
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}
	
	.table-read td,
	th {
/*		border: 1px solid #999;*/
		padding: 0.5rem;
		padding-left: 25px;
	}

</style>
<div class="content-wrapper">
  <section class="content">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">CLAIM LIST</h3>
    </div>
    <form action="<?php echo $action; ?>" method="post">
      <table class='table-read'>        

	    
      <tr>
        <td width="150px">Distributor Code</td>
        <td width="1px">:</td>
		<td><?php echo $kode_distributor; ?></td>
      </tr>
      <tr>
        <td>Distributor Name</td>
		<td>:</td>
        <td><?php echo $nama_distributor; ?></td>
      </tr>
      <tr>
        <td>Claim Date</td>
		<td>:</td>
        <td><?php echo $tgl_claim; ?></td>
      </tr>
      <tr>
        <td>Description</td>
		<td>:</td>
        <td><?php echo $deskripsi; ?></td>
      </tr>
      <tr>
        <td>Claim Dpp</td>
		<td>:</td>
        <td><?php echo $claim_dpp; ?></td>
      </tr>
      <tr>
        <td>Claim Ppn</td>
		<td>:</td>
        <td><?php echo $claim_ppn; ?></td>
      </tr>
      <tr>
        <td>Claim Pph</td>
		<td>:</td>
        <td><?php echo $claim_pph; ?></td>
      </tr>
      <tr>
        <td>Total Claim</td>
		<td>:</td>
        <td><?php echo $total_claim; ?></td>
      </tr>
      <tr>
        <td>Faktur Pajak</td>
		<td>:</td>
        <td><?php echo $faktur_pajak; ?></td>
      </tr>
      <tr>
        <td>Npwp</td>
		<td>:</td>
        <td><?php echo $npwp; ?></td>
      </tr>
      <tr>
        <td>Pemohon</td>
		<td>:</td>
        <td><?php echo $pemohon; ?></td>
      </tr>
      <tr>
        <td>Document Claim</td>
		<td>:</td>
        <td>
			<?php if ($document_claim == null) {
				echo '<a href="#">';
            } else { ?>
			<?php echo '<a target="parent" href="' . base_url() . 'uploads/' . $document_claim . '">'; ?>
			<?php } ?>
			<?php echo $document_claim; ?>
			</a>
		</td>
      </tr>
      <tr>
        <td><input type="hidden" name="claim_id" value="<?php echo $claim_id; ?>" />
          
          <a href="<?php echo site_url('claim_list') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
      </tr>
      </table>
    </form>
  </div>
</div>
</div>