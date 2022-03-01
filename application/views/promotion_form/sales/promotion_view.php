<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-warning box-solid">
					<div class="box-header">
						<h3 class="box-title">PROMOTION VIEW</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped" id="example1" style="width:100%">
							<thead>
								<tr>
									<th width="30px" class="not-mobile">No</th>
									<th class="min-mobile">Promotion Number</th>
									<th class="not-mobile">Promotion Name</th>
									<th class="not-mobile">Fiscal Year</th>
									<th class="not-mobile">Start Period</th>
									<th class="not-mobile">End Period</th>
									<th width="80px" class="not-mobile"></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0;
                                foreach ($row_data as $row) : $no++; ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $row['promotion_number']; ?></td>
									<td><?php echo $row['promotion_name']; ?></td>
									<td><?php echo $row['fiscal_year']; ?></td>
									<td><?php echo $row['periode_awal']; ?></td>
									<td><?php echo $row['periode_akhir']; ?></td>
									<td><a href="<?php echo site_url('promotion_view/read/'.$row['promotion_id'].'') ?>" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>