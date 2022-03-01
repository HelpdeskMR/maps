<style>
	.badge-success {
		color: #fff;
		background-color: #28a745;
	}
	
	.badge-danger {
		color: #fff;
		background-color: #DB3236;
	}
	
	.badge {
		display: inline-block;
		padding: .25em .4em;
		font-size: 14px;
		font-weight: 700;
		line-height: 1;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25rem;
		transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	}
	
	.row {
		padding-top: 3%;
	}
	
	.table-read {
		border-spacing: 0.5rem;
		border-collapse: collapse;
	}
	
	.table-approve {
		border: 1px solid #999;
		border-spacing: 0.5rem;
		border-collapse: collapse;
		text-align: center;
		padding: 8px 8px 8px 8px;
	}
	
	.table-read td,
	th {
		border: 1px solid #999;
		padding: 0.5rem;
	}
	
	.table-approve td,
	th {
		border: 1px solid #999;
		text-align: center;
	}
	
	.smalls-box {
		border-radius: 2px;
		position: relative;
		display: block;
		border: 1px solid #999;
	}
	
	.col-mod {
		float: left;
		position: relative;
		min-height: 1px;
		margin-left: 5px;
		margin-right: 5px;
		text-align: left;
	}

</style>
<div class="content-wrapper">
	<section class="content">
		<div class="col-sm-6">
	<?php if ($this->session->flashdata('message')) : ?>
		<div class="alert alert-danger alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-ban"></i> Alert!</h4>
           <?php echo $this->session->flashdata('message'); ?>
        </div>
	<?php endif; ?>
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">PROMOTION CANCEL</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table'>
					<tr>
						<td width="200px"><label>Promotion Number</label>
							<?php echo cmb_dinamis('promotion_number', 'form_promotion', 'promotion_number', 'promotion_number', $promotion_number, 'ASC') ?>
						</td>
					</tr>
					<tr>
						<td width="200px"><label>Reason Cancel</label>
							<textarea class="form-control" name="reason_cancel" id="reason_cancel"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<br/>
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Submit</button>&nbsp;
						</td>

					</tr>
				</table>
			</form>
		</div>
		</div>
	</section>
</div>